<?php
session_start();
/*
 *  border-color: red;
    border-style: solid;
    border-width: 1.5px;
 *
 */


include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../php/sql/connection.php";

$name = strtolower(trim(xss_clean($_POST["name"])));
$kurzel = strtolower(trim(xss_clean($_POST["kurzel"])));
$beschreibung = trim(xss_clean($_POST["beschreibung"]));
$type = intval(trim(xss_clean($_POST["type"])));
$verifiziert = 0; // ein Projekt ist am anfang immer nicht Verifiziert

$rang = new Rang($_SESSION['Rang'], $pdo);

if(strlen($name) <= 5){
    echo "<erro>Der Projektname muss mindestens 6 Zeichen lang sein.</erro>";
    exit();
}

if(strlen($kurzel) != 3){
    echo "<erro>Das Projektkürzel muss genau 3 Zeichen lang sein</erro>";
    exit();
}
if($type == 3 || $type == 4){
    if($type == 3){
        if(!$rang->hasPermission("projekt.add.premium")){
            echo "<erro>Du darfst diesen Projokttypen nicht erstelle.</erro>";
            exit();
        }
    }
    if($type == 4){
        if(!$rang->hasPermission("projekt.add.partner")){
            echo "<erro>Du darfst diesen Projokttypen nicht erstelle.</erro>";
            exit();
        }
    }
}


$sth = $pdo->prepare("INSERT INTO projekt (Name, Kurzel, Beschreibung, Status , Verifiziert,Besitzer ) VALUE (?, ?, ?, ?, ?, ?)");
$sth->bindParam(1, $name);
$sth->bindParam(2, $kurzel);
$sth->bindParam(3, $beschreibung);
$sth->bindParam(4, $type);
$sth->bindParam(5, $verifiziert);
$sth->bindParam(6, $_SESSION["ID"]);
$sth->execute();

//TODO: Automische weiterleitung zum Projeckt
echo "Projekt erstellt: $name";
?>
