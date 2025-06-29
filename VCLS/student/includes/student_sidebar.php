<?php
// Ensure this file is included, not accessed directly
if (!defined('INCLUDED_IN_PAGE')) {
    header("Location: /VCLS/index.php");
    exit();
}
// Get the current page filename to highlight active link
$current_page = basename($_SERVER['PHP_SELF']);
$root_url = '/VCLS';
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Kanenus VC</h2>
    </div>
    <nav class="sidebar-nav">
        <a href="<?php echo $root_url; ?>/student/student_dashboard.php" class="nav-link <?php echo ($current_page == 'student_dashboard.php') ? 'active' : ''; ?>">
            <i class="icon-dashboard"></i> Dashboard
        </a>
        <a href="<?php echo $root_url; ?>/student/my_courses.php" class="nav-link <?php echo ($current_page == 'my_courses.php' || $current_page == 'view_section.php') ? 'active' : ''; ?>">
            <i class="icon-sections"></i> My Courses
        </a>
        <a href="<?php echo $root_url; ?>/student/assignments.php" class="nav-link <?php echo ($current_page == 'assignments.php' || $current_page == 'submit_assignment.php') ? 'active' : ''; ?>">
            <i class="icon-assignments"></i> Assignments
        </a>
        <a href="<?php echo $root_url; ?>/student/grades.php" class="nav-link <?php echo ($current_page == 'grades.php') ? 'active' : ''; ?>">
            <i class="icon-grades"></i> My Grades
        </a>
        <a href="<?php echo $root_url; ?>/calendar.php" class="nav-link <?php echo ($current_page == 'calendar.php') ? 'active' : ''; ?>">
            <i class="icon-calendar"></i> Calendar
        </a>
        <a href="<?php echo $root_url; ?>/messages.php" class="nav-link <?php echo (in_array($current_page, ['messages.php', 'view_message.php', 'compose_message.php'])) ? 'active' : ''; ?>">
            <i class="icon-messages"></i> Messages
        </a>
        <a href="<?php echo $root_url; ?>/profile.php" class="nav-link <?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">
            <i class="icon-profile"></i> My Profile
        </a>
        <a href="<?php echo $root_url; ?>/logout.php" class="nav-link nav-logout">
            <i class="icon-logout"></i> Logout
        </a>
    </nav>
</aside>