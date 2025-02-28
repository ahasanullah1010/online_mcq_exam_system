<?php

session_start();


if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'admin') {
    
        header('Location:../login.php');
}



include '../includes/config.php';
include '../header.php';







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .dashboard {
            display: flex;
            gap: 20px;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            width: 30%;
            min-width: 250px;
            transition: transform 0.3s;
        }

        .card h3 {
            margin-bottom: 10px;
            color: #4CAF50;
        }

        .card p {
            margin-bottom: 15px;
            color: #666;
        }

        .card a {
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
        }

        .card a:hover {
            background-color: #45a049;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <div class="dashboard">
            <!-- Card: View Exam List -->
            <div class="card">
                <h3>View Exam List</h3>
                <p>Manage exams you have created.</p>
                <a href="adminViewExamList.php">View Exams</a>
            </div>

            <!-- Card: Create an Exam -->
            <div class="card">
                <h3>Create an Exam</h3>
                <p>Create a new exam and add questions.</p>
                <a href="adminExamCreate.php">Create Exam</a>
            </div>

            <!-- Card: View Results -->
            <div class="card">
                <h3>View Results</h3>
                <p>Check student performance and scores.</p>
                <a href="adminResultList.php">View Results</a>
            </div>
        </div>
    </div>
</body>
</html>

