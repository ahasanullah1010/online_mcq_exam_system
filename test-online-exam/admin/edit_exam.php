

<?php

session_start();


if (!isset($_SESSION['userID']) && $_SESSION['role'] != 'admin') {
    
        header('Location:../login.php');
}

// echo $_SESSION["userID"];

include '../includes/config.php';

$message = "";

// Get the exam ID from the query parameter
$exam_id = $_GET['exam_id'] ?? null;

if (!$exam_id) {
    die("Invalid exam ID.");
}


// Fetch existing exam data
$query = "SELECT * FROM exams WHERE exam_id = $exam_id";
$result = $conn->query($query);
$exam = $result->fetch_assoc();


if (!$exam) {
    die("Exam not found.");
}






// Update exam data on form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_title = $_POST['exam_title'];
    $description = $_POST['description'];
    $starting_time = $_POST['start_time'];
    $duration = $_POST['duration'];
    $status = $_POST['status'];

    // Validate the input data
    if (empty($exam_title) || empty($description) || empty($starting_time) || empty($duration) || empty($status)) {
        $message = "All fields are required.";
    } else {
        $query = "UPDATE exams SET title = ?, description = ?, date = ?, duration = ?, status = ? WHERE exam_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssi', $exam_title, $description, $starting_time, $duration, $status, $exam_id);

        if ($stmt->execute()) {
            $message = "Exam updated successfully.";
            header('Location:manage_exam.php');
        } else {
            $message = "Failed to update exam: " . $stmt->error;
        }

        $stmt->close();
    }
}



?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Exam</title>
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



        .form-container {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
            color: #555;
        }

        .form-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            h2 {
                font-size: 1.5rem;
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
        <a href="view_results.php"><i class="fas fa-poll me-2"></i> View Results</a>
        <a href="create_new_exam.php" class=""><i class="fas fa-plus me-2"></i> Add New Exam</a>
        <a href="add_question_to_exam.php" class=""><i class="fas fa-plus me-2"></i> Set Questions </a>
        <a href="#"><i class="fas fa-envelope me-2"></i> Messages</a>
        <a href="#"><i class="fas fa-cogs me-2"></i> Settings</a>
        <a href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            




            <div class="container py-5">
                <div class="form-container">
                    <h2>Update Exam</h2>
                    <form action="" method="POST">
                        <?php echo $message ?>
                        <div class="mb-3">
                            <label for="exam_title" class="form-label">Exam Title</label>
                            <input type="text" id="exam_title" name="exam_title" class="form-control" value="<?= $exam['title']?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="4"  required><?= $exam['description']?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="start_time" class="form-label">Start Time</label>
                            <input type="datetime-local" id="start_time" name="start_time" class="form-control" value="<?= $exam['date']?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration (minutes)</label>
                            <input type="number" id="duration" name="duration" class="form-control" min="1" value="<?= $exam['duration']?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select" >
                                <option selected disabled>Select status</option>
                                <option value="scheduled" <?= $exam['status'] === 'scheduled' ? 'selected' : '' ?>>Scheduled</option>
                                <option value="completed" <?= $exam['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                                <option value="pending" <?= $exam['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Exam</button>
                        if you don't want to create a new exam, <a href="adminDashboard.php">click here</a> go to dashboard
                    </form>
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
