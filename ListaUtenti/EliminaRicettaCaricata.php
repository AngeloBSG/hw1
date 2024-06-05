<?php
    session_start();
    $conn = new mysqli("localhost", "root", "", "databaseutenti");
    if ($conn->connect_error) {
    die("Connessione fallita" . $conn->connect_error);
    }
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["codiceRicetta"])){
            $codiceRicetta = $_POST["codiceRicetta"];

            $conn->begin_transaction();
            try{
                //elimina la ricetta dalla tabella ricettaCaricata
                $sql1 = "DELETE FROM ricettaCaricata WHERE codiceRC = ?";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param("s",$codiceRicetta);
                $stmt1->execute();

                //elimina la ricetta dalla tabella ricettaSalvata
                //se risulta salvata da altri utenti
                $sql3 = "DELETE FROM ricettaSalvata WHERE codiceRS = ?";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->bind_param("s",$codiceRicetta);
                $stmt3->execute();

                //elimina la ricetta dalla tabella ricetta
                $sql2 = "DELETE FROM ricetta WHERE codiceRicetta = ?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("s",$codiceRicetta);
                $stmt2->execute();

                

                $conn->commit();
                echo "Ricetta eliminata con successo.";
            }catch(Exception $e){
                $conn->rollback();
                echo "Errore durante la rimozione della ricetta.";
            }
            $stmt1->close();
            $stmt2->close();
            $stmt3->close();
        }else{
            echo "Codice ricetta non trovato.";
        }
        $conn->close();
    }

    header("Location: http://localhost/ListaUtenti/RicetteCaricate.php");
    exit();
?>