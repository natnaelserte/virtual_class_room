<?php
// STEP 1: Perform Auth Check and Start Session FIRST
require_once '../includes/auth_check.php';
require_role('student');

// STEP 2: Page-specific setup
$page_title = 'Quiz Result';
require_once '../includes/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: /VCLS/student/student_dashboard.php");
    exit();
}
$quiz_id = (int)$_GET['id'];
$student_id = $_SESSION['user_id'];

// --- Fetch the student's attempt for this quiz ---
$stmt = $conn->prepare("SELECT score, total_questions, completed_at FROM quiz_attempts WHERE quiz_id = ? AND student_id = ?");
$stmt->bind_param("ii", $quiz_id, $student_id);
$stmt->execute();
$attempt = $stmt->get_result()->fetch_assoc();
$stmt->close();

// --- THIS IS THE CORRECTED LOGIC ---
// If no attempt is found, they haven't taken it. Redirect them to take it.
if (!$attempt) {
    header("Location: /VCLS/student/take_quiz.php?id=" . $quiz_id);
    exit();
}
// --- THE REDIRECT LOOP IS NOW FIXED ---

// Fetch quiz title and section_id for the back link
$quiz_title_stmt = $conn->prepare("SELECT title, section_id FROM quizzes WHERE id = ?");
$quiz_title_stmt->bind_param("i", $quiz_id);
$quiz_title_stmt->execute();
$quiz_info = $quiz_title_stmt->get_result()->fetch_assoc();
$section_id = $quiz_info['section_id'] ?? 0;
$page_title = 'Result: ' . htmlspecialchars($quiz_info['title'] ?? 'Quiz');
$quiz_title_stmt->close();

// STEP 3: Start output buffering
ob_start();
?>
<style>
.result-summary { text-align: center; background-color: #e9f0f7; padding: 40px; border-radius: 8px; margin-top: 20px; }
.score-display { font-size: 4em; font-weight: bold; color: #003366; margin: 10px 0; }
.score-percent { font-size: 2em; color: #343a40; }
</style>

<div class="form-container">
    <h2>Quiz Results: <?php echo htmlspecialchars($quiz_info['title'] ?? 'Quiz'); ?></h2>
    <p style="margin-top:-20px; margin-bottom:20px;"><a href="/VCLS/student/view_section.php?id=<?php echo $section_id; ?>">← Back to Course</a></p>

    <div class="result-summary">
        <h2>Your Score</h2>
        <p class="score-display"><?php echo $attempt['score']; ?> / <?php echo $attempt['total_questions']; ?></p>
        <p class="score-percent">
            <?php 
            if ($attempt['total_questions'] > 0) {
                echo round(($attempt['score'] / $attempt['total_questions']) * 100);
            } else {
                echo 0;
            }
            ?>%
        </p>
        <p><small>Completed on: <?php echo date('l, F d, Y', strtotime($attempt['completed_at'])); ?></small></p>
    </div>
</div>

<?php
// STEP 4: Capture content and include the template
$page_content = ob_get_clean();
require 'includes/student_template.php';
$conn->close();
?>