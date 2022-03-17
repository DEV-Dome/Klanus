<?php
session_start();

include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../php/sql/connection.php";

$id = trim(xss_clean($_POST["id"]));

$rang = new Rang($_SESSION['Rang'], $pdo);
if(!$rang->hasPermission("projekt.delete")){
    echo "<erro>Dafür hast du nicht die nötigen Permission.";
    exit();
}
$sth = $pdo->prepare("SELECT * FROM projekt_rang WHERE Projekt  = $id");
$sth->execute();
foreach ($sth->fetchAll() as $row) {
    $sth = $pdo->prepare("DELETE FROM projekt_rang_permission_syc WHERE Rang = ". $row["ID"]);
    $sth->execute();
}
$sth = $pdo->prepare("DELETE FROM projekt_rang WHERE Projekt  = $id");
$sth->execute();

$sth = $pdo->prepare("DELETE FROM projekt WHERE ID = ?");
$sth->bindParam(1, $id);
$sth->execute();