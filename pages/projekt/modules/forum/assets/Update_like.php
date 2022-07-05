<?php
session_start();

include "../../../../../php/sicherheit/XSS.php";
include "../../../../../php/sql/connection.php";
include "../../../../../php/rang/Rang.php";
include "../../rang/projektRang.php";

$kid = trim(xss_clean($_POST["kid"]));

$sqlstr = "SELECT * FROM projekt_forum_beitrage_kommentare_like WHERE Kommentar  = ? AND User = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $kid);
$sth->bindParam(2, $_SESSION["ID"]);
$sth->execute();

foreach($sth->fetchAll() as $row) {
    //löschen
    $sqlstr = "DELETE FROM  projekt_forum_beitrage_kommentare_like WHERE User = ? AND Kommentar = ?";
    $sth = $pdo->prepare($sqlstr);
    $sth->bindParam(1, $_SESSION["ID"]);
    $sth->bindParam(2, $kid);
    $sth->execute();
    exit();
}

$dt = new DateTime();
$jetzt = $dt->format("Y-m-d H:i:s");
//eintragen
$sqlstr = "INSERT INTO projekt_forum_beitrage_kommentare_like (User, Kommentar, Time) ";
$sqlstr .= "VALUE (?, ?, ?)";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $_SESSION["ID"]);
$sth->bindParam(2, $kid);
$sth->bindParam(3, $jetzt);
$sth->execute();

