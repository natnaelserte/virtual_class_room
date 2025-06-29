<?php
// Ensure this file is included, not accessed directly
if (!defined('INCLUDED_IN_PAGE')) {
    header("Location: ../../index.php");
    exit();
}
?>
<header class="main-header">
    <h1><?php echo htmlspecialchars($page_title ?? 'Student Panel'); ?></h1>
    <div class="user-info">
        <span class="user-name"><?php echo htmlspecialchars($_SESSION['full_name'] ?? $_SESSION['username']); ?></span>
        <span class="user-role">Student</span>
    </div>
</header>