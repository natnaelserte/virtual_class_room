<?php
// Start session if it has not already been started.
// This is the most reliable place to put this, as it's included first on all protected pages.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// This function will be called at the top of every protected page.
// We pass the required role as an argument, e.g., 'admin' or 'teacher'.
function require_role($role) {
    // 1. Check if the 'user_id' session variable exists. If not, they're not logged in.
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the main login page
        // Using a more robust path
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/VCLS/login.php");
        exit(); // Stop the script immediately
    }
    
    // 2. Check if the logged-in user's role matches the required role.
    if ($_SESSION['role'] !== $role) {
        // If the role is incorrect, deny access and show an error message.
        // This prevents a student from accessing a teacher's page, for example.
        http_response_code(403); // Set a "Forbidden" HTTP status code
        die("<h1>Access Denied</h1><p>You do not have permission to view this page.</p>");
    }
}
?>