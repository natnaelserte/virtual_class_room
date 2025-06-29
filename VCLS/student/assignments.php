<?php
require_once '../includes/auth_check.php';
require_role('student');
$page_title = 'My Assignments';
require_once '../includes/db_connect.php';
$student_id = $_SESSION['user_id'];

$pending_stmt = $conn->prepare("SELECT a.id, a.title, a.due_date, s.name AS section_name FROM assignments a JOIN sections s ON a.section_id = s.id JOIN enrollments e ON s.id = e.section_id LEFT JOIN submissions sub ON a.id = sub.assignment_id AND sub.student_id = e.student_id WHERE e.student_id = ? AND sub.id IS NULL ORDER BY a.due_date ASC");
$pending_stmt->bind_param("i", $student_id);
$pending_stmt->execute();
$pending_assignments = $pending_stmt->get_result();
$pending_stmt->close();

$completed_stmt = $conn->prepare("SELECT a.id, a.title, a.due_date, s.name AS section_name FROM assignments a JOIN sections s ON a.section_id = s.id JOIN submissions sub ON a.id = sub.assignment_id WHERE sub.student_id = ? ORDER BY sub.submitted_at DESC");
$completed_stmt->bind_param("i", $student_id);
$completed_stmt->execute();
$completed_assignments = $completed_stmt->get_result();
$completed_stmt->close();
ob_start();
?>
<div class="table-container-dash">
    <h2>Pending Assignments</h2>
    <table>
        <thead><tr><th>Title</th><th>Course</th><th>Due Date</th><th>Action</th></tr></thead>
        <tbody>
            <?php if ($pending_assignments->num_rows > 0): ?>
                <?php while($a = $pending_assignments->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($a['title']); ?></td>
                        <td><?php echo htmlspecialchars($a['section_name']); ?></td>
                        <td><?php echo date('M d, Y @ h:i A', strtotime($a['due_date'])); ?></td>
                        <td><a href="submit_assignment.php?id=<?php echo $a['id']; ?>" class="btn">Submit Now</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">You have no pending assignments. Great job!</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="table-container-dash" style="margin-top:20px;">
    <h2>Completed Assignments</h2>
    <table>
        <thead><tr><th>Title</th><th>Course</th><th>Due Date</th><th>Action</th></tr></thead>
        <tbody>
            <?php if ($completed_assignments->num_rows > 0): ?>
                <?php while($a = $completed_assignments->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($a['title']); ?></td>
                        <td><?php echo htmlspecialchars($a['section_name']); ?></td>
                        <td><?php echo date('M d, Y', strtotime($a['due_date'])); ?></td>
                        <td><a href="submit_assignment.php?id=<?php echo $a['id']; ?>" class="btn" style="background-color:#6c757d;">View Submission</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">You have not completed any assignments yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php
$page_content = ob_get_clean();
require 'includes/student_template.php';
$conn->close();
?>