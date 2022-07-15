<?php
session_start();

include "../../../../../php/sicherheit/XSS.php";
include "../../../../../php/sql/connection.php";
include "../../../../../php/rang/Rang.php";
include "../../rang/projektRang.php";

$bid = trim(xss_clean($_POST["bid"]));

$dt = new DateTime();
$jetzt = $dt->format("Y.m.d H:i:s");

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

$sqlstr = "SELECT * FROM projekt_forum_beitrage WHERE ID  = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $bid);
$sth->execute();

if(!($prang->hasPermission("forum.beitrag.close") || $rang->hasPermission("all.forum.beitrag.close"))) {
    exit();
}

foreach($sth->fetchAll() as $row) {
    if($row["Status"] == 1){
        //schlissen
        $sqlstr = "UPDATE projekt_forum_beitrage SET Status = 2  WHERE ID  = ?";
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(1, $bid);
        $sth->execute();

        //nachricht in Post schreiben
        $sqlstr  = "INSERT INTO projekt_forum_beitrage_kommentare (Name, Text, Status, Beitrag, Owner, ErstelltAm, Zugriffe) VALUES ";
        $sqlstr .= "('', 'Der Beitrag wurde geschlossen.', 2, ?, ?, ?, 0)";
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(1, $bid);
        $sth->bindParam(2, $_SESSION["ID"]);
        $sth->bindParam(3, $jetzt);
        $sth->execute();
    }else if($row["Status"] == 2){
        //öffen
        $sqlstr = "UPDATE projekt_forum_beitrage SET Status = 1  WHERE ID  = ?";
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(1, $bid);
        $sth->execute();

        //nachricht in Post schreiben
        $sqlstr  = "INSERT INTO projekt_forum_beitrage_kommentare (Name, Text, Status, Beitrag, Owner, ErstelltAm, Zugriffe) VALUES ";
        $sqlstr .= "('', 'Der Beitrag wurde geöffnet.', 3, ?, ?, ?, 0)";
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(1, $bid);
        $sth->bindParam(2, $_SESSION["ID"]);
        $sth->bindParam(3, $jetzt);
        $sth->execute();
    }
}