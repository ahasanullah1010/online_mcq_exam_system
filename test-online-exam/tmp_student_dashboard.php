

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Online Exam System</title>
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
    </style>
</head>

<body>
    <!-- Navbar for small screens -->
    <nav class="d-block d-md-none navbar navbar-dark bg-dark">
        <button class="btn btn-dark" id="dropdownBtn">
            <i class="fas fa-bars"></i>
        </button>
        <div id="dropdownMenu" class="dropdown-menu">
            <a href="#" class="dropdown-item">Dashboard</a>
            <a href="#" class="dropdown-item">Assigned Exams</a>
            <a href="#" class="dropdown-item">Results</a>
            <a href="#" class="dropdown-item">Notifications</a>
            <a href="#" class="dropdown-item">Settings</a>
            <a href="#" class="dropdown-item">Logout</a>
        </div>
    </nav>

    <!-- Sidebar for large screens -->
    <div class="sidebar d-none d-md-block">
        <h3 class="text-center py-3">Student Dashboard</h3>
        <a href="#" class="active"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="#"><i class="fas fa-book me-2"></i> Assigned Exams</a>
        <a href="#"><i class="fas fa-poll me-2"></i> Results</a>
        <a href="#"><i class="fas fa-bell me-2"></i> Notifications</a>
        <a href="#"><i class="fas fa-cogs me-2"></i> Settings</a>
        <a href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-4">Welcome, [Student Name]</h2>
                </div>
            </div>
            <!-- Cards and Table content goes here -->

    <!-- Cards -->
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-book fa-2x text-primary mb-3"></i>
                            <h5 class="card-title">Upcoming Exams</h5>
                            <p class="card-text">5</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-check-circle fa-2x text-success mb-3"></i>
                            <h5 class="card-title">Completed Exams</h5>
                            <p class="card-text">12</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-poll fa-2x text-warning mb-3"></i>
                            <h5 class="card-title">Results Available</h5>
                            <p class="card-text">8</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-bell fa-2x text-danger mb-3"></i>
                            <h5 class="card-title">Notifications</h5>
                            <p class="card-text">3</p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Table -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Assigned Exams</h5>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Exam Title</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Midterm</td>
                                        <td>Mathematics</td>
                                        <td>2025-01-15</td>
                                        <td><span class="badge bg-warning">Scheduled</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Practice Test</td>
                                        <td>Physics</td>
                                        <td>2025-01-20</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Final Exam</td>
                                        <td>Chemistry</td>
                                        <td>2025-01-25</td>
                                        <td><span class="badge bg-danger">Pending</span></td>
                                    </tr>
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










