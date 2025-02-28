<?php
// Database configuration
$host = "localhost";        // Hostname (usually 'localhost')
$db_name = "online_exam_system";      // Name of the database
$username = "root";         // Database username
$password = "";             // Database password (leave blank for XAMPP default)

// Create a connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Enable error reporting (for debugging during development)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
