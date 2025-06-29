<?php
require_once '../includes/auth_check.php';
require_role('admin');
$page_title = 'Manage Departments';
require_once '../includes/db_connect.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_department'])) {
        $name = trim($_POST['name']);
        if (!empty($name)) {
            $stmt = $conn->prepare("INSERT INTO departments (name) VALUES (?)");
            $stmt->bind_param("s", $name);
            if ($stmt->execute()) {
                $success_message = "Department created successfully!";
            } else {
                $error_message = "A department with this name might already exist.";
            }
            $stmt->close();
        } else {
            $error_message = "Department name cannot be empty.";
        }
    }
    if (isset($_POST['delete_department'])) {
        $department_id = $_POST['department_id'];
        $stmt = $conn->prepare("DELETE FROM departments WHERE id = ?");
        $stmt->bind_param("i", $department_id);
        if ($stmt->execute()) {
            $success_message = "Department deleted successfully!";
        } else {
            $error_message = "Error deleting department. It might be in use by sections.";
        }
        $stmt->close();
    }
}

$departments_result = $conn->query("SELECT * FROM departments ORDER BY name ASC");

ob_start();
?>
<!-- THIS IS THE FIX: Adding the same style block to this page -->
<style>
.actions-cell {
    display: flex;
    gap: 10px; /* Adds a nice space between the buttons */
    align-items: center; /* Vertically aligns them in the middle of the cell */
}
.actions-cell form {
    margin: 0; /* Removes default form margins to help with alignment */
}
</style>

<?php if ($success_message): ?><div class="message success"><?php echo $success_message; ?></div><?php endif; ?>
<?php if ($error_message): ?><div class="message error"><?php echo $error_message; ?></div><?php endif; ?>

<!-- Create Department Form -->
<div class="form-container">
    <h2>Add New Department</h2>
    <form action="manage_departments.php" method="post">
        <div class="form-group"><label for="name">Department Name:</label><input type="text" id="name" name="name" required></div>
        <button type="submit" name="create_department" class="btn">Create Department</button>
    </form>
</div>

<!-- List of Existing Departments -->
<div class="table-container-dash">
    <h2>Existing Departments</h2>
    <table>
        <thead><tr><th>Department Name</th><th>Actions</th></tr></thead>
        <tbody>
            <?php if ($departments_result->num_rows > 0): ?>
                <?php while($row = $departments_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <!-- Applying the new class to the table cell -->
                        <td class="actions-cell">
                            <a href="edit_department.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                            <form action="manage_departments.php" method="post" onsubmit="return confirm('Are you sure? This action cannot be undone.');">
                                <input type="hidden" name="department_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_department" class="btn btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="2">No departments found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
$page_content = ob_get_clean();
require 'includes/admin_template.php';
$conn->close();
?>