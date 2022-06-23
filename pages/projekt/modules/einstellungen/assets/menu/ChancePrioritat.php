<?php
session_start();

include "../../../../../../php/sicherheit/XSS.php";
include "../../../../../../php/sql/connection.php";
include "../../../../../../php/rang/Rang.php";
include "../../../rang/projektRang.php";

$fromid = xss_clean($_POST["fromid"]);
$toid = xss_clean($_POST["toid"]);

$prang = new projektRang($_SESSION['PRang'], $pdo);
$rang = new Rang($_SESSION['Rang'], $pdo);


if($prang->hasPermission("setting.menu.posistion") || $rang->hasPermission("all.setting.menu.posistion")) {
    if (!is_numeric($fromid) && !is_numeric($toid)) {
        exit();
    }

    $fromPrioritat = -1;
    $toPrioritat = -1;

    $sth = $pdo->prepare("SELECT ID FROM projekt_setting_menubar WHERE Prioritat = ?");
    $sth->bindParam(1, $fromid);
    $sth->execute();

    foreach ($sth->fetchAll() as $row) {
        $fromPrioritat = $row["ID"];
    }

    $sth = $pdo->prepare("SELECT ID FROM projekt_setting_menubar WHERE Prioritat = ?");
    $sth->bindParam(1, $toid);
    $sth->execute();

    foreach ($sth->fetchAll() as $row) {
        $toPrioritat = $row["ID"];
    }


    $sth = $pdo->prepare("UPDATE projekt_setting_menubar SET Prioritat = ? WHERE ID = ? AND Projekt  = ?");
    $sth->bindParam(1, $fromid);
    $sth->bindParam(2, $toPrioritat);
    $sth->bindParam(3, $_SESSION["projekt.aktiv"]);
    $sth->execute();

    $sth = $pdo->prepare("UPDATE projekt_setting_menubar SET Prioritat = ? WHERE ID = ? AND Projekt  = ?");
    $sth->bindParam(1, $toid);
    $sth->bindParam(2, $fromPrioritat);
    $sth->bindParam(3, $_SESSION["projekt.aktiv"]);
    $sth->execute();


}else {
    exit();
}


?>