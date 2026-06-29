<?php
session_start();
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "user_auth";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user = $_POST['username'];
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['password'])) {
        header("Location: dashbord.php");
    } else {
        echo "Invalid password.";
    }
} else {
    echo "Username not found.";
}
if (password_verify($pass, $row['password'])) {
    $_SESSION['username'] = $user;  // store username in session
    header("Location: dashbord.php");
}


$conn->close();
?>
