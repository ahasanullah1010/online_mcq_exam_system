
<?php
session_start();
include 'includes/config.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header('Location:admin/adminDashboard.php');
    } elseif ($_SESSION['role'] == 'student') {
        header('Location:student/student_dashboard.php');
    }
}



?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(rgba(0, 123, 255, 0.8), rgba(0, 123, 255, 0.8)), url('exam-background.jpg') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 80px 20px;
        }

        .hero h1 {
            font-size: 2.5rem;
        }

        .hero p {
            font-size: 1.2rem;
        }

        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="bg-primary text-white text-center py-3">
        <h1>Welcome to the Online Exam Platform</h1>
    </header>

    <!-- Hero Section -->
    <div class="hero d-flex flex-column align-items-center justify-content-center">
        <h1>Revolutionize Your Exam Experience</h1>
        <p>Effortless, reliable, and innovative online exam management.</p>
        <a href="register.php" class="btn btn-warning btn-lg">Get Started</a>
    </div>

    <!-- Features Section -->
    <div class="container py-5">
        <h2 class="text-center mb-4">Why Choose Us?</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <div class="col">
                <div class="card text-center h-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Easy Signup</h3>
                        <p class="card-text">Create an account in just a few clicks and get started right away.</p>
                        <a href="register.php" class="btn btn-primary">Sign Up</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center h-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-primary">User Dashboard</h3>
                        <p class="card-text">Track exams, view results, and access personalized tools.</p>
                        <a href="dashboard.php" class="btn btn-primary">View Dashboard</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center h-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Secure Platform</h3>
                        <p class="card-text">Your data is safe with us, ensuring a worry-free experience.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center h-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Admin Tools</h3>
                        <p class="card-text">Manage exams, questions, and users effortlessly.</p>
                        <a href="adminDashboard.php" class="btn btn-primary">Admin Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Online Exam Platform. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
