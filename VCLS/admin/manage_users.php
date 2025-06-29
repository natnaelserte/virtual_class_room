<?php
require_once '../includes/auth_check.php';
require_role('admin');
$page_title = 'Manage Users';
require_once '../includes/db_connect.php';

$success_message = '';
$error_message = '';

// PHP logic for form submission remains exactly the same
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_user'])) {
        $full_name = trim($_POST['full_name']);
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $role = $_POST['role'];
        $gender = $_POST['gender']; 

        if (empty($full_name) || empty($username) || empty($password) || empty($role) || empty($gender)) {
            $error_message = "All fields are required.";
        } else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $error_message = "This username is already taken.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_stmt = $conn->prepare("INSERT INTO users (full_name, username, password, role, gender) VALUES (?, ?, ?, ?, ?)");
                $insert_stmt->bind_param("sssss", $full_name, $username, $hashed_password, $role, $gender);
                if ($insert_stmt->execute()) {
                    $success_message = "User '" . htmlspecialchars($username) . "' created successfully!";
                } else {
                    $error_message = "Error creating user.";
                }
                $insert_stmt->close();
            }
            $stmt->close();
        }
    }
    if (isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];
        if ($user_id == $_SESSION['user_id']) {
            $error_message = "You cannot delete your own account.";
        } else {
            $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                $success_message = "User deleted successfully!";
            } else {
                $error_message = "Error deleting user. They may be linked to sections or other data.";
            }
            $stmt->close();
        }
    }
}

$users_result = $conn->query("SELECT id, full_name, username, role, gender, created_at FROM users WHERE role != 'admin' ORDER BY role, full_name");

ob_start();
?>
<style>
.actions-cell { display: flex; gap: 10px; align-items: center; }
/* Styles for the toggle button and collapsible form */
#add-user-form-container {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s ease-out;
    border: 1px solid transparent; /* Start with transparent border */
    border-radius: 8px;
}
#add-user-form-container.show {
    max-height: 600px; /* Adjust this value if your form is taller */
    border-color: #e9ecef; /* Show border when open */
    margin-top: 20px;
}
.toggle-form-button {
    margin-bottom: 20px;
    display: inline-block;
    font-weight: 500;
}
</style>

<?php if ($success_message): ?><div class="message success"><?php echo $success_message; ?></div><?php endif; ?>
<?php if ($error_message): ?><div class="message error"><?php echo $error_message; ?></div><?php endif; ?>

<!-- Button to toggle the form visibility -->
<button id="toggle-form-btn" class="btn toggle-form-button">
    <span class="plus-icon">+</span> Add New User
</button>

<!-- Collapsible Form Container -->
<div id="add-user-form-container">
    <div class="form-container" style="box-shadow:none; margin:0; max-width:none;">
        <h2>Add New User</h2>
        <form action="manage_users.php" method="post">
            <div class="form-group"><label for="full_name">Full Name:</label><input type="text" id="full_name" name="full_name" required></div>
            <div class="form-group"><label for="username">Username:</label><input type="text" id="username" name="username" required></div>
            <div class="form-group"><label for="password">Password:</label><input type="password" id="password" name="password" required></div>
            <div class="form-group"><label for="role">Role:</label><select id="role" name="role" required><option value="">-- Select a Role --</option><option value="teacher">Teacher</option><option value="student">Student</option></select></div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">-- Select Gender --</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="not_specified">Prefer not to say</option>
                </select>
            </div>
            <button type="submit" name="create_user" class="btn">Create User</button>
        </form>
    </div>
</div>

<!-- List of Existing Users -->
<div class="table-container-dash" style="margin-top: 20px;">
    <h2>Existing Users</h2>
    <table>
        <thead><tr><th>Full Name</th><th>Username</th><th>Role</th><th>Gender</th><th>Actions</th></tr></thead>
        <tbody>
            <?php if ($users_result->num_rows > 0): ?>
                <?php while($row = $users_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo ucfirst($row['role']); ?></td>
                        <td><?php echo ucfirst(str_replace('_', ' ', $row['gender'] ?? 'N/A')); ?></td>
                        <td class="actions-cell">
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                            <form action="manage_users.php" method="post" style="margin:0;" onsubmit="return confirm('Are you sure? This action cannot be undone.');">
                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_user" class="btn btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">No student or teacher users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggle-form-btn');
    const formContainer = document.getElementById('add-user-form-container');

    toggleBtn.addEventListener('click', function() {
        // The class 'show' will be added or removed
        formContainer.classList.toggle('show');

        // Optional: change button text
        const icon = toggleBtn.querySelector('.plus-icon');
        if (formContainer.classList.contains('show')) {
            icon.textContent = '-';
        } else {
            icon.textContent = '+';
        }
    });
});
</script>

<?php
$page_content = ob_get_clean();
require 'includes/admin_template.php';
$conn->close();
?>