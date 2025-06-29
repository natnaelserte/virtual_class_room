<?php
// STEP 1: AUTHENTICATION & ROLE CHECK
require_once 'includes/auth_check.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: /VCLS/login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// STEP 2: PAGE-SPECIFIC SETUP
$page_title = 'Messages';
require_once 'includes/db_connect.php';

// Fetch all contacts (users who have had a conversation with the current user)
$stmt = $conn->prepare("
    SELECT DISTINCT u.id, u.full_name, u.role,
    (SELECT MAX(created_at) FROM messages 
     WHERE (sender_id = u.id AND receiver_id = ?) 
     OR (sender_id = ? AND receiver_id = u.id)) as last_message_time,
    (SELECT COUNT(*) FROM messages 
     WHERE sender_id = u.id AND receiver_id = ? AND is_read = FALSE) as unread_count
    FROM users u
    JOIN messages m ON (m.sender_id = u.id AND m.receiver_id = ?) 
                     OR (m.sender_id = ? AND m.receiver_id = u.id)
    WHERE u.id != ?
    ORDER BY last_message_time DESC
");
$stmt->bind_param("iiiiii", $user_id, $user_id, $user_id, $user_id, $user_id, $user_id);
$stmt->execute();
$contacts_result = $stmt->get_result();
$stmt->close();
$conn->close();

// STEP 3: PREPARE PAGE CONTENT
ob_start();
?>
<div class="chat-container">
    <!-- Chat Sidebar - Contact List -->
    <div class="chat-sidebar">
        <div class="chat-header">
            <h2>Messages</h2>
            <a href="/VCLS/compose_message.php" class="btn-compose">New Message</a>
        </div>
        <div class="contact-list">
            <?php if ($contacts_result->num_rows > 0): ?>
                <?php while($contact = $contacts_result->fetch_assoc()): ?>
                    <a href="/VCLS/view_message.php?contact=<?php echo $contact['id']; ?>" class="contact-item">
                        <div class="contact-avatar"><?php echo substr($contact['full_name'], 0, 1); ?></div>
                        <div class="contact-info">
                            <span class="contact-name"><?php echo htmlspecialchars($contact['full_name']); ?></span>
                            <span class="contact-role"><?php echo ucfirst($contact['role']); ?></span>
                        </div>
                        <?php if ($contact['unread_count'] > 0): ?>
                            <div class="unread-badge"><?php echo $contact['unread_count']; ?></div>
                        <?php endif; ?>
                    </a>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-contacts">No conversations yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Chat Main Area - Welcome Message -->
    <div class="chat-main">
        <div class="welcome-message">
            <div class="welcome-icon">✉️</div>
            <h2>Welcome to Messages</h2>
            <p>Select a conversation from the list on the left to view your messages or start a new one.</p>
            <a href="/VCLS/compose_message.php" class="btn">Compose New Message</a>
        </div>
    </div>
</div>
<?php
$page_content = ob_get_clean();

// STEP 4: RENDER THE CORRECT TEMPLATE BASED ON ROLE
// This is the magic part. It loads the correct dashboard around the content.
require_once $role . '/includes/' . $role . '_template.php';
?>