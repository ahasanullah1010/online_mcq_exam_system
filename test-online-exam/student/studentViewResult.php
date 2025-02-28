
<?php


session_start();

if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'student') {
    
        header('Location:../login.php');
}

include '../includes/config.php';

$user_id = $_SESSION['userID'];

$query = "SELECT 
exams.title AS title, exams.date as date, results.score as score, results.total_score as total_score
FROM 
exams
INNER JOIN 
results
ON 
exams.exam_id = results.exam_id
where results.user_id = $user_id";

$result = $conn->query($query);








?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results</title>
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
            max-width: 900px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        .no-results {
            text-align: center;
            color: #555;
            margin-top: 20px;
        }

        .go-to-dashboard {
            text-align: center;
            margin-top: 20px;
        }

        .go-to-dashboard a {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .go-to-dashboard a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Exam Results</h1>
    </header>

    <div class="container">
        <h2>Your Results</h2>
        <table>
            <thead>
                <tr>
                    <th>Exam Title</th>
                    <th>Date</th>
                    <th>Score</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($data = $result->fetch_assoc()) { 
                $status = ($data['score'] / $data['total_score']) * 100 >= 40 ? "Passed" : "Failed";
            ?>
                <tr>
                    <td><?= $data['title'] ?></td>
                    <td><?= $data['date'] ?></td>
                    <td><?= $data['score'] ?> out of <?= $data['total_score'] ?></td>
                    <td><?= $status ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <div class="no-results" style="display: none;">No results available.</div>

        <div class="go-to-dashboard">
            <a href="studentDashboard.php">Go to Dashboard</a>
        </div>
    </div>
</body>
</html>
