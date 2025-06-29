<?php
// STEP 1: Perform Auth Check and Start Session FIRST
require_once '../includes/auth_check.php';
require_role('student');

// STEP 2: Page-specific setup
$page_title = 'Student Dashboard';
require_once '../includes/db_connect.php';

// THIS LINE IS NOW SAFE
$student_id = $_SESSION['user_id'];

// --- WIDGET DATA ---
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM enrollments WHERE student_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$enrolled_sections = $stmt->get_result()->fetch_assoc()['count'] ?? 0;
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(a.id) as count FROM assignments a JOIN enrollments e ON a.section_id = e.section_id WHERE e.student_id = ? AND NOT EXISTS (SELECT 1 FROM submissions sub WHERE sub.assignment_id = a.id AND sub.student_id = ?)");
$stmt->bind_param("ii", $student_id, $student_id);
$stmt->execute();
$pending_assignments = $stmt->get_result()->fetch_assoc()['count'] ?? 0;
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(*) as count FROM submissions WHERE student_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$completed_assignments = $stmt->get_result()->fetch_assoc()['count'] ?? 0;
$stmt->close();

$stmt = $conn->prepare("SELECT AVG(CAST(grade AS DECIMAL(5,2))) as avg_grade FROM submissions WHERE student_id = ? AND grade REGEXP '^[0-9]+([.][0-9]+)?$'");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$avg_grade_val = $stmt->get_result()->fetch_assoc()['avg_grade'];
$average_grade = $avg_grade_val ? round($avg_grade_val, 1) . '%' : 'N/A';
$stmt->close();


// --- TABLE DATA ---
$sections_stmt = $conn->prepare("SELECT s.id, s.name, d.name AS department_name, u.full_name AS teacher_name FROM enrollments e JOIN sections s ON e.section_id = s.id JOIN departments d ON s.department_id = d.id JOIN users u ON s.teacher_id = u.id WHERE e.student_id = ? ORDER BY s.name ASC LIMIT 5");
$sections_stmt->bind_param("i", $student_id);
$sections_stmt->execute();
$sections_result = $sections_stmt->get_result();

// STEP 3: Start output buffering
ob_start();
?>
<!-- Widget Cards -->
<section class="widgets-grid">
    <div class="widget-card"><h4>My Courses</h4><p><?php echo $enrolled_sections; ?></p></div>
    <div class="widget-card"><h4>Pending Assignments</h4><p><?php echo $pending_assignments; ?></p></div>
    <div class="widget-card"><h4>Completed Work</h4><p><?php echo $completed_assignments; ?></p></div>
    <div class="widget-card"><h4>My Average Grade</h4><p><?php echo $average_grade; ?></p></div>
</section>

<!-- Enrolled Courses Table -->
<section class="table-container-dash">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h2>My Courses</h2>
        <a href="my_courses.php" class="btn">View All</a>
    </div>
    <table>
        <thead><tr><th>Course Name</th><th>Department</th><th>Teacher</th><th>Action</th></tr></thead>
        <tbody>
            <?php if ($sections_result->num_rows > 0): ?>
                <?php while($section = $sections_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($section['name']); ?></td>
                        <td><?php echo htmlspecialchars($section['department_name']); ?></td>
                        <td><?php echo htmlspecialchars($section['teacher_name'] ?? 'Not Assigned'); ?></td>
                        <td><a href="view_section.php?id=<?php echo $section['id']; ?>" class="btn">View Course</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">You are not currently enrolled in any courses.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>
<?php
// STEP 4: Capture content and include the template
$page_content = ob_get_clean();
require 'includes/student_template.php';
$sections_stmt->close();
$conn->close();
?>