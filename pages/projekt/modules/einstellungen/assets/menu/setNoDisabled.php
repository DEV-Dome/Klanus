<?php
session_start();
include "../../../../../../php/sicherheit/XSS.php";
include "../../../../../../php/sql/connection.php";
include "../../../../../../php/rang/Rang.php";
include "../../../rang/projektRang.php";

$prang = new projektRang($_SESSION['PRang'], $pdo);
$rang = new Rang($_SESSION['Rang'], $pdo);

if(!$prang->hasPermission("setting.menu.disabled") && !$rang->hasPermission("all.setting.menu.disabled")) {
    exit();
}

$mid = intval(xss_clean($_POST["mid"]));
$pid = intval(xss_clean($_POST["pid"]));

$sth = $pdo->prepare("UPDATE projekt_setting_menubar SET IsDisabled = 0 WHERE ID = ? AND Projekt = ?");
$sth->bindParam(1, $mid);
$sth->bindParam(2, $pid);
$sth->execute();