<?php
/*
* This file connects the application to the database.
* We are using MySQLi with the object-oriented approach.
*/

// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Default XAMPP password is an empty string
define('DB_NAME', 'virtual_class_db');

// Create a new database connection object
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check for a connection error
if ($conn->connect_error) {
    // If there is an error, stop the script and display the error message
    die("Connection Failed: " . $conn->connect_error);
}

// Optional: Set the character set to utf8mb4 for full Unicode support
$conn->set_charset("utf8mb4");
?>