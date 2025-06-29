<?php
require_once '../includes/auth_check.php';
require_role('student');
$page_title = 'My Grades';
require_once '../includes/db_connect.php';
$student_id = $_SESSION['user_id'];

$assignments_stmt = $conn->prepare("SELECT a.title, s.name AS section_name, sub.grade, sub.feedback FROM submissions sub JOIN assignments a ON sub.assignment_id = a.id JOIN sections s ON a.section_id = s.id WHERE sub.student_id = ? AND sub.grade IS NOT NULL AND sub.grade != '' ORDER BY a.title ASC");
$assignments_stmt->bind_param("i", $student_id);
$assignments_stmt->execute();
$graded_assignments = $assignments_stmt->get_result();

$quizzes_stmt = $conn->prepare("SELECT q.title, s.name AS section_name, qa.score, qa.total_questions FROM quiz_attempts qa JOIN quizzes q ON qa.quiz_id = q.id JOIN sections s ON q.section_id = s.id WHERE qa.student_id = ? ORDER BY q.title ASC");
$quizzes_stmt->bind_param("i", $student_id);
$quizzes_stmt->execute();
$completed_quizzes = $quizzes_stmt->get_result();

ob_start();
?>
<style>
.grade-indicator { display: inline-block; padding: 3px 8px; border-radius: 12px; font-size: 0.8em; font-weight: 500; }
.grade-indicator.excellent { background-color: #d4edda; color: #155724; }
.grade-indicator.good { background-color: #d1ecf1; color: #0c5460; }
.grade-indicator.passing { background-color: #fff3cd; color: #856404; }
.grade-indicator.needs-improvement { background-color: #f8d7da; color: #721c24; }
.btn-feedback { background-color: #6c757d; border:none; color:white; padding: 5px 10px; border-radius:4px; cursor:pointer; }
.modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.6); }
.modal-content { background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 500px; border-radius: 8px; position:relative; }
.close-modal { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor:pointer; }
</style>
<div class="table-container-dash">
    <h2>Assignment Grades</h2>
    <table>
        <thead><tr><th>Assignment</th><th>Course</th><th>Grade</th><th>Feedback</th></tr></thead>
        <tbody>
            <?php if ($graded_assignments->num_rows > 0): while($a = $graded_assignments->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($a['title']); ?></td>
                    <td><?php echo htmlspecialchars($a['section_name']); ?></td>
                    <td><strong><?php echo htmlspecialchars($a['grade']); ?></strong></td>
                    <td>
                        <?php if (!empty($a['feedback'])): ?>
                            <button class="btn-feedback" onclick="showFeedback('<?php echo htmlspecialchars(addslashes($a['feedback'])); ?>')">View</button>
                        <?php else: ?><span>-</span><?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; else: ?><tr><td colspan="4">No graded assignments yet.</td></tr><?php endif; ?>
        </tbody>
    </table>
</div>
<div class="table-container-dash" style="margin-top:20px;">
    <h2>Quiz Results</h2>
    <table>
        <thead><tr><th>Quiz</th><th>Course</th><th>Score</th><th>Percentage</th></tr></thead>
        <tbody>
            <?php if ($completed_quizzes->num_rows > 0): while($q = $completed_quizzes->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($q['title']); ?></td>
                    <td><?php echo htmlspecialchars($q['section_name']); ?></td>
                    <td><?php echo $q['score'] . ' / ' . $q['total_questions']; ?></td>
                    <td><?php $p = ($q['total_questions'] > 0) ? round(($q['score'] / $q['total_questions']) * 100) : 0; echo $p . '%'; ?>
                        <?php if($p >= 90): ?><span class="grade-indicator excellent">Excellent</span>
                        <?php elseif($p >= 80): ?><span class="grade-indicator good">Good</span>
                        <?php elseif($p >= 70): ?><span class="grade-indicator passing">Passing</span>
                        <?php else: ?><span class="grade-indicator needs-improvement">Needs Improvement</span><?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; else: ?><tr><td colspan="4">No completed quizzes yet.</td></tr><?php endif; ?>
        </tbody>
    </table>
</div>
<div id="feedbackModal" class="modal"><div class="modal-content"><span class="close-modal">×</span><h3>Instructor Feedback</h3><div id="feedbackContent" style="white-space: pre-wrap; background:#eee; padding:10px; border-radius:4px;"></div></div></div>
<script>
function showFeedback(feedback) { document.getElementById('feedbackContent').textContent = feedback; document.getElementById('feedbackModal').style.display = 'block'; }
document.querySelector('.close-modal').onclick = function() { document.getElementById('feedbackModal').style.display = 'none'; }
window.onclick = function(event) { if (event.target == document.getElementById('feedbackModal')) { document.getElementById('feedbackModal').style.display = 'none'; } }
</script>
<?php
$page_content = ob_get_clean();
require 'includes/student_template.php';
$assignments_stmt->close();
$quizzes_stmt->close();
$conn->close();
?>