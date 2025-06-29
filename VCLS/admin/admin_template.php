<?php
require_once '../includes/auth_check.php';
require_role('admin');

// Define a constant to ensure includes are accessed properly
define('INCLUDED_IN_PAGE', true);

// Connect to the database
require_once '../includes/db_connect.php';

// Set page title (should be set before including this file)
$page_title = $page_title ?? 'Admin Panel';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Kanenus VC Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        :root {
            --primary-color: #003366;
            --secondary-color: #0056b3;
            --accent-color: #007bff;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --border-color: #dee2e6;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: var(--text-color);
        }
        
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 200px;
            background-color: var(--primary-color);
            color: white;
            padding-top: 20px;
            flex-shrink: 0;
        }
        
        .sidebar-header {
            padding: 0 15px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }
        
        .sidebar-nav {
            padding: 20px 0;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        /* Main Content Styles */
        .main-content {
            flex-grow: 1;
            padding: 0;
            background-color: #f5f5f5;
        }
        
        /* Header Styles */
        .header {
            background-color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .header h1 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--primary-color);
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-name {
            margin-right: 10px;
            font-weight: 500;
        }
        
        /* Page Content Styles */
        .page-content {
            padding: 20px;
        }
        
        /* Card Styles */
        .stats-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            flex: 1;
            min-width: 200px;
        }
        
        .stat-card h3 {
            margin-top: 0;
            color: var(--primary-color);
            font-size: 1rem;
            font-weight: 600;
        }
        
        .stat-card .number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--accent-color);
            margin: 10px 0;
        }
        
        /* Table Styles */
        .content-section {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .content-header h2 {
            margin: 0;
            color: var(--primary-color);
            font-size: 1.25rem;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        .data-table th {
            background-color: var(--light-bg);
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .data-table tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: var(--secondary-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
        }
        
        .btn-action {
            padding: 6px 12px;
            margin-right: 5px;
            font-size: 0.8rem;
        }
        
        /* Message Styles */
        .message {
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Kanenus VC</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="admin_dashboard.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php') ? 'active' : ''; ?>">
                    <i>📊</i> Dashboard
                </a>
                <a href="manage_users.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_users.php') ? 'active' : ''; ?>">
                    <i>👥</i> Manage Users
                </a>
                <a href="manage_departments.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_departments.php') ? 'active' : ''; ?>">
                    <i>🏢</i> Departments
                </a>
                <a href="manage_sections.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_sections.php') ? 'active' : ''; ?>">
                    <i>📚</i> Sections
                </a>
                <a href="enroll_students.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'enroll_students.php') ? 'active' : ''; ?>">
                    <i>📝</i> Enrollments
                </a>
                <a href="reports.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'reports.php') ? 'active' : ''; ?>">
                    <i>📈</i> Reports
                </a>
                <a href="../messages.php" class="nav-link">
                    <i>✉️</i> Messages
                </a>
                <a href="../calendar.php" class="nav-link">
                    <i>📅</i> Calendar
                </a>
                <a href="../logout.php" class="nav-link">
                    <i>🚪</i> Logout
                </a>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            <!-- Header with user info -->
            <header class="header">
                <h1><?php echo $page_title; ?></h1>
                <div class="user-info">
                    <span class="user-name"><?php echo $_SESSION['full_name'] ?? $_SESSION['username']; ?></span>
                    <span class="user-role">Administrator</span>
                </div>
            </header>

            <!-- Page content goes here -->
            <div class="page-content">
                <?php if (isset($success_message) && !empty($success_message)): ?>
                    <div class="message success"><?php echo $success_message; ?></div>
                <?php endif; ?>
                
                <?php if (isset($error_message) && !empty($error_message)): ?>
                    <div class="message error"><?php echo $error_message; ?></div>
                <?php endif; ?>
                
                <!-- Content will be inserted here -->
                <?php if (isset($content_file) && file_exists($content_file)): ?>
                    <?php include $content_file; ?>
                <?php endif; ?>
                
                <!-- If no content file is specified, the page should provide its own content -->
            </div>
        </main>
    </div>

</body>
</html>