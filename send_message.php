<?php
// Start eller gjenoppta en sesjon
session_start();

// Include the file containing your database connection code
include 'db.php';

// Sjekk om skjemaet for å sende en ny melding er sendt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sjekk om brukeren er logget inn
    if (!isset($_SESSION['userID'])) {
        echo "Du må være logget inn for å sende en melding.";
        exit();
    }

    // Hent meldingsdata fra skjemaet
    $message = $_POST['message'];
    $userID = $_SESSION['userID']; // Juster dette basert på hvordan du lagrer brukerinformasjon

    // Forbered SQL-setningen for å sette inn en ny melding
    $insert_query = $conn->prepare("INSERT INTO messages (message, timestamp, userID) VALUES (?, NOW(), ?)");
    $insert_query->bind_param("si", $message, $userID);

    // Utfør SQL-setningen for å sette inn meldingen
    if ($insert_query->execute()) {
        // Vellykket innsetting av meldingj
        header('Location: test.php');
    } else {
        // Feil ved innsetting av melding
        echo "Feil ved sending av melding: " . $conn->error;
    }
}

// Lukk databaseforbindelsen
$conn->close();
?>
