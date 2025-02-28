<?php
session_start();

if (!isset($_SESSION['userID']) && $_SESSION['role'] != 'admin') {
    header('Location: ../../login.php');
    exit;
}

include '../../includes/config.php';

// Check if exam_id is passed
if (isset($_GET['exam_id'])) {
    $exam_id = $_GET['exam_id'];

    // Prepare the SQL DELETE query
    $query = "DELETE FROM exams WHERE exam_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $exam_id);

    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: ../manage_exam.php");
        exit;
    } else {
        // Redirect with error message
        header("Location:../manage_exam.php");
        exit;
    }
} else {
    // Redirect if no exam_id is provided
    header("Location: ../manage_exams.php?message=Invalid exam ID.");
    exit;
}
?>
