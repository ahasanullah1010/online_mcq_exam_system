<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: white;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.collapsed {
            transform: translateX(-250px);
        }

        .sidebar .nav-link {
            color: white;
            padding: 15px 20px;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
        }

        .content.collapsed {
            margin-left: 0;
        }

        .hamburger {
            display: none;
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 24px;
            color: #343a40;
            cursor: pointer;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .hamburger {
                display: block;
            }

            .content {
                margin-left: 0;
            }

            .content.show {
                margin-left: 250px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4 class="text-center py-3">Student Dashboard</h4>
        <nav class="nav flex-column">
            <a href="#" class="nav-link">Home</a>
            <a href="#" class="nav-link">Upcoming Exams</a>
            <a href="#" class="nav-link">Results</a>
            <a href="#" class="nav-link">Exam History</a>
            <a href="#" class="nav-link">Profile</a>
            <a href="#" class="nav-link">Logout</a>
        </nav>
    </div>

    <!-- Hamburger Menu -->
    <div class="hamburger" id="hamburger">
        &#9776;
    </div>

    <!-- Content Area -->
    <div class="content" id="content">
        <div class="container">
            <h1 class="mb-4">Welcome, Student!</h1>
            <div class="row">
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
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const hamburger = document.getElementById('hamburger');

        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            content.classList.toggle('show');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
