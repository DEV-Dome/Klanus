<?php
session_start();

include "../../../../../php/sicherheit/XSS.php";
include "../../../../../php/sql/connection.php";
include "../../../../../php/rang/Rang.php";
include "../../rang/projektRang.php";

$prang = new projektRang($_SESSION['PRang'], $pdo);
$rang = new Rang($_SESSION['Rang'], $pdo);

$baseID = xss_clean($_POST["baseID"]);
$targetID = xss_clean($_POST["targetID"]);

$basePrioritat = -1;
$targetPrioritat = -1;

if($prang->hasPermission("rang.posistion") || $rang->hasPermission("all.rang.posistion")) {

    if (!is_numeric($baseID) && !is_numeric($targetID)) {
        exit();
    }
//abfrage der Prioritat 1
    $sth = $pdo->prepare("SELECT Prioritat FROM projekt_rang WHERE ID = ?");
    $sth->bindParam(1, $baseID);
    $sth->execute();

    foreach ($sth->fetchAll() as $row) {
        $basePrioritat = $row["Prioritat"];
    }

//abfrage der Prioritat 1
    $sth = $pdo->prepare("SELECT Prioritat FROM projekt_rang WHERE ID = ?");
    $sth->bindParam(1, $targetID);
    $sth->execute();

    foreach ($sth->fetchAll() as $row) {
        $targetPrioritat = $row["Prioritat"];
    }
    if ($targetPrioritat == -1 || $basePrioritat == -1) {
        exit();
    }

//rang 1
    $sth = $pdo->prepare("UPDATE projekt_rang SET Prioritat = ? WHERE ID = ?");
    $sth->bindParam(1, $basePrioritat);
    $sth->bindParam(2, $targetID);
    $sth->execute();

//rang 2
    $sth = $pdo->prepare("UPDATE projekt_rang SET Prioritat = ? WHERE ID = ?");
    $sth->bindParam(1, $targetPrioritat);
    $sth->bindParam(2, $baseID);
    $sth->execute();

    echo "rang getauscht";
}else {
    exit();
}

