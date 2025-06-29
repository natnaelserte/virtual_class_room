<?php
// Ensure this file is included, not accessed directly
if (!defined('INCLUDED_IN_PAGE')) {
    header("Location: ../../index.php");
    exit();
}

// Get the current page filename to highlight active link
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Kanenus VC</h2>
    </div>
    <nav class="sidebar-nav">
        <a href="/VCLS/admin/admin_dashboard.php" class="nav-link <?php echo ($current_page == 'admin_dashboard.php') ? 'active' : ''; ?>">
            <i class="icon-dashboard"></i> Dashboard
        </a>
        <a href="/VCLS/admin/manage_users.php" class="nav-link <?php echo ($current_page == 'manage_users.php' || $current_page == 'edit_user.php') ? 'active' : ''; ?>">
            <i class="icon-users"></i> Manage Users
        </a>
        <a href="/VCLS/admin/manage_departments.php" class="nav-link <?php echo ($current_page == 'manage_departments.php' || $current_page == 'edit_department.php') ? 'active' : ''; ?>">
            <i class="icon-departments"></i> Departments
        </a>
        <a href="/VCLS/admin/manage_sections.php" class="nav-link <?php echo ($current_page == 'manage_sections.php' || $current_page == 'edit_section.php') ? 'active' : ''; ?>">
            <i class="icon-sections"></i> Sections
        </a>
        <a href="/VCLS/admin/enroll_students.php" class="nav-link <?php echo ($current_page == 'enroll_students.php') ? 'active' : ''; ?>">
            <i class="icon-enroll"></i> Enrollments
        </a>
        <a href="/VCLS/admin/reports.php" class="nav-link <?php echo ($current_page == 'reports.php') ? 'active' : ''; ?>">
            <i class="icon-reports"></i> Reports
        </a>
        <!-- Messaging and Calendar are not core admin functions, so they are removed for clarity and to fix pathing issues -->
        <a href="/VCLS/logout.php" class="nav-link nav-logout">
            <i class="icon-logout"></i> Logout
        </a>
    </nav>
</aside>