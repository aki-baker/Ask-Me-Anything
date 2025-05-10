<?php
// Database configuration
$host = "localhost";
$dbname = "qna_db";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch questions from database
$sql = "SELECT * FROM questions ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - View Questions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #3686C9;
            text-align: center;
        }
        .question-card {
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .question-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .question-text {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
        }
        .timestamp {
            color: gray;
            font-size: 12px;
            text-align: right;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Submitted Questions 📬</h1>
    <?php
    if ($result->num_rows > 0) {
        // Output each question
        while($row = $result->fetch_assoc()) {
            echo "<div class='question-card'>";
            echo "<p class='question-text'><strong>Question:</strong> " . $row['question'] . "</p>";
            echo "<p class='timestamp'><strong>Submitted on:</strong> " . $row['created_at'] . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No questions found.</p>";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
