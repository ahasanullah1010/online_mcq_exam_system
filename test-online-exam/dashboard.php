


<?php
session_start();
include 'includes/config.php';
//include 'includes/header.php';


if (isset($_SESSION['userID'])) {
    if ($_SESSION['role'] == 'admin') {
        header('Location:admin/adminDashboard.php');
    } elseif ($_SESSION['role'] == 'student') {
        header('Location:student/student_dashboard.php');
    }
}
else{
    header('Location:login.php');
}



?>
