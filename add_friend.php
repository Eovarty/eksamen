<?php
// Start the session to manage user sessions
session_start();

include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    // Redirect to login page or handle accordingly
    header("Location: login.php");
    exit();
}

// Get userID from form data
$userID = $_POST['userID'];

// Get current user ID from session
$currentUserID = $_SESSION['userID'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if friendship already exists
$sql = "SELECT * FROM friendships WHERE (userID1 = $currentUserID AND userID2 = $userID) OR (userID1 = $userID AND userID2 = $currentUserID)";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    $message = 'Friendship already exists.';
} else {
    // Insert friendship into database
    $sql = "INSERT INTO friendships (userID1, userID2, status) VALUES ($currentUserID, $userID, 'pending')";
    if ($conn->query($sql) === TRUE) {
        $message = 'Friend request sent successfully.';
    } else {
        $message = 'Error: ' . $sql . '<br>' . $conn->error;
    }
}

$conn->close();

// Redirect back to friend.php
header("Location: friend.php?message=" . urlencode($message));
exit();
?>
