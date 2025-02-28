
<?php

session_start();


if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'admin') {
    
        header('Location:../login.php');
}


include '../includes/config.php';


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_option = $_POST['correct_option'];
    
    // Assume exam_id is passed in the URL or session
    $exam_id = $_GET['exam_id'] ?? null; // Or retrieve it from the session: $_SESSION['exam_id']

    // Validate required fields
    if ($exam_id && $question && $option1 && $option2 && $option3 && $option4 && $correct_option) {
        // Prepare SQL query  exam_id	question_text	option1	option2	option3	option4	correct_option
        $query = "INSERT INTO questions (exam_id, question_text, option1, option2, option3, option4, correct_option) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param('issssss', $exam_id, $question, $option1, $option2, $option3, $option4, $correct_option);

        // Execute the query
        if ($stmt->execute()) {
            header('Location:set_questions.php?exam_id='.$exam_id);
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "All fields are required.";
    }
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Question</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
        }

        .form-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .questions-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table th {
            background-color: #f4f4f4;
        }

        .update-button {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row g-4">
            <!-- Form Section -->
            <div class="col-lg-4">
                <div class="form-section">
                    <h2 class="text-center mb-4">Set a New Question</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" id="question" name="question" class="form-control" placeholder="Enter the question" required>
                        </div>

                        <div class="mb-3">
                            <label for="option1" class="form-label">Option 1</label>
                            <input type="text" id="option1" name="option1" class="form-control" placeholder="Enter option 1" required>
                        </div>

                        <div class="mb-3">
                            <label for="option2" class="form-label">Option 2</label>
                            <input type="text" id="option2" name="option2" class="form-control" placeholder="Enter option 2" required>
                        </div>

                        <div class="mb-3">
                            <label for="option3" class="form-label">Option 3</label>
                            <input type="text" id="option3" name="option3" class="form-control" placeholder="Enter option 3" required>
                        </div>

                        <div class="mb-3">
                            <label for="option4" class="form-label">Option 4</label>
                            <input type="text" id="option4" name="option4" class="form-control" placeholder="Enter option 4" required>
                        </div>

                        <div class="mb-3">
                            <label for="correct_option" class="form-label">Correct Answer</label>
                            <select id="correct_option" name="correct_option" class="form-select" required>
                                <option value="">Select Correct Answer</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                                <option value="4">Option 4</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Submit Question</button>
                    </form>
                </div>
            </div>

            <!-- Questions List Section -->
            <div class="col-lg-8">
                <div class="questions-section">
                    <h2 class="text-center mb-4">Questions List</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Option 1</th>
                                    <th>Option 2</th>
                                    <th>Option 3</th>
                                    <th>Option 4</th>
                                    <th>Correct Answer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $exam_id = $_GET['exam_id'] ?? null;
                                if ($exam_id) {
                                    $query = "SELECT * FROM questions where exam_id = $exam_id";
                                    $result = $conn->query($query);
                                    if($result->num_rows > 0){
                                    while ($question = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($question['question_text']) . "</td>";
                                        echo "<td>" . htmlspecialchars($question['option1']) . "</td>";
                                        echo "<td>" . htmlspecialchars($question['option2']) . "</td>";
                                        echo "<td>" . htmlspecialchars($question['option3']) . "</td>";
                                        echo "<td>" . htmlspecialchars($question['option4']) . "</td>";
                                        echo "<td>" . htmlspecialchars($question['correct_option']) . "</td>";
                                        echo "<td><a href='update_question.php?id=" . $question['question_id'] . "' class='btn btn-info btn-sm update-button'>Update</a></td>";
                                        echo "</tr>";
                                    }
                                }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
