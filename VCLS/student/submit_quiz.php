<?php
require_once '../includes/auth_check.php';
require_role('student');
require_once '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: student_dashboard.php");
    exit();
}

$quiz_id = (int)$_POST['quiz_id'];
$student_id = $_SESSION['user_id'];
$answers = $_POST['answers'] ?? [];

if (empty($quiz_id) || empty($answers)) {
    header("Location: take_quiz.php?id=" . $quiz_id . "&error=incomplete");
    exit();
}

$score = 0;
$question_ids = array_keys($answers);
$placeholders = implode(',', array_fill(0, count($question_ids), '?'));

$stmt = $conn->prepare("SELECT question_id, id FROM options WHERE question_id IN ($placeholders) AND is_correct = TRUE");
$stmt->bind_param(str_repeat('i', count($question_ids)), ...$question_ids);
$stmt->execute();
$result = $stmt->get_result();

$correct_answers = [];
while ($row = $result->fetch_assoc()) {
    $correct_answers[$row['question_id']] = $row['id'];
}
$stmt->close();

foreach ($answers as $question_id => $student_option_id) {
    if (isset($correct_answers[$question_id]) && $correct_answers[$question_id] == $student_option_id) {
        $score++;
    }
}

$total_questions = count($question_ids);

$stmt_check = $conn->prepare("SELECT id FROM quiz_attempts WHERE quiz_id = ? AND student_id = ?");
$stmt_check->bind_param("ii", $quiz_id, $student_id);
$stmt_check->execute();
if ($stmt_check->get_result()->num_rows == 0) {
    $insert_stmt = $conn->prepare("INSERT INTO quiz_attempts (quiz_id, student_id, score, total_questions) VALUES (?, ?, ?, ?)");
    $insert_stmt->bind_param("iiii", $quiz_id, $student_id, $score, $total_questions);
    $insert_stmt->execute();
    $insert_stmt->close();
}
$stmt_check->close();
$conn->close();

header("Location: quiz_result.php?id=" . $quiz_id);
exit();
?>