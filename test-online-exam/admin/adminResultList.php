
<?php

session_start();

if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'admin') {
    
        header('Location:../login.php');
}

include '../includes/config.php';



    // Fetch exams from the exams table
$user_id = $_SESSION['userID'];
$query = "SELECT * FROM exams WHERE user_id = $user_id  ";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    
    
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Exam Results</title>
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
            max-width: 1000px;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        .view-link {
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .view-link:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Exam Results</h1>
    </header>

    <div class="container">
        <h1>Results for all Exams</h1>
        <table>
            <thead>
                <tr>
                    <th>Exam Title</th>
                    <th>Date</th>
                    <th>View Results</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($exam = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $exam['title'] ?></td>
                    <td><?= $exam['date'] ?></td>
                    <td><a href="adminViewResult.php?exam_id=<?= $exam['exam_id'] ?>" class="view-link">View Results</a></td>
                </tr>
                <?php } ?>


            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2024 Online Exam Platform. All rights reserved.</p>
    </footer>
</body>
</html>
