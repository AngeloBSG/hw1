<?php
    session_start();
    $conn = new mysqli("localhost", "root", "", "databaseutenti");
    if ($conn->connect_error){
        die("Connessione fallita" . $conn->connect_error);
    }

    $conn = new mysqli("localhost", "root", "", "databaseutenti");
    $email_utente = $_SESSION["email"];
    $sql = "SELECT r.codiceRicetta, r.nomeRicetta, r.ingredientiRicetta, r.preparazioneRicetta
    FROM ricetta r
    JOIN ricettaCaricata rc ON r.codiceRicetta = rc.codiceRC
    WHERE rc.emailUtente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_utente);
    $stmt->execute();
    $result = $stmt->get_result();
?>


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='RicetteCaricate.css'>
    <title>Ricette Caricate</title>
</head>

<body background="img\Sfondo.jpg">
    <nav>
        <a href="http://localhost/ListaUtenti/CaricaRicetta.html" class="Opzioni">Carica una nuova ricetta</a>
        <a href="http://localhost/ListaUtenti/PaginaUtente.php" class="Opzioni">Torna alla pagina utente</a>
    </nav>

    <section>
        <div id="ContenitoreRicetta">
            <div id="ContTitle">Elenco ricette caricate</br>
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="Elemento">';
                        echo "<strong>Codice:</strong> " . htmlspecialchars($row["codiceRicetta"]) . "<br>";
                        echo "<strong>Nome:</strong> " . htmlspecialchars($row["nomeRicetta"]) . "<br>";
                        echo "<strong>Ingredienti:</strong> " . htmlspecialchars($row["ingredientiRicetta"]) . "<br>";
                        echo "<strong>Preparazione:</strong> " . htmlspecialchars($row["preparazioneRicetta"]) . "<br><br>";
                        echo '<form method="POST" action="EliminaRicettaCaricata.php">';
                        echo '<input type="hidden" name="codiceRicetta" value="' . htmlspecialchars($row["codiceRicetta"]) . '">';
                        echo '<button type="submit">Elimina</button>';
                        echo '</form>';
                        echo '</div>';
                        echo "<br><br>";
                    }
                } else {
                    echo "Nessun risultato trovato.";
                }
            ?>
            </div>
            
        </div>

    </section>


</body>
</html>