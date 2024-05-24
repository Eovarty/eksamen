<?php
include 'db.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to delete user
function deleteUser($conn, $userID) {
    $sql = "DELETE FROM users WHERE userID = $userID";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST["user_id"];
    deleteUser($conn, $userID);
}

// Get list of users
$sql = "SELECT userID, username FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Raleway:ital@0;1&display=swap');

    </style>
</head>
<body>
    <div class="container">
        <h1>Delete User</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="user_id">Select User:</label>
            <select name="user_id" id="user_id">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["userID"] . "'>" . $row["username"] . "</option>";
                    }
                } else {
                    echo "<option value=''>No users found</option>";
                }
                ?>
            </select>
            <br><br>
            <input type="submit" value="Delete">
        </form>
    </div>
</body>
</html>

