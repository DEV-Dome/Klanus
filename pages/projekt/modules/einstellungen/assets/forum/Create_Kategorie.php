<?php
session_start();

include "../../../../../../php/sicherheit/XSS.php";
include "../../../../../../php/sql/connection.php";
include "../../../../../../php/rang/Rang.php";
include "../../../rang/projektRang.php";

$prang = new projektRang($_SESSION['PRang'], $pdo);
$rang = new Rang($_SESSION['Rang'], $pdo);

if(!$prang->hasPermission("forum.setting.kategorie.add") && !$rang->hasPermission("all.forum.setting.kategorie.add")) {
    exit("<erro>Keine Permission</erro>");
}

$name = trim(xss_clean($_POST["name"]));
$rang = trim(xss_clean($_POST["rang"]));


if(strlen($name) <= 2 || strlen($name) >= 99){
    echo "<erro>Der Name muss Zwischen 3 und 100 Zeichen haben</erro>";
    exit();
}

if($rang == "" || $rang == -1){
    echo "<erro>Du musst einen mindest Rang angeben</erro>";
    exit();
}

if(!isset($_POST["id"])){
    $sth = $pdo->prepare("INSERT INTO projekt_forum_kategorien (Projekt, Name, prioritat, Rang ) VALUE (?, ?, 0, ?)");
    $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
    $sth->bindParam(2, $name);
    $sth->bindParam(3, $rang);
    $sth->execute();

    $kid = -1;
    foreach ($pdo->query("SELECT * FROM projekt_forum_kategorien ORDER BY ID DESC LIMIT 1") as $row) {
        $kid = $row["ID"];
    }

    $sth = $pdo->prepare("UPDATE projekt_forum_kategorien SET Prioritat = ? WHERE ID = ?");
    $sth->bindParam(1, $kid);
    $sth->bindParam(2, $kid);
    $sth->execute();

    echo "Kategorien angelegt.";
}else {
    $id = trim(xss_clean($_POST["id"]));

    $sth = $pdo->prepare("UPDATE projekt_forum_kategorien SET Name= ?, Rang = ? WHERE ID = ?");
    $sth->bindParam(1, $name);
    $sth->bindParam(2, $rang);
    $sth->bindParam(3, $id);
    $sth->execute();

    echo "Kategorien angelegt.";
}

