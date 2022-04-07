<?php
session_start();

include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../pages/projekt/modules/rang/projektRang.php";
include "../../../php/sql/connection.php";

$id = trim(xss_clean($_POST["id"]));

$rang = new Rang($_SESSION['Rang'], $pdo);
if(isset($_SESSION['PRang'])){
    //wenn ein Projekt gesetzt ist
    $prang = new projektRang($_SESSION['PRang'], $pdo);
    if(!$rang->hasPermission("projekt.delete") && !$prang->hasPermission("setting.delete")){
        echo "<erro>Dafür hast du nicht die nötigen Permission.";
        exit();
    }
}else {
    //wenn ein kein Projekt gesetzt ist
    if(!$rang->hasPermission("projekt.delete")){
        echo "<erro>Dafür hast du nicht die nötigen Permission.";
        exit();
    }
}
$sth = $pdo->prepare("SELECT * FROM projekt_rang WHERE Projekt = $id");
$sth->execute();
foreach ($sth->fetchAll() as $row) {
    $sth = $pdo->prepare("DELETE FROM projekt_rang_permission_syc WHERE Rang = ?");
    $tid = $row["ID"];
    $sth->bindParam(1, $tid);
    $sth->execute();
}
$sth = $pdo->prepare("DELETE FROM projekt_user WHERE Projekt = ?");
$sth->bindParam(1, $id);
$sth->execute();

$sth = $pdo->prepare("DELETE FROM projekt_rang WHERE Projekt = ?");
$sth->bindParam(1, $id);
$sth->execute();

$sth = $pdo->prepare("DELETE FROM projekt_einladungen WHERE Projekt = ?");
$sth->bindParam(1, $id);
$sth->execute();

$sth = $pdo->prepare("DELETE FROM projekt WHERE ID = ?");
$sth->bindParam(1, $id);
$sth->execute();