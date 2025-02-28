

<?php

session_start();


if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'admin') {
    
        header('Location:../../login.php');
}


include '../../includes/config.php';


$exam_id = $_GET['exam_id'] ?? null;
if ($exam_id) {
    $query = "SELECT * FROM questions where exam_id = $exam_id";
    $result = $conn->query($query);



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCQ Questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .question-card {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .question-number {
            font-weight: bold;
        }
        .submit-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">MCQ Questions</h1>
        
            <!-- Example Question 1 -->
             <?php
             if($result->num_rows > 0){
                $i = 0;
                while ($question = $result->fetch_assoc()) {
                    $i++;

                    ?>

            <div class="question-card">
                <h6 class="question-number"><?= $i ?>. <?= $question['question_text'] ?></h6>
                
                <div class="form-check">
                    
                    <label class="form-check-label" for="q1_option1">1. <?= $question['option1'] ?></label>
                </div>
                <div class="form-check">
                    
                    <label class="form-check-label" for="q1_option2">2. <?= $question['option2'] ?></label>
                </div>
                <div class="form-check">
                    
                    <label class="form-check-label" for="q1_option3">3. <?= $question['option3'] ?></label>
                </div>
                <div class="form-check">
                    
                    <label class="form-check-label" for="q1_option4">4. <?= $question['option4'] ?></label>
                </div>

                <div class="form-check">
                    
                    <label  class="form-check-label" >Correct Answer :  <?= $question['correct_option'] ?></label>
                </div>
            </div>

            <?php } }else echo "not found!"; ?>

            

            <!-- Add More Questions Dynamically -->

        <a href="./submit_to_schedule.php?exam_id=<?= $exam_id ?>">
            <button style="margin-bottom: 50px;" type="button" class="btn btn-primary btn-lg btn-block"> Submit TO Schedule</button>
        </a>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php }
else echo "not found"; ?>
