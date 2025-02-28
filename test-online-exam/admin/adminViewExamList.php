
<?php

session_start();

if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'admin') {
    
        header('Location:../login.php');
}

include '../includes/config.php';
include '../header.php';


    // Fetch exams from the exams table
$user_id = $_SESSION['userID'];
$query = "SELECT * FROM exams where user_id = $user_id ORDER BY date DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    
    
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Exams</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .create-exam-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-size: 16px;
        }

        .create-exam-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="adminExamCreate.php" class="create-exam-button">Create New Exam</a>
        <h2>All Exams Created by Admin</h2>
        <table>
            <thead>
                <tr>
                    <th>Exam Title</th>
                    <th>Description</th>
                    <th>Starting Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
                 <?php while ($exam = $result->fetch_assoc()) { ?>
                <tr>
                    <td> <?= $exam['title']?> </td>
                    <td><?= $exam['description']?></td>
                    <td><?= $exam['date']?></td>
                    <!--  <td><a href="view_questions.php?exam_id=1">View Questions</a></td>  -->
                    <td><a href="adminSetQuestion.php?exam_id=<?= $exam['exam_id']?>">View Questions</a></td>
                </tr>

                <?php } ?>
                

                
            </tbody>
        </table>
    </div>
</body>
</html>
