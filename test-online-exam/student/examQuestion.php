

<?php

session_start();

if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'student') {
    
        header('Location:../login.php');
}

include '../includes/config.php';

date_default_timezone_set('Asia/Dhaka');

$count = 0;
$exam_id = $_GET['exam_id'];
$user_id = $_SESSION['userID'];
    
    // Fetch question from the question table

$query = "SELECT * FROM questions where exam_id = $exam_id ";
$result = $conn->query($query);

// if ($result->num_rows > 0) { 
// }


// Fetch exams from the exams table
$query_exam = "SELECT * FROM exams where exam_id = $exam_id ";
$result_exam = $conn->query($query_exam);
$exam = $result_exam->fetch_assoc();


$startTime = new DateTime($exam['date']);
$endTime = clone $startTime;
$endTime->modify("+{$exam['duration']} minutes");
$currentTime = new DateTime();

$timeRemainingStart = $startTime->getTimestamp() - $currentTime->getTimestamp();
$timeRemaining = $endTime->getTimestamp() - $currentTime->getTimestamp();

$duration = $endTime->getTimestamp() - $startTime->getTimestamp();




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Questions</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .question {
            margin-bottom: 20px;
        }

        .question h3 {
            margin-bottom: 10px;
        }

        .options {
            list-style: none;
            padding: 0;
        }

        .options li {
            margin: 10px 0;
        }

        .options input[type="radio"] {
            margin-right: 10px;
        }

        .submit-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Exam Questions</h1>
    </header>

    <div class="container">
    <h1 ><span id="later">Exam will be start after : -- </h1>
    <h2></span> <span id="timer"></span></h2>
        <form id="examForm" action="calculateExamResult.php?exam_id=<?= $exam_id ?>" method="POST">
          <?php while ($question = $result->fetch_assoc()) {  
            $count++; ?>
            <div class="question">
                <h3> <?= $count.". ".$question['question_text']?></h3>
                <ul class="options">
                    <li><label><input type="radio" name="<?= $question['question_id']?>" value="1"> <?= $question['option1']?></label></li>
                    <li><label><input type="radio" name="<?= $question['question_id']?>" value="2"> <?= $question['option2']?></label></li>
                    <li><label><input type="radio" name="<?= $question['question_id']?>" value="3"> <?= $question['option3']?></label></li>
                    <li><label><input type="radio" name="<?= $question['question_id']?>" value="4"> <?= $question['option4']?></label></li>
                </ul>
            </div>

            <?php } ?>

            <button type="submit" class="submit-btn" id="btn">Submit Exam</button>
        </form>
    </div>




<script>




let timeRemainingStart = <?php echo $timeRemainingStart; ?>;
let timeRemaining = <?php echo $timeRemaining; ?>; // From PHP
let duration = <?php echo $duration; ?>;

if(timeRemainingStart>0){
    const timer = document.getElementById('timer');
    document.getElementById('later').style.visibility = "visible";
    document.getElementById('examForm').style.visibility = "hidden";
    function updateTimer() {
        if (timeRemainingStart <= 0) {
            clearInterval(timerInterval);
             
            return;
        }
        const hours = Math.floor(timeRemainingStart / 3600); // Calculate hours
        const minutes = Math.floor((timeRemainingStart % 3600) / 60); // Calculate minutes
        const seconds = timeRemainingStart % 60; // Calculate seconds

        // Display time in HH:MM:SS format
        timer.textContent = `${hours}h ${minutes}m ${seconds}s`;
        timeRemainingStart--;
    }

    const timerInterval = setInterval(updateTimer, 1000);
    updateTimer();

}




if(timeRemaining<=duration && timeRemaining>0){
<?php
 $sql = "SELECT * FROM results where exam_id = $exam_id ";
 $resul = $conn->query($sql);
 $s = false;
  if ($resul->num_rows > 0) { 
    $s = true;
  }   
    ?>
    const timer = document.getElementById('timer');
    <?php if ($s){ ?>
        document.getElementById('btn').style.visibility = "hidden";
        <?php } ?>
    document.getElementById('later').style.visibility = "hidden";
    document.getElementById('examForm').style.visibility = "visible";
    function updateTimer() {
        if (timeRemaining <= 0) {
            clearInterval(timerInterval);
            <?php if (!$s){ ?>
            document.getElementById('examForm').submit(); // Auto-submit form
            <?php } ?>
            return;
        }
        const hours = Math.floor(timeRemaining / 3600); // Calculate hours
        const minutes = Math.floor((timeRemaining % 3600) / 60); // Calculate minutes
        const seconds = timeRemaining % 60; // Calculate seconds

        // Display time in HH:MM:SS format
        timer.textContent = `${hours}h ${minutes}m ${seconds}s`;
        timeRemaining--;
    }

    const timerInterval = setInterval(updateTimer, 1000);
    updateTimer();
}


if(timeRemaining<0){
    document.getElementById('btn').style.visibility = "hidden";
    document.getElementById('later').innerText = "Exam already finished";
}



</script>



</body>
</html>
