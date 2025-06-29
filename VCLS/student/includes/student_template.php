<?php
// This is the master template for the student dashboard.

// CORRECTED: Use an absolute server path.
require_once $_SERVER['DOCUMENT_ROOT'] . '/VCLS/includes/auth_check.php';
require_role('student');

define('INCLUDED_IN_PAGE', true);
$page_title = $page_title ?? 'Student Panel';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - Kanenus VC Student</title>
    <!-- CORRECTED: Use an absolute web path -->
    <link rel="stylesheet" href="/VCLS/assets/css/dashboard.css">
    <?php if (isset($additional_css) && is_array($additional_css)): ?>
        <?php foreach ($additional_css as $css_file): ?>
            <link rel="stylesheet" href="<?php echo htmlspecialchars($css_file); ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <div class="dashboard-container">
        <?php include __DIR__ . '/student_sidebar.php'; ?>
        <main class="main-content">
            <?php include __DIR__ . '/student_header.php'; ?>
            <div class="page-content">
                <?php if (isset($page_content)) { echo $page_content; } ?>
            </div>
        </main>
    </div>
    <?php if (isset($additional_js) && is_array($additional_js)): ?>
        <?php foreach ($additional_js as $js_file): ?>
            <script src="<?php echo htmlspecialchars($js_file); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>