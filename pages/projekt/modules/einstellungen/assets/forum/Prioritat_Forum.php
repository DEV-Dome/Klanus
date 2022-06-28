<?php
session_start();

include "../../../../../../php/sicherheit/XSS.php";
include "../../../../../../php/sql/connection.php";
include "../../../../../../php/rang/Rang.php";
include "../../../rang/projektRang.php";

$fromid = xss_clean($_POST["formID"]);
$formKat = xss_clean($_POST["formKat"]);

$toid = xss_clean($_POST["toID"]);
$toKat = xss_clean($_POST["toKat"]);

$prang = new projektRang($_SESSION['PRang'], $pdo);
$rang = new Rang($_SESSION['Rang'], $pdo);


if($prang->hasPermission("forum.setting.forum.prioritat") || $rang->hasPermission("all.forum.setting.forum.prioritat")) {
    if (!is_numeric($fromid) && !is_numeric($toid)) {
        exit();
    }


    $sth = $pdo->prepare("SELECT prioritat FROM projekt_forum_forn WHERE ID = ?");
    $sth->bindParam(1, $fromid);
    $sth->execute();

    foreach ($sth->fetchAll() as $row) {
        $fromPrioritat = $row["prioritat"];
    }

    $sth = $pdo->prepare("SELECT prioritat FROM projekt_forum_forn WHERE ID = ?");
    $sth->bindParam(1, $toid);
    $sth->execute();

    foreach ($sth->fetchAll() as $row) {
        $toPrioritat = $row["prioritat"];
    }

    if($toKat == $formKat){
        $sth = $pdo->prepare("UPDATE projekt_forum_forn SET prioritat = ? WHERE ID = ?");
        $sth->bindParam(1, $toPrioritat);
        $sth->bindParam(2, $fromid);
        $sth->execute();

        $sth = $pdo->prepare("UPDATE projekt_forum_forn SET prioritat = ? WHERE ID = ?");
        $sth->bindParam(1, $fromPrioritat);
        $sth->bindParam(2, $toid);
        $sth->execute();
    }else {
        $sth = $pdo->prepare("UPDATE projekt_forum_forn SET prioritat = ?,kategorien= ? WHERE ID = ?");
        $sth->bindParam(1, $toPrioritat);
        $sth->bindParam(2, $toKat);
        $sth->bindParam(3, $fromid);
        $sth->execute();

        $sth = $pdo->prepare("UPDATE projekt_forum_forn SET prioritat = ?,kategorien= ? WHERE ID = ?");
        $sth->bindParam(1, $fromPrioritat);
        $sth->bindParam(2, $formKat);
        $sth->bindParam(3, $toid);
        $sth->execute();
    }
}else {
    exit();
}
