<?php
// Include the file containing your database connection code
include 'db.php';

// Start the session to manage user sessions
session_start();

// Fetch previous messages from the database
$sql = "SELECT m.message, m.timestamp, u.username FROM messages m
        INNER JOIN users u ON m.userID = u.userID
        ORDER BY m.timestamp ASC"; // Fetch all messages sorted by newest timestamp
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Store the messages in an array
    $messages = array();
    while ($row = $result->fetch_assoc()) {
        // Check if the username matches the username in the session
        if (isset($_SESSION['username']) && $row['username'] === $_SESSION['username']) {
            // If the username matches, display "Me" instead of the username
            $username = "Me";
        } else {
            // If the username doesn't match, use the username from the database
            $username = $row["username"];
        }
        // Construct the message with the appropriate username
        $messages[] = "<p><strong>" . $username . ":</strong> " . $row["message"] . " - " . $row["timestamp"] . "</p>";
    }

    // Output the messages
    foreach ($messages as $message) {
        echo $message;
    }
} else {
    echo "<p>No previous messages</p>";
}
$conn->close();
?>
