<?php
// Include the database connection
require_once 'includes/db_connect.php';

// --- Admin User Details ---
$username = 'admin';
$password = 'admin123'; // The password we want to set
$full_name = 'System Administrator';
$role = 'admin';

// IMPORTANT: Hash the password for security
// We use PHP's built-in password_hash() function.
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if the admin user already exists to avoid errors
$check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$check_stmt->bind_param("s", $username);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    echo "Admin user already exists. No action taken.";
} else {
    // The user does not exist, so let's insert them
    // Prepare an SQL statement to insert the new user
    $stmt = $conn->prepare("INSERT INTO users (username, password, full_name, role) VALUES (?, ?, ?, ?)");

    // Bind the variables to the statement's placeholders
    // 'ssss' means we are binding four string variables
    $stmt->bind_param("ssss", $username, $hashed_password, $full_name, $role);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "<h1>Success!</h1>";
        echo "<p>Admin user created successfully.</p>";
        echo "<p><strong>Username:</strong> " . htmlspecialchars($username) . "</p>";
        echo "<p><strong>Password:</strong> " . htmlspecialchars($password) . " (Use this to log in)</p>";
    } else {
        echo "<h1>Error!</h1>";
        echo "<p>Could not create admin user: " . $stmt->error . "</p>";
    }

    // Close the statement
    $stmt->close();
}

$check_stmt->close();
// Close the database connection
$conn->close();
?>