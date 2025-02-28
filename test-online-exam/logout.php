<?php
session_start();

// Destroy the session and clear all session variables
session_unset();
session_destroy();

// Remove the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, "/");
}

// Redirect the user to the login page
header('Location: index.php');
exit;
?>
