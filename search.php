<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="your_stylesheet.css">
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
    if(isset($_GET['search-button'])) {
        $searchInput = $_GET['searchInput'];
        // Connect to your database
        include 'db.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to search for users
        $sql = "SELECT userID, username FROM users WHERE username LIKE '%$searchInput%'";

        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="user">';
                    echo '<span>' . $row['username'] . '</span>';
                    echo '<form action="add_friend.php" method="POST">';
                    echo '<input type="hidden" name="userID" value="' . $row['userID'] . '">';
                    echo '<button type="submit" name="addFriend">Add Friend</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<div class="no-results">No results found</div>';
            }
        } else {
            echo '<div class="no-results">Error: ' . $conn->error . '</div>';
        }

        $conn->close();
    }
    ?>
</body>
</html>
