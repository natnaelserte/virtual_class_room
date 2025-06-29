<?php
require_once '../includes/auth_check.php';
require_role('teacher');

$page_title = 'Add Video';
require_once '../includes/db_connect.php';

if (!isset($_GET['section_id']) || !is_numeric($_GET['section_id'])) { header("Location: /VCLS/teacher/teacher_dashboard.php"); exit(); }
$section_id = (int)$_GET['section_id'];
$teacher_id = $_SESSION['user_id'];
$error_message = '';

$stmt = $conn->prepare("SELECT name FROM sections WHERE id = ? AND teacher_id = ?");
$stmt->bind_param("ii", $section_id, $teacher_id);
$stmt->execute();
$result = $stmt->get_result(); // <<<<<<< FIX: Get the result ONCE
if ($result->num_rows == 0) {
    $stmt->close();
    die("Access Denied.");
}
$stmt->close();

function getYouTubeId($url) { preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match); return $match[1] ?? null; }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $video_id = getYouTubeId($url);
    if (!empty($title) && !empty($video_id)) {
        $embed_url = 'https://www.youtube.com/embed/' . $video_id;
        $stmt_insert = $conn->prepare("INSERT INTO materials (section_id, title, material_type, video_url, file_path) VALUES (?, ?, 'video', ?, '#')");
        $stmt_insert->bind_param("iss", $section_id, $title, $embed_url);
        if ($stmt_insert->execute()) { header("Location: /VCLS/teacher/view_section.php?id=" . $section_id . "&video_add=success"); exit(); }
        else { $error_message = "Error adding video."; }
        $stmt_insert->close();
    } else { $error_message = "Please enter a valid title and YouTube URL."; }
}

ob_start();
?>
<div class="form-container">
    <h2>Add New Video Lecture</h2>
    <p style="margin-top:-20px; margin-bottom:20px;"><a href="/VCLS/teacher/view_section.php?id=<?php echo $section_id; ?>">← Back to Course</a></p>
    <?php if ($error_message): ?><div class="message error"><?php echo $error_message; ?></div><?php endif; ?>
    <form action="add_video.php?section_id=<?php echo $section_id; ?>" method="post">
        <div class="form-group"><label for="title">Video Title:</label><input type="text" id="title" name="title" required></div>
        <div class="form-group"><label for="url">YouTube Video URL:</label><input type="url" id="url" name="url" placeholder="e.g., https://www.youtube.com/watch?v=..." required></div>
        <button type="submit" class="btn">Add Video</button>
    </form>
</div>
<?php
$page_content = ob_get_clean();
require 'includes/teacher_template.php';
$conn->close();
?>