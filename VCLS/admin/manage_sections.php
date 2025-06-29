<?php
require_once '../includes/auth_check.php';
require_role('admin');
$page_title = 'Manage Sections';
require_once '../includes/db_connect.php';

$success_message = '';
$error_message = '';
// PHP logic for form submission remains exactly the same
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_section'])) {
        $name = trim($_POST['name']);
        $department_id = $_POST['department_id'];
        $teacher_id = $_POST['teacher_id'];
        if (!empty($name) && !empty($department_id) && !empty($teacher_id)) {
            $stmt = $conn->prepare("INSERT INTO sections (name, department_id, teacher_id) VALUES (?, ?, ?)");
            $stmt->bind_param("sii", $name, $department_id, $teacher_id);
            if ($stmt->execute()) { $success_message = "Section created successfully!"; } else { $error_message = "Error creating section."; }
            $stmt->close();
        } else { $error_message = "All fields are required."; }
    }
    if (isset($_POST['delete_section'])) {
        $section_id = $_POST['section_id'];
        $stmt = $conn->prepare("DELETE FROM sections WHERE id = ?");
        $stmt->bind_param("i", $section_id);
        if ($stmt->execute()) { $success_message = "Section deleted successfully!"; } else { $error_message = "Error deleting section. It may have associated data."; }
        $stmt->close();
    }
}

$departments = $conn->query("SELECT id, name FROM departments ORDER BY name");
$teachers = $conn->query("SELECT id, full_name FROM users WHERE role = 'teacher' ORDER BY full_name");
$sections_sql = "SELECT s.id, s.name AS section_name, d.name AS department_name, u.full_name AS teacher_name FROM sections s LEFT JOIN departments d ON s.department_id = d.id LEFT JOIN users u ON s.teacher_id = u.id ORDER BY department_name, section_name";
$sections_result = $conn->query($sections_sql);

ob_start();
?>
<style>
.actions-cell { display: flex; gap: 10px; align-items: center; }
.actions-cell form { margin: 0; }
/* Styles for the toggle button and collapsible form */
#add-section-form-container {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s ease-out;
    border: 1px solid transparent; /* Start with transparent border */
    border-radius: 8px;
    background-color: #fff; /* Give it a background for the animation */
    margin-bottom: 20px;
}
#add-section-form-container.show {
    max-height: 500px; /* Adjust this value if your form is taller */
    border-color: #e9ecef; /* Show border when open */
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
    <span class="plus-icon">+</span> Add New Section
</button>

<!-- Collapsible Create Section Form -->
<div id="add-section-form-container">
    <div class="form-container" style="box-shadow:none; margin:0; max-width:none;">
        <h2>Add New Section</h2>
        <form action="manage_sections.php" method="post">
            <div class="form-group"><label for="name">Section Name:</label><input type="text" id="name" name="name" required></div>
            <div class="form-group"><label for="department_id">Department:</label><select id="department_id" name="department_id" required><option value="">-- Select a Department --</option><?php mysqli_data_seek($departments, 0); while ($dept = $departments->fetch_assoc()): ?><option value="<?php echo $dept['id']; ?>"><?php echo htmlspecialchars($dept['name']); ?></option><?php endwhile; ?></select></div>
            <div class="form-group"><label for="teacher_id">Assign Teacher:</label><select id="teacher_id" name="teacher_id" required><option value="">-- Select a Teacher --</option><?php mysqli_data_seek($teachers, 0); while ($teacher = $teachers->fetch_assoc()): ?><option value="<?php echo $teacher['id']; ?>"><?php echo htmlspecialchars($teacher['full_name']); ?></option><?php endwhile; ?></select></div>
            <button type="submit" name="create_section" class="btn">Create Section</button>
        </form>
    </div>
</div>

<!-- List of Existing Sections -->
<div class="table-container-dash">
    <h2>Existing Sections</h2>
    <table>
        <thead><tr><th>Section Name</th><th>Department</th><th>Teacher</th><th>Actions</th></tr></thead>
        <tbody>
            <?php if ($sections_result && $sections_result->num_rows > 0): ?>
                <?php while($row = $sections_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['section_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['department_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['teacher_name'] ?? 'Not Assigned'); ?></td>
                        <td class="actions-cell">
                            <a href="edit_section.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                            <form action="manage_sections.php" method="post" onsubmit="return confirm('Are you sure? This action cannot be undone.');">
                                <input type="hidden" name="section_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_section" class="btn btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">No sections found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggle-form-btn');
    const formContainer = document.getElementById('add-section-form-container');

    toggleBtn.addEventListener('click', function() {
        formContainer.classList.toggle('show');

        const icon = toggleBtn.querySelector('.plus-icon');
        if (formContainer.classList.contains('show')) {
            icon.textContent = '- ';
        } else {
            icon.textContent = '+ ';
        }
    });

    // If there was an error submitting the form, show it by default
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_section']) && !empty($error_message)): ?>
        formContainer.classList.add('show');
        toggleBtn.querySelector('.plus-icon').textContent = '- ';
    <?php endif; ?>
});
</script>

<?php
$page_content = ob_get_clean();
require 'includes/admin_template.php';
$conn->close();
?>