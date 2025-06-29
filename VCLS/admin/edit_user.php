<?php
require_once '../includes/auth_check.php';
require_role('admin');
$page_title = 'Edit User';
require_once '../includes/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: /VCLS/admin/manage_users.php");
    exit();
}
$user_id = (int)$_GET['id'];
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $role = $_POST['role'];
    $gender = $_POST['gender'];
    $new_password = $_POST['new_password'];

    if (empty($full_name) || empty($username) || empty($role) || empty($gender)) {
        $error_message = "Full name, username, role, and gender are required.";
    } else {
        $stmt_check = $conn->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
        $stmt_check->bind_param("si", $username, $user_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        
        if ($result_check->num_rows > 0) {
            $error_message = "That username is already taken by another user.";
        } else {
            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_stmt = $conn->prepare("UPDATE users SET full_name = ?, username = ?, role = ?, gender = ?, password = ? WHERE id = ?");
                $update_stmt->bind_param("sssssi", $full_name, $username, $role, $gender, $hashed_password, $user_id);
            } else {
                $update_stmt = $conn->prepare("UPDATE users SET full_name = ?, username = ?, role = ?, gender = ? WHERE id = ?");
                $update_stmt->bind_param("ssssi", $full_name, $username, $role, $gender, $user_id);
            }

            if ($update_stmt->execute()) {
                header("Location: /VCLS/admin/manage_users.php?update=success");
                exit();
            } else {
                $error_message = "Error updating user.";
            }
            $update_stmt->close();
        }
        $stmt_check->close();
    }
}

$stmt = $conn->prepare("SELECT full_name, username, role, gender FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    header("Location: /VCLS/admin/manage_users.php");
    exit();
}
$stmt->close();

ob_start();
?>
<div class="form-container">
    <p><a href="manage_users.php">← Back to Users List</a></p>
    <h2>Edit User</h2>
    <?php if ($error_message): ?><div class="message error"><?php echo $error_message; ?></div><?php endif; ?>
    <form action="edit_user.php?id=<?php echo $user_id; ?>" method="post">
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
                <option value="teacher" <?php if ($user['role'] == 'teacher') echo 'selected'; ?>>Teacher</option>
            </select>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male" <?php if ($user['gender'] == 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if ($user['gender'] == 'female') echo 'selected'; ?>>Female</option>
                <option value="not_specified" <?php if ($user['gender'] == 'not_specified') echo 'selected'; ?>>Prefer not to say</option>
            </select>
        </div>
        <div class="form-group">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" placeholder="Leave blank to keep current password">
            <small style="display: block; margin-top: 5px; color: #666;">Only enter a value here if you want to change the user's password.</small>
        </div>
        <button type="submit" class="btn">Update User</button>
    </form>
</div>
<?php
$page_content = ob_get_clean();
require 'includes/admin_template.php';
$conn->close();
?>