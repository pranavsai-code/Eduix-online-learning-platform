<?php
session_start();
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_auth";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

// Check if username is set in session
if (!isset($_SESSION['username'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit;
}

$latestUsername = $_SESSION['username'];

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section = $_POST['section'] ?? '';
    $value = $_POST['value'] ?? '';

    // Choose which column to update
    $column = "";
    if ($section === "about-me") $column = "about_me";
    elseif ($section === "skills") $column = "skills";
    elseif ($section === "education") $column = "education";

    if ($column !== "") {
        $sql = "UPDATE users SET $column = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $value, $latestUsername);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => ucfirst($section) . " updated successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database update failed"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid section"]);
    }
}
$conn->close();
?>
