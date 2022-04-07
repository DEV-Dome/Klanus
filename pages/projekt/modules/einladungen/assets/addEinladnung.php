<?php
session_start();

function generateRandomString($length = 12) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

include "../../../../../php/sicherheit/XSS.php";
include "../../../../../php/sql/connection.php";
include "../../../../../php/rang/Rang.php";
include "../../rang/projektRang.php";


$prang = new projektRang($_SESSION['PRang'], $pdo);
$rang = new Rang($_SESSION['Rang'], $pdo);

if(!$prang->hasPermission("einladnung.new") && !$rang->hasPermission("all.einladnung.new")) {
    exit();
}
$code = generateRandomString();
$escape = true;

gen:
$sth = $pdo->prepare("SELECT * FROM projekt_einladungen WHERE Einladung = ?");
$sth->bindParam(1, $code);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $code = generateRandomString();
    goto gen;
}



$sth = $pdo->prepare("INSERT INTO projekt_einladungen (Projekt, Einladung, User) VALUE (?, ?, ?)");
$sth->bindParam(1, $_SESSION["projekt.aktiv"]);
$sth->bindParam(2, $code);
$sth->bindParam(3, $_SESSION["ID"]);
$sth->execute();
