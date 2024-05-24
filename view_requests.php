<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Friend Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #34404f; /* Main background color */
            margin: 0;
            padding: 0;
            color: #c8d1d9; /* Matching text color */
        }

        .user {
            background-color: #2e3944; /* Increased contrast background color */
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .user span {
            color: #c8d1d9; /* Matching text color */
        }

        form {
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color: #4f5d75; /* Matching background color */
            color: #c8d1d9; /* Matching text color */
            padding: 10px 25px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 1.5rem;
        }

        input[type="submit"]:hover {
            background-color: #667a94; /* Matching hover background color */
        }

        .no-results {
            text-align: center;
            padding: 20px;
            background-color: #2e3944; /* Increased contrast background color */
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php
    // Start the session
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['userID'])) {
        // Redirect to login page or handle accordingly
        header("Location: login.php");
        exit();
    }

    // Include database connection code
    include 'db.php';

    // Get current user ID from session
    $currentUserID = $_SESSION['userID'];

    // Check if a friend request is accepted
    if(isset($_GET['accept'])) {
        // Get friendID from request parameters
        $friendID = $_GET['accept'];
        
        // Update friendship status to 'accepted' in the database
        $sql = "UPDATE friendships SET status = 'accepted' WHERE (userID1 = $friendID AND userID2 = $currentUserID) OR (userID1 = $currentUserID AND userID2 = $friendID)";
        $result = $conn->query($sql);
        
        if ($result === TRUE) {
            $message = 'Friend request accepted successfully.';
        } else {
            $message = 'Error accepting friend request: ' . $conn->error;
        }
    }

    // Fetch pending friend requests for the current user
    $sql = "SELECT users.userID, users.username FROM users INNER JOIN friendships ON (users.userID = friendships.userID1 OR users.userID = friendships.userID2) WHERE (friendships.userID1 = $currentUserID OR friendships.userID2 = $currentUserID) AND friendships.status = 'pending' AND users.userID != $currentUserID";
    $result = $conn->query($sql);

    // Check if there are any pending requests
    if ($result->num_rows > 0) {
        // Display pending requests
        echo "<h2>Pending Friend Requests</h2>";
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li class='user'>{$row['username']} <a href='view_requests.php?accept={$row['userID']}'><button>Accept</button></a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p class='no-results'>No pending friend requests.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
