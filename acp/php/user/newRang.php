<?php
session_start();

include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../php/sql/connection.php";

$rangChang = intval(trim(xss_clean($_POST["rang"])));
$id =  intval(trim(xss_clean($_POST["id"])));

$rang = new Rang($_SESSION['Rang'], $pdo);
if(!$rang->hasPermission("user.edit.assign")){
    echo "<erro>Dafür hast du nicht die nötigen Permission.";
    exit();
}

$sth = $pdo->prepare("UPDATE user SET Rang = ? WHERE ID = ?");
$sth->bindParam(1, $rangChang);
$sth->bindParam(2, $id);
$sth->execute();

echo "Rang geändert!";
