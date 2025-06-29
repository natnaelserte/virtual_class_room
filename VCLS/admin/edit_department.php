<?php
$page_title = 'Edit Department';
require_once '../includes/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: manage_departments.php");
    exit();
}
$department_id = (int)$_GET['id'];
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    if (!empty($name)) {
        $stmt = $conn->prepare("UPDATE departments SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $department_id);
        if ($stmt->execute()) {
            header("Location: manage_departments.php?update=success");
            exit();
        } else {
            $error_message = "Error updating department.";
        }
        $stmt->close();
    } else {
        $error_message = "Department name cannot be empty.";
    }
}

$stmt = $conn->prepare("SELECT name FROM departments WHERE id = ?");
$stmt->bind_param("i", $department_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    $department = $result->fetch_assoc();
} else {
    header("Location: manage_departments.php");
    exit();
}
$stmt->close();

ob_start();
?>

<p><a href="manage_departments.php">← Back to Departments List</a></p>

<?php if ($error_message): ?><div class="message error"><?php echo $error_message; ?></div><?php endif; ?>

<div class="form-container">
    <form action="edit_department.php?id=<?php echo $department_id; ?>" method="post">
        <div class="form-group">
            <label for="name">Department Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($department['name']); ?>" required>
        </div>
        <button type="submit" class="btn">Update Department</button>
    </form>
</div>

<?php
$page_content = ob_get_clean();
require 'includes/admin_template.php';
$conn->close();
?>