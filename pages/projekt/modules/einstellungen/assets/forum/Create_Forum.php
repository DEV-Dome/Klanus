<?php
session_start();

include "../../../../../../php/sicherheit/XSS.php";
include "../../../../../../php/sql/connection.php";
include "../../../../../../php/rang/Rang.php";
include "../../../rang/projektRang.php";

$prang = new projektRang($_SESSION['PRang'], $pdo);
$rang = new Rang($_SESSION['Rang'], $pdo);


if(!$prang->hasPermission("forum.setting.forum.add") && !$rang->hasPermission("all.forum.setting.forum.add")) {
    exit("<erro>Keine Permission</erro>");
}

$name                   = trim(xss_clean($_POST["name"]));
$beschreibung           = trim(xss_clean($_POST["beschreibung"]));
$kategorien             = trim(xss_clean($_POST["kategorien"]));
$BeitragKommentar       = trim(xss_clean($_POST["BeitragKommentar"]));
$KannSehen              = intval(trim(xss_clean($_POST["KannSehen"])));
$KannSehenBeitrage      = intval(trim(xss_clean($_POST["KannSehenBeitrage"])));
$KannSehenBeitrageOnly  = intval(trim(xss_clean($_POST["KannSehenBeitrageOnly"])));
$KannschreibenBeitrage  = intval(trim(xss_clean($_POST["KannschreibenBeitrage"])));


if(strlen($name) <= 2 || strlen($name) >= 99){
    echo "<erro>Der Name muss Zwischen 3 und 100 Zeichen haben</erro>";
    exit();
}
if($KannSehen == -1 || $KannSehenBeitrage == -1 || $KannSehenBeitrageOnly == -1 || $KannschreibenBeitrage == -1){
    echo "<erro>Es müssen alle berechtigungen gesetzt werden</erro>";
    exit();
}
if(!is_numeric($KannSehen) || !is_numeric($KannSehenBeitrage) || !is_numeric($KannSehenBeitrageOnly) || !is_numeric($KannschreibenBeitrage)){
    exit();
}

if(!isset($_POST["id"])){
    $sqlstr = "INSERT INTO projekt_forum_forn (Name, Beschreibung, UnterForum, kategorien, prioritat, BeitragKommentar,KannSehen, KannSehenBeitrage, KannSehenBeitrageOnly, KannschreibenBeitrage) ";
    $sqlstr .= "VALUE (?, ?, 0, ?, 0, ?, ?, ?, ?, ?)";
    $sth = $pdo->prepare($sqlstr);
    $sth->bindParam(1, $name);
    $sth->bindParam(2, $beschreibung);
    $sth->bindParam(3, $kategorien);
    $sth->bindParam(4, $BeitragKommentar);
    $sth->bindParam(5, $KannSehen);
    $sth->bindParam(6, $KannSehenBeitrage);
    $sth->bindParam(7, $KannSehenBeitrageOnly);
    $sth->bindParam(8, $KannschreibenBeitrage);
    $sth->execute();

    $kid = -1;
    foreach ($pdo->query("SELECT * FROM projekt_forum_forn ORDER BY ID DESC LIMIT 1") as $row) {
        $kid = $row["ID"];
    }

    $sth = $pdo->prepare("UPDATE projekt_forum_forn SET Prioritat = ? WHERE ID = ?");
    $sth->bindParam(1, $kid);
    $sth->bindParam(2, $kid);
    $sth->execute();

    echo "Kategorien angelegt.";
}else {
    $fid = $_POST["id"];
    $sqlstr  = "UPDATE projekt_forum_forn SET Name = ?, Beschreibung = ?, BeitragKommentar = ?, KannSehen = ?, KannSehenBeitrage = ?, ";
    $sqlstr .= "KannSehenBeitrageOnly  = ?, KannschreibenBeitrage  = ? WHERE ID = ?";
    $sth = $pdo->prepare($sqlstr);
    $sth->bindParam(1, $name);
    $sth->bindParam(2, $beschreibung);
    $sth->bindParam(3, $BeitragKommentar);
    $sth->bindParam(4, $KannSehen);
    $sth->bindParam(5, $KannSehenBeitrage);
    $sth->bindParam(6, $KannSehenBeitrageOnly);
    $sth->bindParam(7, $KannschreibenBeitrage);
    $sth->bindParam(8, $fid);
    $sth->execute();

    echo "Kategorien angelegt.";
}

