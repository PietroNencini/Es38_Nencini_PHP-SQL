<?php
    include "../connessione.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Script</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
    <h1 class="bg-primary text-center"> RISULTATO DELLA RICHIESTA </h1>

    <?php
        if($conn->connect_error)
            header("Location: ../error.html");

        $id_review = $_POST["rev_id"];
        if(!isset($_POST["choice"])) {
            echo "<p> ERRORE </p>";
            exit();
        }
        $choice = $_POST["choice"];
        switch($choice) {
            case "update":
                $new_vote = $_POST["new_val"];
                $query = "UPDATE recensioni SET voto = $new_vote WHERE IDrecensione = $id_review";
                break;
            case "delete":
                $query = "DELETE FROM recensioni WHERE IDrecensione = $id_review";
            default:
                echo "ERRORE";
                exit();
        }
            $good_query = $conn->query($query);

            if($good_query && $choice == "update") {
                $output = "<p class='text-success text-center'> Recensione AGGIORNATA correttamente </p>";
            } elseif($good_query && $choice == "delete") {
                $output = "<p class='text-success text-center'> Recensione ELIMINATA correttamente </p>";
            } elseif(!$good_query && $choice == "update") {
                $output = "<p class='text-danger text-center'> ERRORE nell'AGGIORNAMENTO della recensione </p>";
            } else {
                $output = "<p class='text-danger text-center'> ERRORE nell'ELIMINAZIONE della recensione </p>";
            }
        
        

        echo $output;
    ?>

    <a href="../index.html" class="link-primary text-center" target="_self"> TORNA ALLA HOMEPAGE </a>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>