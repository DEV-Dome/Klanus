<?php
session_start();

include "../../../../../php/sicherheit/XSS.php";
include "../../../../../php/sql/connection.php";
include "../../../../../php/rang/Rang.php";
include "../../rang/projektRang.php";

$bid = trim(xss_clean($_POST["bid"]));
$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

if(!($prang->hasPermission("forum.beitrag.delete") || $rang->hasPermission("all.forum.beitrag.delete"))) {
    exit();
}

$sqlstr = "UPDATE projekt_forum_beitrage SET Status = 3 WHERE ID = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $bid);
$sth->execute();
