
<?php

session_start();

if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'student') {
    
        header('Location:../login.php');
}

include '../includes/config.php';



    // Fetch exams from the exams table
$user_id = $_SESSION['userID'];
$query = "SELECT * FROM exams ORDER BY date DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    
    
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Exam List</title>
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
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        .exam-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .exam-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s;
        }

        .exam-card:hover {
            transform: translateY(-5px);
        }

        .exam-card h3 {
            margin: 0 0 10px;
            color: #4CAF50;
        }

        .exam-card p {
            margin: 5px 0;
            color: #555;
        }

        .exam-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .exam-card a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Student Exam List</h1>
    </header>

    <div class="container">
        <div class="exam-list">

          <?php while ($exam = $result->fetch_assoc()) { ?>

            <div class="exam-card">
                <h3><?= $exam['title']?></h3>
                <p>Description: <?= $exam['description']?></p>
                <p>Starting Date: <?= $exam['date']?></p>
                <a href="exam_details.php?exam_id=<?= $exam['exam_id']?>">View Details</a>
            </div>

          <?php } ?>

        </div>
    </div>
</body>
</html>
