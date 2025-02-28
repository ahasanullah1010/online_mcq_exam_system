

<?php

session_start();

if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'student') {
    
        header('Location:../login.php');
}
if($_SERVER['REQUEST_METHOD']!="POST"){
    header('Location:studentExamList.php');
}

include '../includes/config.php';

$mark = 0;
$totalMark = 0;
$exam_id = $_GET['exam_id'];
    // Fetch exams from the exams table
$user_id = $_SESSION['userID'];
$query = "SELECT * FROM questions where exam_id = $exam_id ";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    
    
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    while ($question = $result->fetch_assoc()) {
        $totalMark++;
        $qid = $question['question_id'];
        $correct_option = $question['correct_option'];
        
        if(!isset($_POST["{$qid}"])){
            $submit_value = " ";
        }
        else
        {
            $submit_value = $_POST["{$qid}"];
        }

        
        
        if($correct_option==$submit_value){
            $mark ++;
        }
    }
}

$query_exam = "SELECT * FROM exams where exam_id = $exam_id ";
$result_exam = $conn->query($query_exam);
$exam = $result_exam->fetch_assoc();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #4CAF50;
        }
        .details {
            margin-top: 20px;
            text-align: left;
        }
        .details p {
            margin: 10px 0;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Submission Complete!</h1>
        <p>Your exam has been submitted successfully.</p>
        <div class="details">
            <h3>Exam Details</h3>
            <p><strong>Exam Name:</strong> <?= $exam['title'] ?></p>
            <p><strong>Total Questions:</strong> <?= $totalMark ?></p>
            <p><strong>Your Score:</strong> <?= $mark ?> / <?= $totalMark ?></p>
            <p><strong>Date:</strong> <?= date('Y-m-d y:i:s', strtotime($exam['date'])) ?></p>
            <p><strong>Duration:</strong> <?= $exam['duration'] ?> minutes</p>
        </div>
        <a href="studentDashboard.php" class="btn">Go to Dashboard</a>
    </div>
</body>
</html>



<?php
 $sql = "INSERT INTO results (user_id, exam_id, score, total_score) VALUES (?, ?, ?, ?)";

 // Create a prepared statement
 if ($stmt = $conn->prepare($sql)) {
     // Bind the parameters to the prepared statement
     $stmt->bind_param('iiii', $_SESSION['userID'], $exam_id, $mark, $totalMark);

     // Execute the query
     if ($stmt->execute()) {
         echo "score data save successfully";
     } else {
         echo "score save failed!";
         
     }

     // Close the statement
     $stmt->close();
 } else {
     echo "score save failed!";
 }
 
?>