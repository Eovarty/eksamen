<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $message = $_POST["message"];
    // You may want to add validation and sanitation here

    // Process the message (e.g., store it in a database or broadcast it to other users)
    
    // For simplicity, let's just echo the message back for now
    echo "Server: " . $message;
} else {
    // Handle non-POST requests as needed
    echo "Invalid request";
}
?>
