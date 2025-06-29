<?php
$page_title = 'Edit Section';
require_once '../includes/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: manage_sections.php");
    exit();
}
$section_id = (int)$_GET['id'];
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $department_id = $_POST['department_id'];
    $teacher_id = $_POST['teacher_id'];

    if (!empty($name) && !empty($department_id) && !empty($teacher_id)) {
        $stmt = $conn->prepare("UPDATE sections SET name = ?, department_id = ?, teacher_id = ? WHERE id = ?");
        $stmt->bind_param("siii", $name, $department_id, $teacher_id, $section_id);
        if ($stmt->execute()) {
            header("Location: manage_sections.php?update=success");
            exit();
        } else { $error_message = "Error updating section."; }
        $stmt->close();
    } else { $error_message = "All fields are required."; }
}

$section_stmt = $conn->prepare("SELECT name, department_id, teacher_id FROM sections WHERE id = ?");
$section_stmt->bind_param("i", $section_id);
$section_stmt->execute();
$result = $section_stmt->get_result();
if ($result->num_rows == 1) {
    $section = $result->fetch_assoc();
} else { header("Location: manage_sections.php"); exit(); }
$section_stmt->close();

$departments = $conn->query("SELECT id, name FROM departments ORDER BY name");
$teachers = $conn->query("SELECT id, full_name FROM users WHERE role = 'teacher' ORDER BY full_name");

ob_start();
?>
<p><a href="manage_sections.php">← Back to Sections List</a></p>
<?php if ($error_message): ?><div class="message error"><?php echo $error_message; ?></div><?php endif; ?>
<div class="form-container">
    <form action="edit_section.php?id=<?php echo $section_id; ?>" method="post">
        <div class="form-group">
            <label for="name">Section Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($section['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="department_id">Department:</label>
            <select id="department_id" name="department_id" required>
                <?php while ($dept = $departments->fetch_assoc()): ?>
                    <option value="<?php echo $dept['id']; ?>" <?php if ($dept['id'] == $section['department_id']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($dept['name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="teacher_id">Assign Teacher:</label>
            <select id="teacher_id" name="teacher_id" required>
                <?php while ($teacher = $teachers->fetch_assoc()): ?>
                    <option value="<?php echo $teacher['id']; ?>" <?php if ($teacher['id'] == $section['teacher_id']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($teacher['full_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn">Update Section</button>
    </form>
</div>
<?php
$page_content = ob_get_clean();
require 'includes/admin_template.php';
$conn->close();
?>