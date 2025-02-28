<?php
ini_set('session.cookie_lifetime', 604800); // 7 days in seconds
ini_set('session.gc_maxlifetime', 604800); // Garbage collection max lifetime
session_start();
if (isset($_SESSION['userID'])) {
    
    header('Location:dashboard.php');
}
include 'includes/config.php';




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['userID'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];

            // Set a persistent cookie for 7 days
        setcookie(session_name(), session_id(), time() + 604800, "/"); // 7 days
        
            header('Location: dashboard.php');
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Invalid username or password!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online MCQ Exam - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        .form-label {
            font-weight: bold;
            color: #6c757d;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
        }

        .text-muted {
            text-align: center;
            margin-top: 15px;
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 20px;
                margin: 10px;
            }
        }

        @media (min-width: 992px) {
            .login-container {
                padding: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="text-muted">Don't have an account? <a href="register.php">Sign up here</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
