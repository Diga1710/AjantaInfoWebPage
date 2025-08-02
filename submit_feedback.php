<?php
// Create connection
$conn = new mysqli('localhost', 'root','', 'AjantaFeedbacks');

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Submission</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 600px; margin: auto; }
        h2 { color: #4b2e83; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Feedback Submission</h2>
        <p>Your feedback has been submitted successfully!</p>
        <a href="feedback.html">Back to Feedback Form</a>
    </div>
</body>
</html>
