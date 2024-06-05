<?php
    session_start();
    $conn = new mysqli("localhost", "root", "", "databaseutenti");
    if ($conn->connect_error) {
    die("Connessione fallita" . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset( $_POST["codiceRicetta"])) {
            $codiceRicetta = $_POST["codiceRicetta"];
            $emailUtente = $_SESSION["email"];
            $conn->begin_transaction();
            try{
                //elimina la ricetta dalla tabella ricettaSalvata
                $sql = "DELETE FROM ricettaSalvata WHERE codiceRS = ? AND emailUtente = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $codiceRicetta, $emailUtente);
                $stmt->execute();

                $conn->commit();
                echo "Ricetta eliminata con successo.";
                //ritorno alla pagina delle ricette salvate
                header("Location: http://localhost/ListaUtenti/RicetteSalvate.php");
                exit();
            } catch(Exception $e) {
                $conn->rollback();
                echo "Errore durante l'eliminazione della ricetta.";
            }
            $stmt->close();
        }else{
            echo "Codice ricetta non trovato.";

        }
    }else{
        echo "Richiesta non valida.";
        $conn->close();
    }
?>