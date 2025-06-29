<?php
// STEP 1: Perform Auth Check and Start Session FIRST
require_once '../includes/auth_check.php';
require_role('student');

// STEP 2: Page-specific setup
$page_title = 'My Courses';
require_once '../includes/db_connect.php';

// THIS LINE IS NOW SAFE
$student_id = $_SESSION['user_id'];

// --- Get enrolled sections ---
$sections_stmt = $conn->prepare("SELECT s.id, s.name, d.name AS department_name, u.full_name AS teacher_name FROM enrollments e JOIN sections s ON e.section_id = s.id JOIN departments d ON s.department_id = d.id JOIN users u ON s.teacher_id = u.id WHERE e.student_id = ? ORDER BY s.name ASC");
$sections_stmt->bind_param("i", $student_id);
$sections_stmt->execute();
$sections_result = $sections_stmt->get_result();

// STEP 3: Start output buffering
ob_start();
?>
<div class="table-container-dash">
    <h2>All My Enrolled Courses</h2>
    <table>
        <thead><tr><th>Course Name</th><th>Department</th><th>Teacher</th><th>Action</th></tr></thead>
        <tbody>
            <?php if ($sections_result->num_rows > 0): ?>
                <?php while($section = $sections_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($section['name']); ?></td>
                        <td><?php echo htmlspecialchars($section['department_name']); ?></td>
                        <td><?php echo htmlspecialchars($section['teacher_name']); ?></td>
                        <td><a href="view_section.php?id=<?php echo $section['id']; ?>" class="btn">View Course</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">You are not enrolled in any courses.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php
// STEP 4: Capture content and include the template
$page_content = ob_get_clean();
require 'includes/student_template.php';
$sections_stmt->close();
$conn->close();
?>