<?php
// STEP 1: Perform Auth Check and Start Session FIRST
require_once '../includes/auth_check.php';
require_role('student');

// STEP 2: Page-specific setup
$page_title = 'Take Quiz';
require_once '../includes/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) { header("Location: /VCLS/student/student_dashboard.php"); exit(); }
$quiz_id = (int)$_GET['id'];
$student_id = $_SESSION['user_id']; // This is now safe

// Fetch quiz details and its section_id for security check
$stmt = $conn->prepare("SELECT title, section_id FROM quizzes WHERE id = ?");
$stmt->bind_param("i", $quiz_id);
$stmt->execute();
$quiz = $stmt->get_result()->fetch_assoc();
if (!$quiz) { die("Quiz not found."); }
$section_id = $quiz['section_id'];
$stmt->close();
$page_title = 'Quiz: ' . htmlspecialchars($quiz['title']);

// Security Check: Is student enrolled in this quiz's section?
$stmt_check = $conn->prepare("SELECT section_id FROM enrollments WHERE section_id = ? AND student_id = ?");
$stmt_check->bind_param("ii", $section_id, $student_id);
$stmt_check->execute();
if ($stmt_check->get_result()->num_rows == 0) { die("Access Denied. You are not enrolled in this section."); }
$stmt_check->close();

// Check if student has ALREADY taken this quiz
$stmt_attempt = $conn->prepare("SELECT id FROM quiz_attempts WHERE quiz_id = ? AND student_id = ?");
$stmt_attempt->bind_param("ii", $quiz_id, $student_id);
$stmt_attempt->execute();
if ($stmt_attempt->get_result()->num_rows > 0) {
    header("Location: /VCLS/student/quiz_result.php?id=" . $quiz_id);
    exit();
}
$stmt_attempt->close();

// Fetch all questions and their options for this quiz
$questions_stmt = $conn->prepare("
    SELECT q.id AS question_id, q.question_text, o.id AS option_id, o.option_text 
    FROM questions q 
    JOIN options o ON q.id = o.question_id 
    WHERE q.quiz_id = ? 
    ORDER BY q.id, o.id
");
$questions_stmt->bind_param("i", $quiz_id);
$questions_stmt->execute();
$result = $questions_stmt->get_result();

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[$row['question_id']]['question_text'] = $row['question_text'];
    $questions[$row['question_id']]['options'][] = [
        'id' => $row['option_id'],
        'text' => $row['option_text']
    ];
}
$questions_stmt->close();

// STEP 3: Start output buffering
ob_start();
?>
<style>
.quiz-container { background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
.question-item { margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
.question-item h4 { margin: 0 0 15px; color: #333; font-size: 1.1em; line-height: 1.5; }
.option-item { margin-bottom: 10px; }
.option-item label { margin-left: 8px; font-size: 1em; }
.btn-submit-quiz { padding: 12px 25px; font-size: 1.1em; }
</style>

<div class="form-container">
    <h2><?php echo htmlspecialchars($quiz['title']); ?></h2>
    <p style="margin-top:-20px; margin-bottom:20px;"><a href="/VCLS/student/view_section.php?id=<?php echo $section_id; ?>">← Back to Course</a></p>
    <p>Please answer all questions and submit your answers at the bottom.</p>
    
    <form action="/VCLS/student/submit_quiz.php" method="post">
        <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
        
        <?php $q_num = 1; foreach ($questions as $q_id => $q_data): ?>
            <div class="question-item">
                <h4><?php echo $q_num++; ?>. <?php echo htmlspecialchars($q_data['question_text']); ?></h4>
                <div class="options-list">
                    <?php foreach ($q_data['options'] as $option): ?>
                        <div class="option-item">
                            <input type="radio" name="answers[<?php echo $q_id; ?>]" value="<?php echo $option['id']; ?>" id="option_<?php echo $option['id']; ?>" required>
                            <label for="option_<?php echo $option['id']; ?>"><?php echo htmlspecialchars($option['text']); ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="btn btn-submit-quiz">Submit My Answers</button>
    </form>
</div>
<?php
// STEP 4: Capture content and include the template
$page_content = ob_get_clean();
require 'includes/student_template.php';
$conn->close();
?>