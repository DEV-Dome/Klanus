<?php
session_start();

include "../../../php/sicherheit/XSS.php";
include "../../../php/sql/connection.php";

$fromid = xss_clean($_POST["fromid"]);
$toid = xss_clean($_POST["toid"]);

$fromPrioritat = -1;
$toPrioritat = -1;

$sth = $pdo->prepare("SELECT Prioritat FROM projekt_user WHERE ID = ?");
$sth->bindParam(1, $fromid);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $fromPrioritat = $row["Prioritat"];
}

$sth = $pdo->prepare("SELECT Prioritat FROM projekt_user WHERE ID = ?");
$sth->bindParam(1, $toid);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $toPrioritat = $row["Prioritat"];
}
echo "$fromid : $fromPrioritat <br>";
echo "$toid : $toPrioritat";

$sth = $pdo->prepare("UPDATE projekt_user SET Prioritat = ? WHERE ID = ?");
$sth->bindParam(1, $toPrioritat);
$sth->bindParam(2, $fromid);
$sth->execute();

$sth = $pdo->prepare("UPDATE projekt_user SET Prioritat = ? WHERE ID = ?");
$sth->bindParam(1, $fromPrioritat);
$sth->bindParam(2, $toid);
$sth->execute();

