

<?php

session_start();

if (!isset($_SESSION['userID']) && $_SESSION['role'] != 'admin') {
    
        header('Location:../login.php');
}

include '../includes/config.php';



    // Fetch exams from the exams table
$user_id = $_SESSION['userID'];
date_default_timezone_set('Asia/Dhaka');
$d = date("Y-m-d H:i:s");
$query = "SELECT * FROM exams WHERE user_id = $user_id AND date < '$d' ";
$result = $conn->query($query);




?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Results - Online Exam System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        .filter-form {
            margin-bottom: 20px;
        }

        .table-responsive {
            overflow-x: auto;
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
            <a href="adminDashboard.php" class="dropdown-item"><i class="fas fa-home me-2"></i> Dashboard</a>
            <a href="manage_exam.php" class="dropdown-item"><i class="fas fa-book me-2"></i> Manage Exams</a>
            <a href="#" class="dropdown-item"><i class="fas fa-user-graduate me-2"></i> Student Performance</a>
            <a href="view_results.php" class="dropdown-item"><i class="fas fa-poll me-2"></i> View Results</a>
            <a href="create_new_exam.php" class=""><i class="fas fa-plus me-2"></i> Add New Exam</a>
            <a href="add_question_to_exam.php" class=""><i class="fas fa-plus me-2"></i> Set Questions </a>
            <a href="#" class="dropdown-item"><i class="fas fa-envelope me-2"></i> Messages</a>
            <a href="#" class="dropdown-item"><i class="fas fa-cogs me-2"></i> Settings</a>
            <a href="../logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
        </div>
    </nav>

    <!-- Sidebar for large screens -->
    <div class="sidebar d-none d-md-block">
        <h3 class="text-center py-3">Teacher Dashboard</h3>
        <a href="adminDashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="manage_exam.php"><i class="fas fa-book me-2"></i> Manage Exams</a>
        <a href="#"><i class="fas fa-user-graduate me-2"></i> Student Performance</a>
        <a href="view_results.php" class="active"><i class="fas fa-poll me-2"></i> View Results</a>
        <a href="create_new_exam.php" class=""><i class="fas fa-plus me-2"></i> Add New Exam</a>
        <a href="add_question_to_exam.php" class=""><i class="fas fa-plus me-2"></i> Set Questions </a>
        <a href="#"><i class="fas fa-envelope me-2"></i> Messages</a>
        <a href="#"><i class="fas fa-cogs me-2"></i> Settings</a>
        <a href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <h2 class="mb-4">View Exam Results</h2>

            <!-- Filter Form -->
            <div class="filter-form">
                <form class="d-flex">
                    <div class="me-3">
                        <input type="text" class="form-control" placeholder="Search by exam title">
                    </div>
                    <div class="me-3">
                        <select class="form-select">
                            <option selected>Filter by Exam Date</option>
                            <option value="1">Last 7 days</option>
                            <option value="2">Last 30 days</option>
                            <option value="3">This Year</option>
                        </select>
                    </div>
                    <div class="me-3">
                        <select class="form-select">
                            <option selected>Filter by Status</option>
                            <option value="1">Scheduled</option>
                            <option value="2">Completed</option>
                            <option value="3">Pending</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </form>
            </div>

            <!-- Results Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Exam Results List</h5>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Exam Title</th>
                                <th>Description</th>
                                <th>Exam Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if ($result->num_rows > 0) {
                                $i = 0;
                                while ($exam = $result->fetch_assoc()) {
                                    $i++;  
                            ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $exam['title']?></td>
                                <td><?= $exam['description']?></td>
                                <td><?= $exam['date']?></td>
                                <td><a href="view_marks.php?exam_id=<?= $exam['exam_id']?>">Exam Results</a></td>
                                <td>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php }} ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
