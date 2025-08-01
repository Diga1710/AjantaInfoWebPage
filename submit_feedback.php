<?php
// Database configuration
$host = "Mysql@localhost:3306";
$db   = "AjantaFeedbacks";
$user = "root";
$pass = "Pass@123";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO feedbackform (Name, email, Feedback) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $feedback); // "s" for string

    // Execute and check
    if ($stmt->execute()) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
// Now you can use $conn to interact with the database
?>