<?php
require_once 'includes/auth_check.php';
if (!isset($_SESSION['user_id'])) { header("Location: /VCLS/login.php"); exit(); }
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

$page_title = 'My Profile';
require_once 'includes/db_connect.php';

$success_message = '';
$error_message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['current_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $user_data = $stmt->get_result()->fetch_assoc();
        
        if ($user_data && password_verify($current_password, $user_data['password'])) {
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                $update_stmt->bind_param("si", $hashed_password, $user_id);
                if ($update_stmt->execute()) {
                    $success_message = "Password updated successfully!";
                } else {
                    $error_message = "Error updating password.";
                }
                $update_stmt->close();
            } else { $error_message = "New passwords do not match."; }
        } else { $error_message = "Current password is incorrect."; }
        $stmt->close();
    }
}

$user_stmt = $conn->prepare("SELECT full_name, username, role FROM users WHERE id = ?");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user = $user_stmt->get_result()->fetch_assoc();
$user_stmt->close();
$conn->close();

ob_start();
?>
<style>.profile-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 20px; } input:disabled { background-color: #e9ecef; cursor: not-allowed; }</style>

<?php if ($success_message): ?><div class="message success" style="max-width:1440px; margin: 0 auto 20px;"><?php echo $success_message; ?></div><?php endif; ?>
<?php if ($error_message): ?><div class="message error" style="max-width:1440px; margin: 0 auto 20px;"><?php echo $error_message; ?></div><?php endif; ?>

<div class="profile-grid">
    <div class="form-container">
        <h2>Account Information</h2>
        <form>
            <div class="form-group"><label for="full_name">Full Name</label><input type="text" id="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" disabled></div>
            <div class="form-group"><label for="username">Username</label><input type="text" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" disabled></div>
            <div class="form-group"><label for="role">Role</label><input type="text" id="role" value="<?php echo ucfirst($user['role']); ?>" disabled></div>
        </form>
    </div>
    <div class="form-container">
        <h2>Change Password</h2>
        <form method="post" action="profile.php">
            <div class="form-group"><label for="current_password">Current Password</label><input type="password" id="current_password" name="current_password" required></div>
            <div class="form-group"><label for="new_password">New Password</label><input type="password" id="new_password" name="new_password" required></div>
            <div class="form-group"><label for="confirm_password">Confirm New Password</label><input type="password" id="confirm_password" name="confirm_password" required></div>
            <button type="submit" class="btn">Change Password</button>
        </form>
    </div>
</div>
<?php
$page_content = ob_get_clean();
require_once $role . '/includes/' . $role . '_template.php';
?>