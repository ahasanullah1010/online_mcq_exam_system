<?php
session_start();

include 'includes/config.php';

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header('Location:admin/adminDashboard.php');
    } elseif ($_SESSION['role'] == 'student') {
        header('Location:student/studentDashboard.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        header('Location: login.php');
    } else {
        $error = "Registration failed!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eef2f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 450px;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
            color: #4b515d;
        }

        .form-control {
            margin-bottom: 15px;
            background-color: #f9fbfc;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
        }

        .login-link {
            margin-top: 15px;
            display: block;
            font-size: 14px;
            color: #3498db;
            text-decoration: none;
        }

        .login-link:hover {
            color: #2980b9;
        }

        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }

            .form-control, .btn-primary {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Sign Up</h2>
        <?php  if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select id="role" name="role" class="form-select">
                    <option value="student">Student</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <a class="login-link" href="login.php">Already have an account? Login here</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
