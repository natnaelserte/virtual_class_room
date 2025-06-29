<?php
$page_title = 'Enroll Students';
require_once '../includes/db_connect.php';

$selected_section_id = isset($_GET['section_id']) ? (int)$_GET['section_id'] : 0;
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $selected_section_id > 0) {
    if (isset($_POST['enroll_student'])) {
        $student_id = $_POST['student_id'];
        $stmt = $conn->prepare("INSERT INTO enrollments (student_id, section_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $student_id, $selected_section_id);
        if ($stmt->execute()) {
            $success_message = "Student enrolled successfully.";
        } else {
            $error_message = "Error enrolling student. They may already be enrolled.";
        }
        $stmt->close();
    }
    if (isset($_POST['unenroll_student'])) {
        $enrollment_id = $_POST['enrollment_id'];
        $stmt = $conn->prepare("DELETE FROM enrollments WHERE id = ?");
        $stmt->bind_param("i", $enrollment_id);
        if ($stmt->execute()) {
            $success_message = "Student un-enrolled successfully.";
        } else {
            $error_message = "Error un-enrolling student.";
        }
        $stmt->close();
    }
}

$sections_result = $conn->query("SELECT id, name FROM sections ORDER BY name");
$enrolled_students = [];
$available_students = [];
$section_name = '';

if ($selected_section_id > 0) {
    $stmt = $conn->prepare("SELECT name FROM sections WHERE id = ?");
    $stmt->bind_param("i", $selected_section_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $section_name = $result->fetch_assoc()['name'];
    }
    $stmt->close();

    $stmt_enrolled = $conn->prepare("SELECT u.id, u.full_name, e.id AS enrollment_id FROM users u JOIN enrollments e ON u.id = e.student_id WHERE e.section_id = ? ORDER BY u.full_name");
    $stmt_enrolled->bind_param("i", $selected_section_id);
    $stmt_enrolled->execute();
    $enrolled_students = $stmt_enrolled->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt_enrolled->close();
    
    $stmt_available = $conn->prepare("SELECT id, full_name FROM users WHERE role = 'student' AND id NOT IN (SELECT student_id FROM enrollments WHERE section_id = ?) ORDER BY full_name");
    $stmt_available->bind_param("i", $selected_section_id);
    $stmt_available->execute();
    $available_students = $stmt_available->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt_available->close();
}

ob_start();
?>
<!-- Step 1: Section Selection -->
<div class="form-container">
    <h2>Select a Section to Manage</h2>
    <form action="enroll_students.php" method="get">
        <div class="form-group">
            <label for="section_id">Section:</label>
            <select name="section_id" id="section_id" onchange="this.form.submit()">
                <option value="">-- Choose a Section --</option>
                <?php mysqli_data_seek($sections_result, 0); while ($section = $sections_result->fetch_assoc()): ?>
                    <option value="<?php echo $section['id']; ?>" <?php if ($selected_section_id == $section['id']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($section['name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
    </form>
</div>

<?php if ($selected_section_id > 0 && $section_name): ?>
    <h2>Managing Enrollments for: <strong><?php echo htmlspecialchars($section_name); ?></strong></h2>
    <?php if ($success_message): ?><div class="message success"><?php echo $success_message; ?></div><?php endif; ?>
    <?php if ($error_message): ?><div class="message error"><?php echo $error_message; ?></div><?php endif; ?>
    <div class="enrollment-columns">
        <div class="table-container-dash">
            <h3>Enrolled Students (<?php echo count($enrolled_students); ?>)</h3>
            <table>
                <thead><tr><th>Student Name</th><th>Action</th></tr></thead>
                <tbody>
                    <?php if (count($enrolled_students) > 0): foreach ($enrolled_students as $student): ?>
                    <tr><td><?php echo htmlspecialchars($student['full_name']); ?></td><td><form method="post"><input type="hidden" name="enrollment_id" value="<?php echo $student['enrollment_id']; ?>"><button type="submit" name="unenroll_student" class="btn btn-delete">Un-enroll</button></form></td></tr>
                    <?php endforeach; else: ?><tr><td colspan="2">No students enrolled yet.</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="table-container-dash">
            <h3>Available Students (<?php echo count($available_students); ?>)</h3>
            <table>
                <thead><tr><th>Student Name</th><th>Action</th></tr></thead>
                <tbody>
                    <?php if (count($available_students) > 0): foreach ($available_students as $student): ?>
                    <tr><td><?php echo htmlspecialchars($student['full_name']); ?></td><td><form method="post"><input type="hidden" name="student_id" value="<?php echo $student['id']; ?>"><button type="submit" name="enroll_student" class="btn">Enroll</button></form></td></tr>
                    <?php endforeach; else: ?><tr><td colspan="2">No other students available to enroll.</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
<style>.enrollment-columns { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; } @media (max-width: 768px) { .enrollment-columns { grid-template-columns: 1fr; } }</style>
<?php
$page_content = ob_get_clean();
require 'includes/admin_template.php';
$conn->close();
?>