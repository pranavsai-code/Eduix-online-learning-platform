<?php
// Connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Update if your MySQL has a password
$dbname = "user_auth"; // Ensure this DB exists

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure it only runs on POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect data and sanitize
    $feedback_type = isset($_POST['feedback_type']) ? trim($_POST['feedback_type']) : '';
    $course_name = isset($_POST['course_name']) ? trim($_POST['course_name']) : '';
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
    $feedback_title = isset($_POST['feedback_title']) ? trim($_POST['feedback_title']) : '';
    $feedback_message = isset($_POST['feedback_message']) ? trim($_POST['feedback_message']) : '';

    // Simple validation
    if ($feedback_type === '' || $feedback_title === '' || $feedback_message === '') {
        echo "All required fields must be filled out.";
        exit;
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO feedback (feedback_type, course_name, rating, feedback_title, feedback_message) 
                            VALUES (?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("ssiss", $feedback_type, $course_name, $rating, $feedback_title, $feedback_message);

        if ($stmt->execute()) {
            echo "Feedback submitted successfully!";
        } else {
            echo "Database error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Statement preparation failed: " . $conn->error;
    }

} else {
    echo "Invalid request. Please submit the form correctly.";
}

$conn->close();
?>
