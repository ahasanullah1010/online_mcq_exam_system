

<?php

session_start();

if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'student') {
    
        header('Location:../login.php');
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        nav {
            background-color: #4CAF50;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            color: white;
        }

        nav .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 15px;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #45a049;
        }

        nav .menu-toggle {
            display: none;
            font-size: 28px;
            cursor: pointer;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            flex: 1;
        }

        .dashboard {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 25px;
            width: 300px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        }

        .card h3 {
            margin-bottom: 15px;
        }

        .card a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: white;
            color: #4CAF50;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }

        .card a:hover {
            background-color: #4CAF50;
            color: white;
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
            nav ul {
                display: none;
                flex-direction: column;
                background-color: #4CAF50;
                position: absolute;
                top: 60px;
                right: 0;
                width: 100%;
                text-align: center;
                padding: 10px 0;
                border-radius: 0 0 12px 12px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            nav ul.active {
                display: flex;
            }

            nav .menu-toggle {
                display: block;
            }

            .dashboard {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <nav>
        <a href="../dashboard.php" class="logo">Online Exam</a>
        <span class="menu-toggle" onclick="toggleMenu()">☰</span>
        <ul>
            <li><a href="../dashboard.php">Dashboard</a></li>
            <li><a href="studentProfile.php">Profile</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="dashboard">
            <div class="card">
                <h3>See Exam List</h3>
                <p>Browse all available exams and get started.</p>
                <a href="studentExamList.php">View Exams</a>
            </div>

            <div class="card">
                <h3>See Results</h3>
                <p>Check your performance and scores.</p>
                <a href="studentViewResult.php">View Results</a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Online Exam Platform. All rights reserved.</p>
    </footer>

    <script>
        function toggleMenu() {
            const navMenu = document.querySelector("nav ul");
            navMenu.classList.toggle("active");
        }
    </script>
</body>
</html>
