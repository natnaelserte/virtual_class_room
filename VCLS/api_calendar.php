<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    die(json_encode(["error" => "Access Denied"]));
}

require_once 'includes/db_connect.php';

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

$sql = "";
// Prepare SQL based on user role
if ($role === 'student') {
    $sql = "SELECT a.id, a.title, a.due_date FROM assignments a JOIN enrollments e ON a.section_id = e.section_id WHERE e.student_id = ?";
} elseif ($role === 'teacher') {
    $sql = "SELECT a.id, a.title, a.due_date FROM assignments a JOIN sections s ON a.section_id = s.id WHERE s.teacher_id = ?";
}

// If role is admin or something else, return empty
if (empty($sql)) {
    echo json_encode([]);
    exit();
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Format data for FullCalendar
$events = [];
while ($row = $result->fetch_assoc()) {
    $url = '';
    if ($role === 'student') { $url = 'student/submit_assignment.php?id=' . $row['id']; } 
    elseif ($role === 'teacher') { $url = 'teacher/grade_assignment.php?id=' . $row['id']; }

    $events[] = [
        'title' => $row['title'],
        'start' => $row['due_date'],
        'url'   => $url,
        'color' => ($role === 'teacher') ? '#ffc107' : '#007bff' // Yellow for teachers, Blue for students
    ];
}
$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($events);
?>