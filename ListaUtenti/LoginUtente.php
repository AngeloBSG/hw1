<?php
    //inizio sessione
    session_start();

    
    if(isset($_SESSION["email"])){
        header('Location: http://localhost/ListaUtenti/PaginaUtente.php');
        exit;
    }
    

    //verifica della presenza dei dati POST
    if(isset($_POST["email"]) && isset ($_POST["passwordUt"])){

        //connessione al database
        $conn = mysqli_connect("localhost","root","","databaseutenti");

        //ricerca dell'utente tramite le credenziali
        $query = "SELECT * FROM Utente WHERE email = '".$_POST['email']."'
                AND passwordUt = '".$_POST['passwordUt']."'";
        $res = mysqli_query($conn, $query);

        //Controllo che le credenziali siano corrette
        if(mysqli_num_rows($res)>0){

            //imposta la variabile della sessione
            $_SESSION["email"] = $_POST["email"];

            //indirizza alla pagina dell'utente
            header('Location: http://localhost/ListaUtenti/PaginaUtente.php');
            exit;
        }else{
            echo "<p class='errore'>";
            echo "Credenziali non valide.";
            echo "</p>";
        }

        //chiusura connesione
        $conn->close();
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel='stylesheet' href='LoginUtente.css'>
        <script src="LoginUtente.js" defer></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
        <title>Login Utente</title>
    </head>
    <body background="img\Sfondo.jpg">
    
        <nav>
            <div id="MainTitleSec">
                <h1 id="MainTitle">Benvenuto. Accedi al tuo account usando le tue credenziali.</h1>
            </div>
        </nav>

        <section>
            <div id="sezioneFormLog">
                <form name="LoginUtente" method="POST">
                    <label for="email" class="Label">E-mail <input type="email" id="nome" name="email" placeholder="Inserisci nome" required>    </label>
                    <label for="password" class="Label">Password <input type="password" id="password" name="passwordUt" placeholder="Inserisci cognome" required> </label>
                    <label><input type="submit" name="invia" value="invia"></label>
                </form>
            </div>
        </section>

    </body>
</html>

    