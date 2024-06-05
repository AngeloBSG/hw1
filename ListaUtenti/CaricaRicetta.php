<?php
    
    session_start();
    
    $conn = new mysqli("localhost", "root", "", "databaseutenti");
    if ($conn->connect_error){
        die("Connessione fallita" . $conn->connect_error);
    }
    
    //salva la mail della sessione corrente
    if (!isset($_SESSION['email'])) {
        die("Utente non autenticato.");
    }
    $email_utente = $_SESSION['email'];
    
    //Verifica che tutti i campi esistano nell'array $_POST
    if (isset($_POST["codiceRicetta"], $_POST["nomeRicetta"], $_POST["ingredientiRicetta"], $_POST["preparazioneRicetta"])) {
        $codice_ricetta = $_POST["codiceRicetta"];
        $nome_ricetta = $_POST["nomeRicetta"];
        $ingredienti_ricetta = $_POST["ingredientiRicetta"];
        $preparazione_ricetta = $_POST["preparazioneRicetta"];
    
        //Mostra i dati inseriti
        echo "codice: $codice_ricetta<br>";
        echo "nome: $nome_ricetta<br>";
        echo "ingredienti: $ingredienti_ricetta<br>";
        echo "preparazione: $preparazione_ricetta<br>";
    
        //Check se esiste ricetta nel database con quel codice
        $check_stmt = $conn->prepare("SELECT COUNT(*) FROM ricetta WHERE codiceRicetta = ?");
        $check_stmt->bind_param("s", $codice_ricetta);
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->close();
    
        if ($count > 0) {
            die("Una ricetta con questo codice esiste già.");
        }
    
        //Creazione dello statement per l'inserimento della ricetta
        $stmt = $conn->prepare("INSERT INTO ricetta (codiceRicetta, nomeRicetta, ingredientiRicetta, preparazioneRicetta) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die("Preparazione della query fallita: " . $conn->error);
        }
    
        //Bind dei parametri
        $stmt->bind_param("ssss", $codice_ricetta, $nome_ricetta, $ingredienti_ricetta, $preparazione_ricetta);
    
        //Esecuzione della query
        if ($stmt->execute()) {
            echo "Inserimento ricetta avvenuto con successo!";
        
            //Inserimento della tabella ricettaCaricata
            $insert_user_stmt = $conn->prepare("INSERT INTO ricettacaricata (emailUtente, codiceRC) VALUES (?, ?)");
            $insert_user_stmt->bind_param("ss", $email_utente, $codice_ricetta);
            $insert_user_stmt->execute();
            $insert_user_stmt->close();
        
            header("Location: http://localhost/ListaUtenti/PaginaUtente.php");
        } else {
            echo "Esecuzione della query fallita: " . $stmt->error;
        }
    
        //Chiusura dello statement
        $stmt->close();
    } else {
        echo "Tutti i campi sono obbligatori.";
    }
    $conn->close();
?>

