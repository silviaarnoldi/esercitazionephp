<!DOCTYPE html>
<html>
<head>
    <title>es1</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="es1.php" method="post">
        <label for="luogo">Inserisci il luogo</label>
        <input type="text" name="luogo">
        <input type="submit" value="cerca">
    </form>
    <br>
    <?php
        session_start();
        /*Realizzare una query che, richiesto all’utente il nome di un luogo, elenchi tutti i fornitori la cui sede è nel luogo specificato.
        L’elenco – che mostrerà tutti i campi dei fornitori - dovrà essere ordinato per ragione sociale.*/
        if (isset($_POST['luogo'])) {
            $luogo = $_POST['luogo'];
            $conn = new mysqli('localhost','root','','magazzino'); 
            if ($conn->connect_error) {
                die("Connessione fallita: " . $conn->connect_error);
            }
            //query che mi controlli se il luogo inserito è presente nel database e ritornare l'id
            $sql = "SELECT id_luogo FROM luoghi WHERE descrizione='$luogo'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id_luogo = $row['id_luogo'];
                //query che mi ritorna tutti i fornitori con sede nel luogo inserito
                $sql = "SELECT * FROM fornitori WHERE luogo=$id_luogo ORDER BY ragione_sociale";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>ragione_sociale</th>";
                    echo "<th>indirizzo</th>";
                    echo "<th>cap</th>";
                    echo "</tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['ragione_sociale']."</td>";
                        echo "<td>".$row['indirizzo']."</td>";
                        echo "<td>".$row['cap']."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }
            $conn->close();
        }
    ?>
</body>
</html>