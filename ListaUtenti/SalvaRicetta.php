<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["email"]) && isset($_POST["codiceRicetta"])) {
        $conn = new mysqli("localhost","root","","databaseutenti");
        if ($conn->connect_error) {
            die("Connessione fallita". $conn->connect_error);
        }

        $emailUtente = $_SESSION["email"];
        $codiceRicetta = $_POST["codiceRicetta"];

        //verifica se la ricetta è stata già salvata in precedenza
        $sql_check = "SELECT * FROM ricettaSalvata WHERE codiceRS = ? AND emailUtente = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("ss",$emailUtente, $codiceRicetta);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        //se la ricetta non è presente, la salva nella tabella ricettaSalvata
        if( $result_check->num_rows == 0) {
            $sql_insert = "INSERT INTO ricettaSalvata (emailUtente, codiceRS) VALUES (?, ?) ON DUPLICATE KEY UPDATE emailUtente = VALUES(emailUtente)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("ss",$emailUtente, $codiceRicetta);
            $stmt_insert->execute();

            if($stmt_insert->affected_rows > 0) {
                echo '<script>alert("Ricetta salvata");</script>';
                echo '<script>window.location.href = "http://localhost/ListaUtenti/ElencoRicette.php";</script>';
                exit();
            }else{
                echo "Errore durante il salvataggio della ricetta.";
            }

            $stmt_insert->close();
        }else{
            echo "La ricetta è già stata salvata in precedenza.";
        }

        $stmt_check->close();
        $conn->close();
    }else{
        echo "Errore. Impossibile salvare la ricetta.";
    }
    ?>