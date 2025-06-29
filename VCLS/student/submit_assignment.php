<?php
require_once '../includes/auth_check.php';
require_role('student');

$page_title = 'Submit Assignment';
require_once '../includes/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) { header("Location: /VCLS/student/student_dashboard.php"); exit(); }
$assignment_id = (int)$_GET['id'];
$student_id = $_SESSION['user_id'];
$error_message = '';
$success_message = '';

$stmt = $conn->prepare("SELECT section_id, title, description, due_date FROM assignments WHERE id = ?");
$stmt->bind_param("i", $assignment_id);
$stmt->execute();
$assignment = $stmt->get_result()->fetch_assoc();
if (!$assignment) { die("Assignment not found."); }
$section_id = $assignment['section_id'];
$stmt->close();
$page_title = 'Submit: ' . htmlspecialchars($assignment['title']);

$stmt_check = $conn->prepare("SELECT section_id FROM enrollments WHERE section_id = ? AND student_id = ?");
$stmt_check->bind_param("ii", $section_id, $student_id);
$stmt_check->execute();
if ($stmt_check->get_result()->num_rows == 0) { die("Access Denied."); }
$stmt_check->close();

$stmt_sub = $conn->prepare("SELECT file_path, submitted_at, grade, feedback FROM submissions WHERE assignment_id = ? AND student_id = ?");
$stmt_sub->bind_param("ii", $assignment_id, $student_id);
$stmt_sub->execute();
$submission = $stmt_sub->get_result()->fetch_assoc();
$stmt_sub->close();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !$submission) {
    if (isset($_FILES['submission_file']) && $_FILES['submission_file']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/submissions/';
        if (!is_dir($upload_dir)) { mkdir($upload_dir, 0777, true); }
        
        $original_filename = basename($_FILES['submission_file']['name']);
        $safe_filename = $student_id . '-' . $assignment_id . '-' . preg_replace("/[^a-zA-Z0-9\.\-\_]/", "", $original_filename);
        $target_path = $upload_dir . $safe_filename;

        if (move_uploaded_file($_FILES['submission_file']['tmp_name'], $target_path)) {
            $db_path = 'uploads/submissions/' . $safe_filename;
            $stmt_insert = $conn->prepare("INSERT INTO submissions (assignment_id, student_id, file_path) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("iis", $assignment_id, $student_id, $db_path);
            if ($stmt_insert->execute()) { header("Location: /VCLS/student/submit_assignment.php?id=" . $assignment_id . "&submit=success"); exit(); }
            else { $error_message = "Database error: " . $conn->error; }
            $stmt_insert->close();
        } else { $error_message = "Error moving file."; }
    } else { $error_message = "Please choose a file to upload."; }
}

if (isset($_GET['submit']) && $_GET['submit'] == 'success') { $success_message = "Assignment submitted successfully!"; }

ob_start();
?>
<style>
.card { background-color: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 20px; }
.card h2 { color: #003366; margin-top: 0; }
.assignment-meta { color: #666; margin-bottom: 15px; }
.assignment-description { background: #f8f9fa; padding: 15px; border-radius: 5px; line-height: 1.6; }
.status-item { display: flex; padding: 8px 0; border-bottom: 1px solid #f0f0f0; }
.status-label { font-weight: bold; width: 130px; color: #555; }
.status-value.submitted { color: #28a745; font-weight: bold; }
.file-download { color: #003366; text-decoration: none; font-weight: 500; }
.grade-section { margin-top: 20px; padding-top: 15px; border-top: 2px solid #e9ecef;}
.feedback-content { white-space: pre-wrap; margin-top: 5px; }
.upload-area { border: 2px dashed #ccc; border-radius: 8px; padding: 30px; text-align: center; }
.upload-area input[type=file] { display: none; }
.file-select-button { background: #6c757d; color: white; padding: 10px 15px; border-radius: 5px; cursor: pointer; display: inline-block; }
</style>

<p><a href="assignments.php">← Back to All Assignments</a></p>
<?php if ($success_message): ?><div class="message success"><?php echo $success_message; ?></div><?php endif; ?>
<?php if ($error_message): ?><div class="message error"><?php echo $error_message; ?></div><?php endif; ?>

<div class="card">
    <h2><?php echo htmlspecialchars($assignment['title']); ?></h2>
    <div class="assignment-meta">Due: <?php echo date('l, F d, Y @ h:i A', strtotime($assignment['due_date'])); ?></div>
    <div class="assignment-description"><strong>Instructions:</strong><br><?php echo nl2br(htmlspecialchars($assignment['description'])); ?></div>
</div>
<div class="card">
    <h2>My Submission</h2>
    <?php if ($submission): ?>
        <div class="submission-status">
            <div class="status-item"><span class="status-label">Status:</span><span class="status-value submitted">Submitted</span></div>
            <div class="status-item"><span class="status-label">Submitted On:</span><span><?php echo date('l, F d, Y @ h:i A', strtotime($submission['submitted_at'])); ?></span></div>
            <div class="status-item"><span class="status-label">File:</span><a href="../<?php echo htmlspecialchars($submission['file_path']); ?>" download class="file-download"><?php echo basename($submission['file_path']); ?></a></div>
            <div class="grade-section">
                <div class="status-item"><span class="status-label">Grade:</span><span><strong><?php echo $submission['grade'] ? htmlspecialchars($submission['grade']) : 'Not yet graded'; ?></strong></span></div>
                <div class="status-item"><span class="status-label">Feedback:</span><div class="feedback-content"><?php echo $submission['feedback'] ? nl2br(htmlspecialchars($submission['feedback'])) : 'No feedback yet.'; ?></div></div>
            </div>
        </div>
    <?php else: ?>
        <form action="submit_assignment.php?id=<?php echo $assignment_id; ?>" method="post" enctype="multipart/form-data">
            <div class="upload-area">
                <p>Drag & Drop your file here or</p>
                <input type="file" id="submission_file" name="submission_file" required onchange="document.getElementById('file-name').textContent = this.files[0].name">
                <label for="submission_file" class="file-select-button">Choose File</label>
                <div id="file-name" style="margin-top: 10px; color: #666;">No file selected</div>
            </div><br>
            <button type="submit" class="btn">Submit Assignment</button>
        </form>
    <?php endif; ?>
</div>
<?php
$page_content = ob_get_clean();
require 'includes/student_template.php';
$conn->close();
?>