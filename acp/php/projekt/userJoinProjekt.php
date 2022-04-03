<?php
session_start();
include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../php/sql/connection.php";

$pid = xss_clean($_POST["pid"]);

$rangName = "User";
$rangid = -1;
$IsOwner = 0;

$dt = new DateTime();
$datum = $dt->format("Y-m-d H:i:s");

//projeckt user rang selecten
$sqlerg = "SELECT * FROM projekt_rang WHERE Projekt = ? AND Name = ? LIMIT 1";
$sth = $pdo->prepare($sqlerg);
$sth->bindParam(1, $pid);
$sth->bindParam(2, $rangName);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $rangid = $row["ID"];
}


//eintrag als User im projekt
$sth = $pdo->prepare("INSERT INTO projekt_user (User, Projekt , Rang, IsOwner , Datum) VALUE (?, ?, ?, ?, ?)");
$sth->bindParam(1, $_SESSION["ID"]);
$sth->bindParam(2, $pid);
$sth->bindParam(3, $rangid);
$sth->bindParam(4, $IsOwner);
$sth->bindParam(5, $datum);
$sth->execute();

