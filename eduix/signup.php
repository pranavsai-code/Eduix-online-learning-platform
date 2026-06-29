<?php
$servername = "localhost";
$username = "root"; // adjust as per your DB settings
$password = "";     // adjust as per your DB settings
$dbname = "user_auth";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user = $_POST['username'];
$email = $_POST['email'];
$pass1 = $_POST['passwords1'];
$pass2 = $_POST['passwords2'];

if ($pass1 !== $pass2) {
    echo "Passwords do not match.";
    exit;
}

// Check for existing username or email
$sql_check = "SELECT * FROM users WHERE username=? OR email=?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("ss", $user, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Username or Email already in use.";
} else {
    $hashed_pass = password_hash($pass1, PASSWORD_DEFAULT);
    $sql_insert = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("sss", $user, $email, $hashed_pass);
    if ($stmt->execute()) {
        header("Location: login.html"); // redirect to login
    } else {
        echo "Signup failed. Try again.";
    }
}

$conn->close();
?>
