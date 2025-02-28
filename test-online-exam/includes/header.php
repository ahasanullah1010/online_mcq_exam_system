<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online MCQ Exam</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f9f9f9;
    color: #333;
}

        /* Header */
header {
    background-color: #4CAF50;
    color: white;
    padding: 15px 0;
    text-align: center;
    margin-bottom: 20px;
}

header h1 {
    font-size: 24px;
}

nav ul {
    list-style: none;
    padding: 0;
    text-align: center;
}

nav ul li {
    display: inline;
    margin: 0 10px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="">
                <h1>Online MCQ Exam</h1>
                <ul>
                    
                        <li><a href="adminDashboard.php">Dashboard</a></li>
                        <li><a href="results.php">Results</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    
                        
                </ul>
            </div>
        </nav>
    </header>
    <main>
