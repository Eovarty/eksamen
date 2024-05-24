<?php
// server, brukernavn, passord og database navn for å koble til mariadb database
$server = "localhost";
$user = "root";
$pw = "Admin";
$db = "chat";

//Danner Kobling
$conn = mysqli_connect($server, $user, $pw, $db);

// Sjekk tilkoblingen
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
