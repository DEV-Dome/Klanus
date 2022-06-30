<?php
session_start();

include "../../../../../php/sicherheit/XSS.php";
include "../../../../../php/sql/connection.php";
include "../../../../../php/rang/Rang.php";
include "../../rang/projektRang.php";

$prang = new projektRang($_SESSION['PRang'], $pdo);
$rang = new Rang($_SESSION['Rang'], $pdo);

$name = trim(xss_clean($_POST["name"]));
$inhalt = trim(xss_clean($_POST["inhalt"]));
$beitrag = trim(xss_clean($_POST["beitrag"]));

$dt = new DateTime();
$jetzt = $dt->format("Y-m-d H:i:S");

//TODO Rechte abfragen

if(strlen($name) <= 2 || strlen($name) >= 149){
    echo "<erro>Der Name muss Zwischen 3 und 150 Zeichen haben</erro>";
    exit();
}

if(strlen($inhalt) <= 19 || strlen($inhalt) >= 65534){
    echo "<erro>Der Beitrag muss mindenst 20 Ziechen haben</erro>";
    exit();
}

$sqlstr = "INSERT INTO projekt_forum_beitrage_kommentare (Name, Text, Status, Beitrag , Owner , ErstelltAm) ";
$sqlstr .= "VALUE (?, ?, 1, ?, ?, ?)";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $name);
$sth->bindParam(2, $inhalt);
$sth->bindParam(3, $beitrag);
$sth->bindParam(4, $_SESSION["ID"]);
$sth->bindParam(5, $jetzt);
$sth->execute();

echo "Kommentar gepostet";
