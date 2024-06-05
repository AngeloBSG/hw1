<?php
// Verifica che la sessione sia avviata
session_start();

// Verifica che l'utente sia loggato
if (!isset($_SESSION["email"])) {
    // Se l'utente non è loggato, puoi reindirizzarlo alla pagina di login o mostrare un messaggio di errore
    header("Location: pagina_di_login.php");
    exit; // Assicura che lo script si interrompa dopo il reindirizzamento
}

// Recupera l'email dell'utente dalla sessione
$emailUtente = $_SESSION["email"];

// Qui puoi iniziare a visualizzare l'elenco delle ricette...
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='ElencoRicette.css'>
    <script src="ElencoRicette.js" defer></script>
    <title>Ricette Caricate</title>
</head>

<body background="img\Sfondo.jpg">
    <nav>
        <a href="http://localhost/ListaUtenti/PaginaUtente.php" class="Opzioni">Torna alla pagina utente</a>
        <div id = "Ricerca">
            <input id="InputBar" type='text' placeholder='Inserire nome ricetta' value="">
            <button id="SearchButton" type="button" onClick="cercaRicetta()">Ricerca</button>
        </div>
    </nav>

    <section>
        <div id="ContenitoreRicetta">
            <div id="ContTitle">Elenco ricette nel database<br><br>
            <?php
                $conn = new mysqli("localhost", "root", "", "databaseutenti");
                $sql = "SELECT r.codiceRicetta, r.nomeRicetta, r.ingredientiRicetta, r.preparazioneRicetta,
                        (SELECT COUNT(*) FROM miPiace WHERE miPiace.codiceRicetta = r.codiceRicetta)
                        AS likeCount FROM ricetta r";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="Elemento">';
                        echo '<strong>Codice:</strong>' . htmlspecialchars($row["codiceRicetta"]) . '<br>';
                        echo '<strong>Nome:</strong>' . htmlspecialchars($row["nomeRicetta"]) . '<br>';
                        echo '<strong>Ingredienti:</strong>' . htmlspecialchars($row["ingredientiRicetta"]) . '<br>';
                        echo '<strong>Preparazione:</strong>' . htmlspecialchars($row["preparazioneRicetta"]) . '<br><br>';
                        echo '<form method="POST" action="SalvaRicetta.php">';
                        echo '<input type="hidden" name="codiceRicetta" value="' . htmlspecialchars($row["codiceRicetta"]) . '">';
                        echo '<button type="submit">Salva Ricetta</button>';
                        echo '<a href="#" onClick="mettiLike(this)" data-codice-ricetta="' . htmlspecialchars($row["codiceRicetta"]) . '" id="Like_' . htmlspecialchars($row["codiceRicetta"]) . '">Like: <span id="likeCount_' . htmlspecialchars($row["codiceRicetta"]) . '">' . htmlspecialchars($row["likeCount"]) . '</span></a>';
                        echo '</form>';
                        echo '</div>';
                        echo "<br><br>";
                    }
                } else {
                    echo "Nessun risultato trovato.";
                }
                $conn->close();
            ?></div>

    </section>
</body>
</html>

