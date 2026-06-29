<?php
// Database config
$host = "localhost";
$user = "root";
$password = ""; // your DB password
$dbname = "user_auth";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the latest user (based on highest ID or latest timestamp)
$sql = "SELECT username FROM users ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$latestUser = "No users found.";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $latestUser = $row['username'];
}

$conn->close();

// Echo username so it can be loaded via AJAX or embedded
echo $latestUser;
?>
