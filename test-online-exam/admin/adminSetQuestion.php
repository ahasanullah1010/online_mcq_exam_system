
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
            header('Location:adminSetQuestion.php?exam_id='.$exam_id);
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
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            display: flex;
            gap: 20px;
        }

        .form-section {
            position: fixed;
            top: 50px; /* Adjust the top value to place the form below the header */
            left: 20px;
            right: 20px;
            width: 300px; /* Set a fixed width for the form */
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 10; /* Ensure the form is always on top */
            max-height: calc(100vh - 100px); /* Make sure the form fits within the viewport height */
            overflow-y: auto; /* Scrollable form content */
        }

        .questions-section {
            margin-left: 250px; /* This space is to the right of the form */
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 100vh; /* Ensure the table section is at least the full height of the viewport */
            overflow-y: auto; /* Allows the table section to scroll if it overflows */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, select, button {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .update-button {
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .update-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <h2>Set a New Question</h2>
            <form  method="POST">
                <label for="question">Question</label>
                <input type="text" id="question" name="question" placeholder="Enter the question" required>

                <label for="option1">Option 1</label>
                <input type="text" id="option1" name="option1" placeholder="Enter option 1" required>

                <label for="option2">Option 2</label>
                <input type="text" id="option2" name="option2" placeholder="Enter option 2" required>

                <label for="option3">Option 3</label>
                <input type="text" id="option3" name="option3" placeholder="Enter option 3" required>

                <label for="option4">Option 4</label>
                <input type="text" id="option4" name="option4" placeholder="Enter option 4" required>

                <label for="correct_option">Correct Answer</label>
                <select id="correct_option" name="correct_option" required>
                    <option value="">Select Correct Answer</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    <option value="4">Option 4</option>
                </select>

                <button type="submit">Submit Question</button>
            </form>
        </div>


<?php 
$exam_id = $_GET['exam_id'] ?? null;
if ($exam_id) {
    $query = "SELECT * FROM questions where exam_id = $exam_id";
    $result = $conn->query($query);

?>

        <div class="questions-section">
            <h2>Questions List</h2>
            <table>
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
                    <!-- Example Question Start -->
                    <?php while ($question = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $question['question_text']?></td>
                        <td><?= $question['option1']?></td>
                        <td><?= $question['option2']?></td>
                        <td><?= $question['option3']?></td>
                        <td><?= $question['option4']?></td>
                        <td><?= $question['correct_option']?></td>
                        <td><a href="update_question.php?id=1" class="update-button">Update</a></td>
                    </tr>
                    
                    <?php }  } ?>

                    <!-- More questions will be dynamically populated using PHP -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
