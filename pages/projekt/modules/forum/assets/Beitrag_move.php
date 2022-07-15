<?php
session_start();

include "../../../../../php/sicherheit/XSS.php";
include "../../../../../php/sql/connection.php";
include "../../../../../php/rang/Rang.php";
include "../../rang/projektRang.php";

$bid = trim(xss_clean($_POST["bid"]));
$to_fid = trim(xss_clean($_POST["to_fid"]));

$dt = new DateTime();
$jetzt = $dt->format("Y.m.d H:i:s");

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

if(!($prang->hasPermission("forum.beitrag.move") || $rang->hasPermission("all.forum.beitrag.move"))) {
    exit();
}

$sqlstr = "UPDATE projekt_forum_beitrage SET Forum = ? WHERE ID = ?";

$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $to_fid);
$sth->bindParam(2, $bid);
$sth->execute();

$sqlstr  = "INSERT INTO projekt_forum_beitrage_kommentare (Name, Text, Status, Beitrag, Owner, ErstelltAm, Zugriffe) VALUES ";
$sqlstr .= "('', 'Der Beitrag wurde verschoben.', 4, ?, ?, ?, 0)";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $bid);
$sth->bindParam(2, $_SESSION["ID"]);
$sth->bindParam(3, $jetzt);
$sth->execute();

echo "Beitrag gemovt";
?>