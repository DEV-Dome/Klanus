<?php
session_start();

include "../../../../../../php/sicherheit/XSS.php";
include "../../../../../../php/sql/connection.php";
include "../../../../../../php/rang/Rang.php";
include "../../../rang/projektRang.php";

$prang = new projektRang($_SESSION['PRang'], $pdo);
$rang = new Rang($_SESSION['Rang'], $pdo);

if(!$prang->hasPermission("forum.setting.kategorie.delete") && !$rang->hasPermission("all.forum.setting.kategorie.delete")) {
    exit("<erro>Keine Permission</erro>");
}
$id = trim(xss_clean($_POST["id"]));

$sth = $pdo->prepare("DELETE FROM projekt_forum_kategorien WHERE ID = ?");
$sth->bindParam(1, $id);
$sth->execute();
