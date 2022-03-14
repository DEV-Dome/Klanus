<?php
session_start();

include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../php/sql/connection.php";

$kurzel = strtolower(trim(xss_clean($_POST["name"])));
$id = trim(xss_clean($_POST["id"]));

$rang = new Rang($_SESSION['Rang'], $pdo);
if(!$rang->hasPermission("projekt.edit.kurzel")){
    echo "<erro>Dafür hast du nicht die nötigen Permission.";
    exit();
}

$sth = $pdo->prepare("SELECT * FROM projekt WHERE Kurzel = ? LIMIT 1");
$sth->bindParam(1, $kurzel);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    echo "<erro>Dieses projekt ist bereits vorhanden!";
    exit();
}

if(strlen($kurzel) != 3){
    echo "<erro>Das Projektkürzel muss genau 3 Zeichen lang sein</erro>";
    exit();
}

$sth = $pdo->prepare("UPDATE projekt SET Kurzel = ? WHERE ID = ?");
$sth->bindParam(1, $kurzel);
$sth->bindParam(2, $id);
$sth->execute();

echo "Das Neue Projektkürzel ist: $kurzel";