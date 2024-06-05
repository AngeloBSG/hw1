<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "Errore: Metodo di richiesta non consentito.";
    exit;
}

if (!isset($_SESSION["email"])) {
    echo "Devi essere loggato per mettere Like";
    exit();
}

if (!isset($_POST["codiceRicetta"])) {
    echo "Errore: Codice ricetta non specificato.";
    exit;
}

$emailUtente = $_SESSION["email"];
$codiceRicetta = $_POST["codiceRicetta"];

$conn = new mysqli("localhost", "root", "", "databaseutenti");
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Controlla se l'utente ha già messo Mi Piace per questa ricetta
$sqlCheckLike = "SELECT COUNT(*) AS likeCount FROM miPiace WHERE emailUtente = ? AND codiceRicetta = ?";
$stmtCheckLike = $conn->prepare($sqlCheckLike);
$stmtCheckLike->bind_param("ss", $emailUtente, $codiceRicetta);
$stmtCheckLike->execute();
$resultCheckLike = $stmtCheckLike->get_result();
$rowCheckLike = $resultCheckLike->fetch_assoc();
$likeCount = $rowCheckLike['likeCount'];

if ($likeCount > 0) {
    // Se l'utente ha già messo Mi Piace per questa ricetta, rimuovi il Mi Piace
    $sqlRemoveLike = "DELETE FROM miPiace WHERE emailUtente = ? AND codiceRicetta = ?";
    $stmtRemoveLike = $conn->prepare($sqlRemoveLike);
    $stmtRemoveLike->bind_param("ss", $emailUtente, $codiceRicetta);

    if ($stmtRemoveLike->execute()) {
        echo "Unlike eseguito con successo.";
    } else {
        echo "Errore: " . $stmtRemoveLike->error;
    }

    $stmtRemoveLike->close();
} else {
    // Se l'utente non ha ancora messo Mi Piace per questa ricetta, aggiungi il Mi Piace
    $sqlInsertLike = "INSERT INTO miPiace (emailUtente, codiceRicetta) VALUES (?, ?)";
    $stmtInsertLike = $conn->prepare($sqlInsertLike);
    $stmtInsertLike->bind_param("ss", $emailUtente, $codiceRicetta);

    if ($stmtInsertLike->execute()) {
        echo "Like aggiunto con successo.";
    } else {
        echo "Errore: " . $stmtInsertLike->error;
    }

    $stmtInsertLike->close();
}

$stmtCheckLike->close();
$conn->close();
?>
