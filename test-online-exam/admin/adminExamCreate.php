
<?php

session_start();


if (!isset($_SESSION['userID']) || $_SESSION['role'] != 'admin') {
    
        header('Location:../login.php');
}

echo $_SESSION["userID"];

include '../includes/config.php';



$message = "";
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $exam_title = $_POST['exam_title'];
    $description = $_POST['description'];
    $starting_time = $_POST['start_time'];
    $duration = $_POST['duration'];
    $status = $_POST['status'];

    // Validate the input data (basic validation for empty fields)
    if (empty($exam_title) || empty($description) || empty($starting_time) || empty($duration) || empty($status)) {
        $message = "All fields are required.";
    } else {
        // Prepare the SQL query to insert the exam data
        $query = "INSERT INTO exams (user_id, title, description, date, duration, status) VALUES (?, ?, ?, ?,?,?)";

        // Create a prepared statement
        if ($stmt = $conn->prepare($query)) {
            // Bind the parameters to the prepared statement
            $stmt->bind_param('isssis', $_SESSION['userID'], $exam_title, $description, $starting_time, $duration, $status);

            // Execute the query
            if ($stmt->execute()) {
                header('Location:adminViewExamList.php?exam_id='.$_SESSION['userID']);
            } else {
                $message = "Exam create failed!";
                
            }

            // Close the statement
            $stmt->close();
        } else {
            $message = "Exam create failed!";
        }
    }
}





?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Exam Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="datetime-local"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            resize: none;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-container label[for="status"] {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Create a New Exam</h2>
        <form action="" method="POST">
            <?php echo $message ?>
            <label for="exam_title">Exam Title</label>
            <input type="text" id="exam_title" name="exam_title" placeholder="Enter exam title" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Enter exam description" required></textarea>

            <label for="start_time">Start Time:</label>
            <input type="datetime-local" id="start_time" name="start_time" required>

            <label for="duration">Duration (minutes):</label>
            <input type="number" id="duration" name="duration" min="1" required>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <button type="submit">Insert Exam</button>
        </form>
    </div>
</body>
</html>
