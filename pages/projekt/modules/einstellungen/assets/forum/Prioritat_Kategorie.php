<?php
session_start();

include "../../../../../../php/sicherheit/XSS.php";
include "../../../../../../php/sql/connection.php";
include "../../../../../../php/rang/Rang.php";
include "../../../rang/projektRang.php";

$fromid = xss_clean($_POST["formID"]);
$toid = xss_clean($_POST["toID"]);

$prang = new projektRang($_SESSION['PRang'], $pdo);
$rang = new Rang($_SESSION['Rang'], $pdo);


if($prang->hasPermission("forum.setting.kategorie.prioritat") || $rang->hasPermission("all.forum.setting.kategorie.prioritat")) {
    if (!is_numeric($fromid) && !is_numeric($toid)) {
        exit();
    }

    $fromPrioritat = -1;
    $toPrioritat = -1;

    $sth = $pdo->prepare("SELECT prioritat FROM projekt_forum_kategorien WHERE ID = ?");
    $sth->bindParam(1, $fromid);
    $sth->execute();

    foreach ($sth->fetchAll() as $row) {
        $fromPrioritat = $row["prioritat"];
    }

    $sth = $pdo->prepare("SELECT prioritat FROM projekt_forum_kategorien WHERE ID = ?");
    $sth->bindParam(1, $toid);
    $sth->execute();

    foreach ($sth->fetchAll() as $row) {
        $toPrioritat = $row["prioritat"];
    }

    echo "$toPrioritat : $fromid - ";
    echo "$fromPrioritat : $toid";

    $sth = $pdo->prepare("UPDATE projekt_forum_kategorien SET prioritat = ? WHERE ID = ?");
    $sth->bindParam(1, $toPrioritat);
    $sth->bindParam(2, $fromid);
    $sth->execute();

    $sth = $pdo->prepare("UPDATE projekt_forum_kategorien SET prioritat = ? WHERE ID = ?");
    $sth->bindParam(1, $fromPrioritat);
    $sth->bindParam(2, $toid);
    $sth->execute();
}else {
    exit();
}
