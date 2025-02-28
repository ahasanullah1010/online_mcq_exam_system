<?php

session_start();


if (!isset($_SESSION['userID']) && $_SESSION['role'] != 'student') {
    
        header('Location:../login.php');
}



include '../includes/config.php';



    // Fetch upcomming exams from the exams table
    $user_id = $_SESSION['userID'];
     date_default_timezone_set('Asia/Dhaka');
    $d = date("Y-m-d H:i:s");
    $query = "SELECT * FROM exams where date > '$d' AND status = 'scheduled'  ORDER BY date ASC";
    $result = $conn->query($query);



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
            <a href="#" class="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
        </div>
    </nav>

    <!-- Sidebar for large screens -->
    <div class="sidebar d-none d-md-block">
        <h3 class="text-center py-3">Student Dashboard</h3>
        <a href="student_dashboard.php" class="active"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="upcoming_exam.php"><i class="fas fa-book me-2"></i> Upcoming Exams</a>
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
                    <h2 class="mb-4">Welcome, Student</h2>
                </div>
            </div>

            <!-- Cards -->
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-book fa-2x text-primary mb-3"></i>
                            <h5 class="card-title">Total Exams</h5>
                            <p class="card-text">15</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-user-graduate fa-2x text-success mb-3"></i>
                            <h5 class="card-title">Students Assigned</h5>
                            <p class="card-text">120</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-poll fa-2x text-warning mb-3"></i>
                            <h5 class="card-title">Results Published</h5>
                            <p class="card-text">8</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-envelope fa-2x text-danger mb-3"></i>
                            <h5 class="card-title">Messages</h5>
                            <p class="card-text">3</p>
                        </div>
                    </div>
                </div>
            </div>









<!-- student content -->


            
            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Upcoming Exams</h5>
                            <p class="card-text">View and prepare for upcoming exams.</p>
                            <a href="#" class="btn btn-primary">View Exams</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Results</h5>
                            <p class="card-text">Check your recent results.</p>
                            <a href="#" class="btn btn-primary">View Results</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Profile</h5>
                            <p class="card-text">Manage your profile and settings.</p>
                            <a href="#" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>











            <!-- Table -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Upcoming Exams</h5>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Exam Title</th>
                                        <th>Description</th>
                                        <th>Starting Time</th>
                                        <th>Status</th>
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
                                        <td><span class="badge bg-warning"><?= $exam['status']?></span></td>
                                    </tr>

                                    <?php      }   }
                                    else{
                                        echo "Do not have any Upcoming Examination ! ";
                                    }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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









