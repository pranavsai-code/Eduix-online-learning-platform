<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "rachapudipranavsai123@gmail.com"; 
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $newsletter = isset($_POST["newsletter"]) ? "Yes" : "No";

    $fullMessage = "
        Name: $name\n
        Email: $email\n
        Subject: $subject\n
        Message:\n$message\n
        Subscribed to Newsletter: $newsletter
    ";

    $headers = "From: $email";

    if (mail($to, $subject, $fullMessage, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
}
?>
