<?php
session_start();

include "../../../../../php/sicherheit/XSS.php";
include "../../../../../php/sql/connection.php";
include "../../../../../php/rang/Rang.php";
include "../../rang/projektRang.php";

$bid = trim(xss_clean($_POST["bid"]));
$grund = trim(xss_clean($_POST["grund"]));

if(strlen($grund) <= 19 || strlen($grund) >= 65534){
    echo "<erro>Der Grund muss mindenst 20 Ziechen haben</erro>";
    exit();
}

$dt = new DateTime();
$jetzt = $dt->format("Y.m.d H:i:s");

$sqlstr = "INSERT INTO projekt_melden (User, Grund,Referenz, Modul, Kategorie, Time) ";
$sqlstr .= "VALUE (?, ?, ?, 4, 'Kommentar', ?)";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $_SESSION["ID"]);
$sth->bindParam(2, $grund);
$sth->bindParam(3, $bid);
$sth->bindParam(4, $jetzt);
$sth->execute();

echo "Beitrag gemeldet";
?>
