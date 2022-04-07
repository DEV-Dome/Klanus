<?php
session_start();

include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../pages/projekt/modules/rang/projektRang.php";
include "../../../php/sql/connection.php";

$beschreibung = (trim(xss_clean($_POST["name"])));
$id = trim(xss_clean($_POST["id"]));

$rang = new Rang($_SESSION['Rang'], $pdo);
if(isset($_SESSION['PRang'])){
    //wenn ein Projekt gesetzt ist
    $prang = new projektRang($_SESSION['PRang'], $pdo);
    if(!$rang->hasPermission("projekt.edit.beschreibung") && !$prang->hasPermission("setting.name")){
        echo "<erro>Dafür hast du nicht die nötigen Permission.";
        exit();
    }
}else {
    //wenn ein kein Projekt gesetzt ist
    if(!$rang->hasPermission("projekt.edit.beschreibung")){
        echo "<erro>Dafür hast du nicht die nötigen Permission.";
        exit();
    }
}

$sth = $pdo->prepare("UPDATE projekt SET Beschreibung = ? WHERE ID = ?");
$sth->bindParam(1, $beschreibung);
$sth->bindParam(2, $id);
$sth->execute();

echo "Die Neue Projektbeschreibung ist: $beschreibung";
