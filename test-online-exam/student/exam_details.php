<?php

session_start();


if (!isset($_SESSION['userID']) && $_SESSION['role'] != 'student') {
    
        header('Location:../login.php');
}



include '../includes/config.php';






?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Online Exam System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100vh;
            background-color: #2c3e50;
            color: #fff;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #34495e;
            color: #fff;
        }

        .sidebar .active {
            background-color: #34495e;
            color: #fff;
        }
        

        .main-content {
            margin-left: 250px;
            padding: 20px;
            
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
            }

            .dropdown-menu {
                position: absolute;
                top: 50px;
                left: 0;
                width: 100%;
                background-color: #2c3e50;
                border: none;
                display: none;
                z-index: 999;
            }

            .dropdown-menu a {
                color: #adb5bd;
                padding: 10px;
                text-decoration: none;
                display: block;
            }

            .dropdown-menu a:hover {
                background-color: #34495e;
                color: #fff;
            }

            
        }

        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
    <!-- Navbar for small screens -->
    <nav class="d-block d-md-none navbar navbar-dark bg-dark">
        <button class="btn btn-dark" id="dropdownBtn">
            <i class="fas fa-bars"></i>
        </button>
        <div id="dropdownMenu" class="dropdown-menu">
            <a href="student_dashboard.php" class="dropdown-item "><i class="fas fa-home me-2"></i> Dashboard</a>
            <a href="upcoming_exam.php" class="dropdown-item"><i class="fas fa-book me-2"></i> Upcoming Exams</a>
            <a href="" class="dropdown-item"><i class="fas fa-user-graduate me-2"></i> Your Performance</a>
            <a href="view_results.php" class="dropdown-item"><i class="fas fa-poll me-2"></i> View Results</a>
            <a href="attempted_exam.php" class=""><i class="bi bi-list-check me-2"></i> Attempted Exams</a>
            <a href="#" class="/dropdown-item"><i class="fas fa-cogs me-2"></i> Settings</a>
            <a href="../logout.php" class="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
        </div>
    </nav>

    <!-- Sidebar for large screens -->
    <div class="sidebar d-none d-md-block">
        <h3 class="text-center py-3">Student Dashboard</h3>
        <a href="student_dashboard.php" class=""><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="upcoming_exam.php" class=""><i class="fas fa-book me-2"></i> Upcoming Exams</a>
        <a href="#"><i class="fas fa-user-graduate me-2"></i> Student Performance</a>
        <a href="view_results.php"><i class="fas fa-poll me-2"></i> View Results</a>
        <a href="attempted_exam.php" class=""> <i class="bi bi-list-check me-2" ></i>  Attempted Exams</a>
        <a href="#"><i class="fas fa-cogs me-2"></i> Settings</a>
        <a href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-4">Exams Details - </h2>
                </div>
            </div>



    <!-- exam details -->
    <div class="container">
    <?php 
        $exam_id = $_GET['exam_id'];
        // Fetch exams from the exams table
        $user_id = $_SESSION['userID'];
        $query = "SELECT * FROM exams where exam_id = $exam_id ";
        $result = $conn->query($query);

        $exam = $result->fetch_assoc();
        if ($result->num_rows > 0) { 
        ?>
        <h2><?= $exam['title'] ?></h2>
        <p><strong>Description: </strong><?= $exam['description'] ?></p>
        <p><strong>Starting Date:</strong> <?= $exam['date'] ?></p>
        <p><strong>Duration:</strong>  <?= $exam['duration'] ?>  minutes</p>
        <p><strong>Number of Questions:</strong> </p>

        <div class="start-exam">
            <a href="exam_page.php?exam_id=<?= $exam['exam_id']?>">Start Exam</a>
        </div>

        <?php } ?>


    </div>
            

           





            
            
        </div>
    </div>

    <script>
        const dropdownBtn = document.getElementById('dropdownBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');

        dropdownBtn.addEventListener('click', () => {
            const isMenuVisible = dropdownMenu.style.display === 'block';
            dropdownMenu.style.display = isMenuVisible ? 'none' : 'block';
        });
    </script>
</body>

</html>









