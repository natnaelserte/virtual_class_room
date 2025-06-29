<?php
require_once 'includes/auth_check.php';
if (!isset($_SESSION['user_id'])) { header("Location: /VCLS/login.php"); exit(); }
$sender_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

$page_title = 'Compose Message';
require_once 'includes/db_connect.php';

$error_message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiver_id = $_POST['receiver_id'];
    $subject = trim($_POST['subject']);
    $content = trim($_POST['content']);

    if (empty($receiver_id) || empty($subject) || empty($content)) {
        $error_message = "Recipient, subject, and content are all required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, subject, content) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $sender_id, $receiver_id, $subject, $content);
        if ($stmt->execute()) {
            header("Location: /VCLS/view_message.php?contact=" . $receiver_id);
            exit();
        } else {
            $error_message = "An error occurred while sending the message.";
        }
        $stmt->close();
    }
}

$users_result = $conn->query("SELECT id, full_name, role FROM users WHERE id != $sender_id AND role != 'admin' ORDER BY full_name ASC");

$reply_to_id = '';
if (isset($_GET['reply_to']) && is_numeric($_GET['reply_to'])) {
    $reply_to_id = (int)$_GET['reply_to'];
}

$conn->close();
ob_start();
?>
<div class="form-container">
    <h2>New Message</h2>
    <p style="margin-top:-20px; margin-bottom:20px;"><a href="/VCLS/messages.php">← Back to Inbox</a></p>

    <?php if ($error_message): ?><div class="message error"><?php echo $error_message; ?></div><?php endif; ?>

    <form action="compose_message.php" method="post">
        <div class="form-group">
            <label for="receiver_id">To:</label>
            <select name="receiver_id" id="receiver_id" required>
                <option value="">-- Select a recipient --</option>
                <?php while ($user = $users_result->fetch_assoc()): ?>
                    <option value="<?php echo $user['id']; ?>" <?php if ($reply_to_id == $user['id']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($user['full_name']) . " (" . ucfirst($user['role']) . ")"; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
        </div>
        <div class="form-group">
            <label for="content">Message:</label>
            <textarea id="content" name="content" rows="10" required></textarea>
        </div>
        <button type="submit" class="btn">Send Message</button>
    </form>
</div>
<?php
$page_content = ob_get_clean();
require_once $role . '/includes/' . $role . '_template.php';
?>