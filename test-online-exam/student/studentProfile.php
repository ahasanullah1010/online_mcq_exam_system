
<?php


session_start();

if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'student') {
    
        header('Location:../login.php');
}

include '../includes/config.php';

$user_id = $_SESSION['userID'];

$query = "SELECT * FROM users where user_id = $user_id ";
$result = $conn->query($query);

$student = $result->fetch_assoc();






?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .logout {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .logout a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            background-color: #f44336;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .logout a:hover {
            background-color: #d32f2f;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-header h1 {
            color: #4CAF50;
        }

        .profile-info {
            display: grid;
            grid-template-columns: 150px auto;
            gap: 20px;
            align-items: start;
        }

        .profile-picture {
            text-align: center;
        }

        .profile-picture img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #4CAF50;
        }

        .profile-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .profile-details div {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .profile-details div span:first-child {
            font-weight: bold;
            color: #555;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }
        @media (max-width: 768px) {
    .profile-info {
        grid-template-columns: 1fr; /* Stack profile picture and details vertically */
        text-align: center; /* Center-align text */
    }

    .profile-details {
        gap: 15px; /* Increase spacing for readability */
    }

    .logout {
        position: static; /* Place below the header text */
        margin-top: 10px;
    }

    .logout a {
        display: block; /* Make the logout button span the full width */
        text-align: center;
    }
}

    </style>
</head>
<body>
    <header>
        <h1>Student Profile</h1>
        <div class="logout">
            <a href="../logout.php">Logout</a>
        </div>
    </header>

    <div class="container">
        <div class="profile-header">
            <h1>John Doe</h1>
            <p>Student at Online Exam Platform</p>
        </div>

        <div class="profile-info">
            <div class="profile-picture">
                <img src="https://via.placeholder.com/120" alt="Profile Picture">
            </div>

            <div class="profile-details">
                <div>
                    <span>Name:</span>
                    <span><?= $student['username'] ?></span>
                </div>
                <div>
                    <span>Email:</span>
                    <span><?= $student['username'] ?></span>
                </div>
                <div>
                    <span>Enrollment Number:</span>
                    <span><?= $student['user_id'] ?></span>
                </div>
                <div>
                    <span>Joined Date:</span>
                    <span><?= $student['created_at'] ?></span>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Online Exam Platform. All rights reserved.</p>
    </footer>
</body>
</html>
