<?php
session_start();

include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../php/sql/connection.php";

$status = strtolower(trim(xss_clean($_POST["name"])));
$id = trim(xss_clean($_POST["id"]));

$rang = new Rang($_SESSION['Rang'], $pdo);
if(!$rang->hasPermission("projekt.edit.status")){
    echo "<erro>Dafür hast du nicht die nötigen Permission.";
    exit();
}


$sth = $pdo->prepare("UPDATE projekt SET Status  = ? WHERE ID = ?");
$sth->bindParam(1, $status);
$sth->bindParam(2, $id);
$sth->execute();

echo "Der Projektstatus wurde geändert.";