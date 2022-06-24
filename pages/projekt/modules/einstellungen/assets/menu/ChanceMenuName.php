<?php
session_start();

include "../../../../../../php/sicherheit/XSS.php";
include "../../../../../../php/sql/connection.php";
include "../../../../../../php/rang/Rang.php";
include "../../../rang/projektRang.php";

$id = xss_clean($_POST["id"]);
$name = trim(xss_clean($_POST["name"]));

$prang = new projektRang($_SESSION['PRang'], $pdo);
$rang = new Rang($_SESSION['Rang'], $pdo);

if(!$prang->hasPermission("setting.menu.name") && !$rang->hasPermission("all.setting.menu.name")) {
    exit("<erro>Keine Permission</erro>");
}

if(strlen($name) <= 2){
    echo "<erro>Der Name muss mindestens 3 Zeichen haben</erro>";
    exit();
}

$sth = $pdo->prepare("UPDATE projekt_setting_menubar SET DisplayName = ? WHERE ID = ? AND Projekt  = ?");
$sth->bindParam(1, $name);
$sth->bindParam(2, $id);
$sth->bindParam(3, $_SESSION["projekt.aktiv"]);
$sth->execute();

echo "Speichern";