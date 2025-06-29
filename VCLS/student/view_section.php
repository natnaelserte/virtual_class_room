<?php
// STEP 1: Perform Auth Check and Start Session FIRST
require_once '../includes/auth_check.php';
require_role('student');

// STEP 2: Page-specific setup
$page_title = 'View Course';
require_once '../includes/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) { header("Location: /VCLS/student/student_dashboard.php"); exit(); }
$section_id = (int)$_GET['id'];
$student_id = $_SESSION['user_id']; // This is now safe

// --- Security Check & Fetch Data ---
$stmt_check = $conn->prepare("SELECT section_id FROM enrollments WHERE section_id = ? AND student_id = ?");
$stmt_check->bind_param("ii", $section_id, $student_id);
$stmt_check->execute();
if ($stmt_check->get_result()->num_rows == 0) { die("Access Denied."); }
$stmt_check->close();

$section_stmt = $conn->prepare("SELECT s.name, u.full_name AS teacher_name FROM sections s JOIN users u ON s.teacher_id = u.id WHERE s.id = ?");
$section_stmt->bind_param("i", $section_id);
$section_stmt->execute();
$section = $section_stmt->get_result()->fetch_assoc();
$section_name = $section['name'];
$teacher_name = $section['teacher_name'];
$section_stmt->close();
$page_title = htmlspecialchars($section_name);

$assignments_result = $conn->query("SELECT id, title, due_date FROM assignments WHERE section_id = $section_id ORDER BY due_date DESC");
$quizzes_result = $conn->query("SELECT id, title FROM quizzes WHERE section_id = $section_id ORDER BY created_at DESC");
$materials_result = $conn->query("SELECT title, file_path, material_type, video_url FROM materials WHERE section_id = $section_id ORDER BY uploaded_at DESC");
$announcements_result = $conn->query("SELECT a.content, a.created_at, u.full_name FROM announcements a JOIN users u ON a.user_id = u.id WHERE a.section_id = $section_id ORDER BY created_at DESC");

// STEP 3: Start output buffering
ob_start();
?>
<style>
.section-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px; }
.content-card { background-color: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
.content-card h2 { color: #003366; margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 15px; font-size: 1.25em; }
.item-list ul { list-style-type: none; padding: 0; }
.item-list li { padding: 10px 0; border-bottom: 1px solid #f0f0f0; }
.item-list li:last-child { border-bottom: none; }
.item-list small { color: #666; font-size: 0.85em; }
.announcement-item { background-color: #f8f9fa; padding: 10px; border-radius: 5px; margin-bottom: 10px; }
.announcement-meta { font-size: 0.8em; color: #666; margin-bottom: 5px; }
.announcement-content { line-height: 1.5; }
.video-wrapper { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; margin-top: 10px; border-radius: 8px;}
.video-wrapper iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }

/* --- NEW CSS FOR ALIGNMENT --- */
.item-list .list-item-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.item-list .list-item-content {
    flex-grow: 1;
}
.item-list .list-item-action {
    flex-shrink: 0;
    margin-left: 15px;
}
.item-list .btn {
    padding: 6px 12px;
    font-size: 0.9em;
}
</style>

<div class="course-header" style="margin-bottom:20px;">
    <p><strong>Teacher:</strong> <?php echo htmlspecialchars($teacher_name); ?></p>
    <a href="my_courses.php" class="btn">← All Courses</a>
</div>

<div class="section-grid">
    <div class="content-card">
        <h2>Announcements</h2>
        <?php if ($announcements_result->num_rows > 0): while($an = $announcements_result->fetch_assoc()): ?>
        <div class="announcement-item"><div class="announcement-meta">By <?php echo htmlspecialchars($an['full_name']); ?> on <?php echo date('M d, Y', strtotime($an['created_at'])); ?></div><div class="announcement-content"><?php echo nl2br(htmlspecialchars($an['content'])); ?></div></div>
        <?php endwhile; else: ?><p>No announcements.</p><?php endif; ?>
    </div>
    <div class="content-card">
        <h2>Learning Materials</h2>
        <div class="item-list">
            <?php if ($materials_result->num_rows > 0): ?><ul>
                <?php while($m = $materials_result->fetch_assoc()): ?><li>
                    <?php if ($m['material_type'] == 'video'): ?>
                        <div class="list-item-content">
                            <strong><?php echo htmlspecialchars($m['title']); ?></strong>
                            <div class="video-wrapper"><iframe src="<?php echo htmlspecialchars($m['video_url']); ?>" frameborder="0" allowfullscreen></iframe></div>
                        </div>
                    <?php else: ?>
                        <div class="list-item-row">
                            <div class="list-item-content"><strong><?php echo htmlspecialchars($m['title']); ?></strong></div>
                            <div class="list-item-action"><a href="../<?php echo htmlspecialchars($m['file_path']); ?>" class="btn" download>Download</a></div>
                        </div>
                    <?php endif; ?>
                </li><?php endwhile; ?>
            </ul><?php else: ?><p>No materials uploaded.</p><?php endif; ?>
        </div>
    </div>
    <div class="content-card">
        <h2>Assignments</h2>
        <div class="item-list">
            <?php if ($assignments_result->num_rows > 0): ?><ul>
                <?php while($a = $assignments_result->fetch_assoc()): ?><li>
                    <div class="list-item-row">
                        <div class="list-item-content">
                            <strong><?php echo htmlspecialchars($a['title']); ?></strong><br>
                            <small>Due: <?php echo date('M d, Y', strtotime($a['due_date'])); ?></small>
                        </div>
                        <div class="list-item-action"><a href="submit_assignment.php?id=<?php echo $a['id']; ?>" class="btn">View</a></div>
                    </div>
                </li><?php endwhile; ?>
            </ul><?php else: ?><p>No assignments posted.</p><?php endif; ?>
        </div>
    </div>
    <div class="content-card">
        <h2>Quizzes</h2>
        <div class="item-list">
            <?php if ($quizzes_result->num_rows > 0): ?><ul>
                <?php while($q = $quizzes_result->fetch_assoc()): ?><li>
                    <div class="list-item-row">
                        <div class="list-item-content"><strong><?php echo htmlspecialchars($q['title']); ?></strong></div>
                        <div class="list-item-action"><a href="take_quiz.php?id=<?php echo $q['id']; ?>" class="btn">Take Quiz</a></div>
                    </div>
                </li><?php endwhile; ?>
            </ul><?php else: ?><p>No quizzes available.</p><?php endif; ?>
        </div>
    </div>
</div>
<?php
$page_content = ob_get_clean();
require 'includes/student_template.php';
$conn->close();
?>