<?php
/* 

Realizzare una query che elenchi tutti i numeri di telefono e le e-mail di tutti i fornitori.
L’elenco dovrà mostrare la ragione sociale del fornitore, i telefoni, le email e le persone cui i telefoni e 
le email sono associati e dovrà essere ordinato per ragione sociale del fornitoremail. 

*/
$conn = new mysqli('localhost','root','','magazzino');
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
$sql = "SELECT fornitori.ragione_sociale,telefoni.telefono, telefoni.persona as persona  FROM fornitori INNER JOIN telefoni ON fornitori.id_fornitore = telefoni.fornitore ORDER BY ragione_sociale";
$sql2="SELECT fornitori.ragione_sociale,email.email,email.persona as persona FROM fornitori INNER JOIN email ON fornitori.id_fornitore = email.fornitore ORDER BY ragione_sociale";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>ragione sociale</th>";
    echo "<th>telefono</th>";
    echo "<th>persona</th>"; 
    echo "</tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['ragione_sociale']."</td>";
        echo "<td>".$row['telefono']."</td>";
        echo "<td>".$row['persona']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
}
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>ragione sociale</th>";
    echo "<th>email</th>";
    echo "<th>persona</th>";
    echo "</tr>";
    while($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['ragione_sociale']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['persona']."</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>es2</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
</html>