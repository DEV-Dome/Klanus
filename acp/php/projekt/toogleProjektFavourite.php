<?php
session_start();
include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../php/sql/connection.php";

$pid = xss_clean($_POST["pid"]);
$newValue = 1;
$id = -1;

$sqlerg = "SELECT * FROM projekt_user WHERE Projekt = ? AND User = ? LIMIT 1";
$sth = $pdo->prepare($sqlerg);
$sth->bindParam(1, $pid);
$sth->bindParam(2, $_SESSION["ID"]);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    if($row["IsFavourite"] == 1) {
        $newValue = 0;
    }
    $id = $row["ID"];
}

$sqlerg = "UPDATE projekt_user SET IsFavourite=? WHERE ID=?";
$sth = $pdo->prepare($sqlerg);
$sth->bindParam(1, $newValue);
$sth->bindParam(2, $id);
$sth->execute();
?>
