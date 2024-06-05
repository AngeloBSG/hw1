<?php

    $conn = new mysqli("localhost","root","","databaseutenti");
    if ($conn->connect_error){
        die("Connessione fallita". $conn->connect_error);
    }

    // Verifica che tutti i campi esistano nell'array $_POST
    if (isset($_POST["nome"], $_POST["cognome"], $_POST["email"], $_POST["passwordUt"], $_POST["sesso"], $_POST["annoNascita"])) {
        
        $nome_utente = $_POST["nome"];
        $cognome_utente = $_POST["cognome"];
        $email_utente = $_POST["email"];
        $password_utente = $_POST["passwordUt"];
        $sesso_utente = $_POST["sesso"];
        $annoNascita_utente = (int) $_POST["annoNascita"];

        //Debug: Visualizza i dati ricevuti
        echo "Nome: $nome_utente<br>";
        echo "Cognome: $cognome_utente<br>";
        echo "Email: $email_utente<br>";
        echo "Password: $password_utente<br>";
        echo "Sesso: $sesso_utente<br>";
        echo "Anno di Nascita: $annoNascita_utente<br>";

        // Funzione per la Convalida della password
        function convalidaPassword($password_utente){
            $min_length = 10;
            $has_uppercase = preg_match('/[A-Z]/', $password_utente);
            $has_lowercase = preg_match('/[a-z]/', $password_utente);
            $has_number = preg_match('/\d/', $password_utente);
            $has_special_char = preg_match('/[^a-zA-Z\d]/', $password_utente);

            //check
            if(strlen($password_utente) < $min_length){
                return "La password deve essere minimo $min_length caratteri.";
            }

            if(!$has_uppercase){
                return "La password deve contenere almeno una lettera maiuscola.";
            }

            if(!$has_lowercase){
                return "La password deve contenere almeno una lettera minuscola.";
            }

            if(!$has_number){
                return "La password deve contenere almeno un numero.";
            }

            if(!$has_special_char){
                return "La password deve contenere almeno un carattere speciale.";
            }

            return true;
        }

        //Convalida della password
        $risultato_validazione_password = convalidaPassword($password_utente);
        if($risultato_validazione_password !== true){
            die($risultato_validazione_password);
        }

        //creazione dello statement
        $stmt = $conn->prepare("INSERT INTO Utente (nome, cognome, email, passwordUt, sesso, annoNascita) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Preparazione della query fallita: " . $conn->error);
        }
    
        // Bind dei parametri
        $stmt->bind_param("sssssi", $nome_utente, $cognome_utente, $email_utente, $password_utente, $sesso_utente, $annoNascita_utente);
        
        // Esecuzione della query
        if ($stmt->execute()) {
            echo "Inserimento Utente avvenuto con successo!";
            header("Location: http://localhost/index.php");
        } else {
            echo "Esecuzione della query fallita: " . $stmt->error;
        }
        
        // Chiusura dello statement
        $stmt->close();
    } else {
        echo "Tutti i campi sono obbligatori.";
    }
    $conn->close();
?>
