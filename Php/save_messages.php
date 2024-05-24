<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender = $_POST["sender"];
    $message = $_POST["message"];

    $sql = "INSERT INTO messages (sender, message) VALUES ('$sender', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
