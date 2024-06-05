<?php
session_start();

include 'db.php';

// Get the userID from the session
$userID_session = $_SESSION['userID']; // Assuming 'userID' is the session variable storing the userID

// SQL query to fetch all friendships the user is part of
$sql = "SELECT 
            CASE 
                WHEN userID1 = $userID_session THEN (SELECT username FROM users WHERE userID = userID2)
                WHEN userID2 = $userID_session THEN (SELECT username FROM users WHERE userID = userID1)
            END AS friend_username,
            CASE 
                WHEN userID1 = $userID_session THEN userID2
                WHEN userID2 = $userID_session THEN userID1
            END AS friend_id
        FROM friendships 
        WHERE userID1 = $userID_session OR userID2 = $userID_session";

$result = $conn->query($sql);

// Check if there's at least one row returned
if ($result->num_rows > 0) {
    // Loop through each row to fetch and display the usernames of all friends
    while ($row = $result->fetch_assoc()) {
        $friend_username = $row['friend_username'];
        $friend_id = $row['friend_id'];
        echo "- <a href='profile.php?userID=$friend_id'>$friend_username</a><br>";
    }
} else {
    // User is not part of any friendship
    echo "User is not part of any friendship.";
}

$conn->close();
?>