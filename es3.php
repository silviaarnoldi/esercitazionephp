<!DOCTYPE html>
<html>
<head>
    <title>es3</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="es3.php" method="post">
        <label for="codice">Inserisci il codice del fornitore</label>
        <input type="text" name="codice">
        <input type="submit" value="cerca">
    </form>
    <br>
    <?php
        session_start();
        /*Realizzare una query che, richiesto all’utente il codice di un fornitore, 
        elenchi tutti gli articoli la cui descrizione contiene la lettera ‘S’.
        L’elenco – che mostrerà tutti i campi dell’articolo - dovrà essere ordinato per costo decrescente..*/
        if (isset($_POST['codice'])) {
            $codice = $_POST['codice'];
            $conn = new mysqli('localhost','root','','magazzino'); 
            if ($conn->connect_error) {
                die("Connessione fallita: " . $conn->connect_error);
            }
                $sql = "SELECT * FROM articoli WHERE id_fornitore=$codice AND descrizione LIKE '%S%' ORDER BY costo DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>codice</th>";
                    echo "<th>id fornitore</th>";
                    echo "<th>descrizione</th>";
                    echo "<th>scorta minima</th>";
                    echo "<th>costo</th>";
                    echo "</tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['codice']."</td>";
                        echo "<td>".$row['id_fornitore']."</td>";
                        echo "<td>".$row['descrizione']."</td>";
                        echo "<td>".$row['scorta_minima']."</td>";
                        echo "<td>".$row['costo']."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }
    ?>
</body>
</html>