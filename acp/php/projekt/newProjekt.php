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
$verifiziert = 0; // ein projekt ist am anfang immer nicht Verifiziert

$rang = new Rang($_SESSION['Rang'], $pdo);

if(strlen($name) <= 5){
    echo "<erro>Der Projektname muss mindestens 6 Zeichen lang sein.</erro>";
    exit();
}

if(strlen($name) >= 13){
    echo "<erro>Der Projektname draf maximal 12 Zeichen lang sein.</erro>";
    exit();
}

$sth = $pdo->prepare("SELECT * FROM projekt WHERE Name = ? LIMIT 1");
$sth->bindParam(1, $name);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    echo "<erro>Ein projekt mit diesem Namen gibt es schon</erro>";
    exit();
}

if(strlen($kurzel) != 3){
    echo "<erro>Das Projektkürzel muss genau 3 Zeichen lang sein</erro>";
    exit();
}

$sth = $pdo->prepare("SELECT * FROM projekt WHERE Kurzel = ? LIMIT 1");
$sth->bindParam(1, $kurzel);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    echo "<erro>Ein projekt mit diesem Kürzel gibt es schon</erro>";
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

$sth = $pdo->prepare("SELECT max(ID) AS 'ID' FROM projekt");
$sth->execute();

$nid = 0;
foreach ($sth->fetchAll() as $row) {
    $nid = $row["ID"];
}
$sth = $pdo->prepare("INSERT INTO projekt_rang (Name, Dscribe, BackgroundColor, Color , Prioritat, Projekt, Isdefault ) VALUE('Administrator', 'Dieser Rang hat alle Berechtigungen; es ist mit Vorsicht umzugehen!', 'rgba(229, 51, 51, 0.25)', '#E53333', 1000000, $nid, 1)");
$sth->execute();

$sth = $pdo->prepare("INSERT INTO projekt_rang (Name, Dscribe, BackgroundColor, Color , Prioritat, Projekt, Isdefault ) VALUE('User', 'Dieser Rang ist der Standert Rang. Jeder bekommt ihn.', 'rgba(199, 205, 216, 0.25)', '#C7CDD8', 1, $nid, 1)");
$sth->execute();

echo "projekt erstellt: $name;;;$nid";
?>
