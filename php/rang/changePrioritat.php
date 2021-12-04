<?php

include "../sicherheit/XSS.php";
include "../sql/connection.php";
include "Rang.php";

$baseID = xss_clean($_POST["baseID"]);
$targetID = xss_clean($_POST["targetID"]);

$basePrioritat = -1;
$targetPrioritat = -1;

if(!is_numeric($baseID) && !is_numeric($targetID)){
    echo "Es können nur zahlen verarbeitet werden!";
    exit();
}
//abfrage der Prioritat 1
$sth = $pdo->prepare("SELECT Prioritat FROM rang WHERE ID = ?");
$sth->bindParam(1, $baseID);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $basePrioritat = $row["Prioritat"];
}

//abfrage der Prioritat 1
$sth = $pdo->prepare("SELECT Prioritat FROM rang WHERE ID = ?");
$sth->bindParam(1, $targetID);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $targetPrioritat = $row["Prioritat"];
}
if($targetPrioritat == -1 || $basePrioritat == -1){
    exit();
}

//rang 1
$sth = $pdo->prepare("UPDATE rang SET Prioritat = ? WHERE ID = ?");
$sth->bindParam(1, $basePrioritat);
$sth->bindParam(2, $targetID);
$sth->execute();

//rang 2
$sth = $pdo->prepare("UPDATE rang SET Prioritat = ? WHERE ID = ?");
$sth->bindParam(1, $targetPrioritat);
$sth->bindParam(2, $baseID);
$sth->execute();

echo "rang getauscht";
?>