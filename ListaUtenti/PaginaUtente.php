<?php
    // Avvia la sessione
    session_start();
    // Verifica se l'utente è loggato
    if(!isset($_SESSION['email']))
    {
        // Vai alla login
        header("Location: LoginUtente.php");
        exit;
    }

    //funzione per ottenere le credenziali dell'utente
    function getCredenzialiUtente($conn, $email, $campo){
        $sql = "SELECT $campo FROM utente WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $value = "Nessun risultato trovato";
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $value = htmlspecialchars($row[$campo]);
        }

        $stmt->close();
        return $value;
    }

    $conn = new mysqli("localhost","root","","databaseutenti");
    if($conn->connect_error){
        die("Connessione fallita". $conn->connect_error);
    }

    $email_utente = $_SESSION["email"];
    $nome_utente = getCredenzialiUtente($conn, $email_utente, "nome");
    $cognome_utente = getCredenzialiUtente($conn, $email_utente, "cognome");
    $sesso_utente = getCredenzialiUtente($conn, $email_utente, "sesso");
    $annoNascita_utente = getCredenzialiUtente( $conn, $email_utente, "annoNascita");

    $conn->close();
?>

<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="Stylesheet" href="PaginaUtente.css">
    <title>Pagina Utente</title>
</head>

<body background="img\Sfondo.jpg">

    <nav>
        <h1 id="MainTitle">Benvenuto <?php
        
            ?> nella tua pagina utente!</h1>
        <form action="Logout.php" method="POST" id="logoutBtn">
            <button type="submit" id="logoutBtn">Logout</button>
        </form>
    </nav>

    
    <header>
        <img id="FotoProfilo" src="img\fotoProfilo.jpg">
        <div id="SezioneProfilo">
            <div id="DettagliPesonali">
                <div class="Credenziali">Nome: <?php echo $nome_utente; ?></div><br>
                <div class="Credenziali">Cognome: <?php echo $cognome_utente; ?></div><br>
                <div class="Credenziali">E-mail: <?php echo $_SESSION["email"]; ?></div><br>
                <div class="Credenziali">Sesso: <?php echo $sesso_utente; ?></div><br>
                <div class="Credenziali">Anno di Nascita: <?php echo $annoNascita_utente; ?></div><br>
            </div>
        </div>
    </header>

    <section>
        <div id="RigaScelta">
            <a href="http://localhost/ListaUtenti/RicetteCaricate.php" class="elementoRiga">Carica una ricetta</a>
            <a href="http://localhost/ListaUtenti/ElencoRicette.php" class="elementoRiga">Mostra tutte le ricette</a>
            <a href="http://localhost/ListaUtenti/RicetteSalvate.php" class="elementoRiga">Controlla ricette salvate</a>
            <a href="http://localhost/index.php" class="elementoRiga">Torna alla Home del sito</a>
        </div>
    </section>

</body>
</html>