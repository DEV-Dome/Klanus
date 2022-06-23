<?php
session_start();

include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../pages/projekt/modules/rang/projektRang.php";
include "../../../php/sql/connection.php";

$name = strtolower(trim(xss_clean($_POST["name"])));
$id = trim(xss_clean($_POST["id"]));

$rang = new Rang($_SESSION['Rang'], $pdo);

if(isset($_SESSION['PRang'])){
    //wenn ein Projekt gesetzt ist
    $prang = new projektRang($_SESSION['PRang'], $pdo);
    if(!$rang->hasPermission("all.setting.name") && !$prang->hasPermission("setting.name")){
        echo "<erro>Dafür hast du nicht die nötigen Permission.";
        exit();
    }
}else {
    //wenn ein kein Projekt gesetzt ist
    if(!$rang->hasPermission("all.setting.name")){
        echo "<erro>Dafür hast du nicht die nötigen Permission.";
        exit();
    }
}




$sth = $pdo->prepare("SELECT * FROM projekt WHERE Name = ? LIMIT 1");
$sth->bindParam(1, $name);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    echo "<erro>Dieses Projektname ist bereits vorhanden!";
    exit();
}

if(strlen($name) <= 5){
    echo "<erro>Der Projektname muss mindestens 6 Zeichen lang sein.</erro>";
    exit();
}
if(strlen($name) >= 13){
    echo "<erro>Der Projektname draf maximal 12 Zeichen lang sein.</erro>";
    exit();
}

$sth = $pdo->prepare("UPDATE projekt SET Name = ? WHERE ID = ?");
$sth->bindParam(1, $name);
$sth->bindParam(2, $id);
$sth->execute();

echo "Der Neue Projektname ist: $name";