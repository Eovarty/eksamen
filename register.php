<?php

include 'db.php'; // Include the file containing your database connection code


// Process registration form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the username is already taken
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $check_result = $conn->query($check_query);
    if ($check_result->num_rows > 0) {
        echo "Username already exists. Please choose a different one.";
        exit();
    }

    // Example hashing (replace with appropriate secure password hashing)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the insert statement to avoid SQL injection
    $insert_query = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $insert_query->bind_param("sss", $username, $email, $hashed_password);


    if ($insert_query->execute()) {
        header("location: login.html");
        exit();
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}
?>
