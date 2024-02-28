<?php
if (!isset($_GET['codice'])) {
    header('Location: esercizio1.php?codice=seg0000001');
}
$codice= $_GET['codice'];
$conn = new mysqli('localhost','root','','magazzino');
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
$sql = "SELECT * FROM articoli WHERE codice='$codice'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $descrizione = $row['descrizione'];
    }
}
$sql2="SELECT * FROM movimentazione WHERE codice_articolo='$codice' ";
$result2 = $conn->query($sql2);
$array = array();
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $array[] = $row;
    }
}
$sql3="SELECT carico  FROM movimentazione WHERE codice_articolo='$codice' and carico>0";
$result3 = $conn->query($sql3);
$carico = array();
if ($result3->num_rows > 0) {
    while($row = $result3->fetch_assoc()) {
        $carico[] = $row;
    }
}
$sql4="SELECT scarico  FROM movimentazione WHERE codice_articolo='$codice' and scarico>0";
$result4 = $conn->query($sql4);
$scarico = array();
if ($result4->num_rows > 0) {
    while($row = $result4->fetch_assoc()) {
        $scarico[] = $row;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>esercizio1</title>
</head>
<body>
   <center> <h1>Movimentazione di un Articolo</h1>
    <h1>Movimenti di Carico e Scarico dell'Articolo:<?php echo $descrizione; ?>- Codice: <?php echo $codice; ?></h1><center>
    <?php
                    if(!empty($array)){
                        echo "<table border='1'>";
                        echo"<tr>";
                        echo"<th>Descrizione movimento</th><th>Carico</th><th>Scarico</th></tr>";
                        foreach($array as $row_documento) {
                            echo "<tr>";
                            echo "<td>".$row_documento['descrizione']."</td>";
                            echo "<td>".$row_documento['carico']."</td>";
                            echo "<td>".$row_documento['scarico']."</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }else{
                    }
        ?>
    <br>
    <h1>Totale movimenti:<?php echo count($array); ?> - Carichi:<?php echo count($carico); ?> - Scarichi:<?php echo count($scarico); ?> </h1>
</body>
</html>