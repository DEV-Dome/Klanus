<?php
session_start();

include "../../../../../php/sicherheit/XSS.php";
include "../../../../../php/sql/connection.php";
include "../../../../../php/rang/Rang.php";
include "../../rang/projektRang.php";

$prang = new projektRang($_SESSION['PRang'], $pdo);
$rang = new Rang($_SESSION['Rang'], $pdo);

if(!$prang->hasPermission("einladnung.delete") && !$rang->hasPermission("all.einladnung.delete")) {
    exit();
}

$id = intval(xss_clean($_POST["id"]), 10);

$sth = $pdo->prepare("DELETE FROM projekt_einladungen WHERE  ID = ?");
$sth->bindParam(1, $id);
$sth->execute();
