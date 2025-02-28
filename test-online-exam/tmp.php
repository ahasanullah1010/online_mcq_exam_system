<?php


// $time = new DateTime();
// date_default_timezone_set('Asia/Dhaka');


// if(date("Y-m-d H:i:s") < '2025-01-15 19:22:00'){
//     echo "upcoming";
//     echo date("Y-m-d H:i:s");
// }
// else{
//     echo "finished";
// }

?>







<?php

session_start();

if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'student') {
    
        header('Location:../login.php');
}

include '../includes/config.php';


$exam_id = $_GET['exam_id'];
    // Fetch exams from the exams table
$user_id = $_SESSION['userID'];
$query = "SELECT * FROM exams where exam_id = $exam_id ";
$result = $conn->query($query);

$exam = $result->fetch_assoc();
    
    



?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Details</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #4CAF50;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            line-height: 1.6;
            margin: 10px 0;
        }

        .start-exam {
            text-align: center;
            margin-top: 20px;
        }

        .start-exam a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .start-exam a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Exam Details</h1>
    </header>

    <div class="container">
    <?php if ($result->num_rows > 0) { ?>
        <h2><?= $exam['title'] ?></h2>
        <p><strong>Description: </strong><?= $exam['description'] ?></p>
        <p><strong>Starting Date:</strong> <?= $exam['date'] ?></p>
        <p><strong>Duration:</strong>  <?= $exam['duration'] ?>  minutes</p>
        <p><strong>Number of Questions:</strong> </p>

        <div class="start-exam">
            <a href="examQuestion.php?exam_id=<?= $exam['exam_id']?>">Start Exam</a>
        </div>

        <?php } ?>


    </div>
</body>
</html>
