

<?php

session_start();


if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'admin') {
    
        header('Location:../../login.php');
}


include '../../includes/config.php';


$exam_id = $_GET['exam_id'] ?? null;
if ($exam_id) {
    $query = "UPDATE exams SET status = ? WHERE exam_id = ?";
    $stmt = $conn->prepare($query);
    $status = 'scheduled';
    $stmt->bind_param('si', $status, $exam_id);
    if($stmt->execute()){
        header('Location:../manage_exam.php');
    }
    $stmt->close();
    
}


?>