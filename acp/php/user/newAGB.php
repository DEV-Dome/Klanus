<?php
session_start();

include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../php/sql/connection.php";
$AGB  = 0;

if(trim(xss_clean($_POST["agb"])) == "true"){
    $AGB = 1;
}
$id =  intval(trim(xss_clean($_POST["id"])));

$rang = new Rang($_SESSION['Rang'], $pdo);
if(!$rang->hasPermission("user.edit.agb")){
    echo "<erro>Dafür hast du nicht die nötigen Permission.";
    exit();
}

$sth = $pdo->prepare("UPDATE user SET AGB = ? WHERE ID = ?");
$sth->bindParam(1, $AGB);
$sth->bindParam(2, $id);
$sth->execute();

echo "AGB Status geändert!";