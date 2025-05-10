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

// Get the question from POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = trim($_POST['question']);

    if (!empty($question)) {
        $stmt = $conn->prepare("INSERT INTO questions (question) VALUES (?)");
        $stmt->bind_param("s", $question);

        if ($stmt->execute()) {
            header("Location: ask-me.html?success=1"); // Redirect back with success
            exit();
        } else {
            echo "Error submitting question.";
        }

        $stmt->close();
    } else {
        echo "Question is empty.";
    }
}

$conn->close();
?>
