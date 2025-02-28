
<?php


session_start();

if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'admin') {
    
        header('Location:../login.php');
}

include '../includes/config.php';

$user_id = $_SESSION['userID'];
$exam_id = $_GET['exam_id'];
$query = "SELECT 
results.score AS score, results.total_score as total_score, users.username as username, users.user_id as id
FROM 
results
INNER JOIN 
users
ON 
results.user_id = users.user_id
where results.exam_id = $exam_id";

$result = $conn->query($query);








?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Exams Results</title>
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
        <h2>Exam Results</h2>
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                
                 <?php while ($data = $result->fetch_assoc()) { ?>
                <tr>
                    <td> <?= $data['id']?> </td>
                    <td><?= $data['username']?></td>
                    <td><?= $data['score']?> out of <?= $data['total_score']?> </td>
                    
                </tr>

                <?php } ?>
                

                
            </tbody>
        </table>
    </div>
</body>
</html>
