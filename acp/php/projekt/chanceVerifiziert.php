<?php
session_start();

include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../php/sql/connection.php";

$pid = intval(trim(xss_clean($_POST["pid"])));

$rang = new Rang($_SESSION['Rang'], $pdo);
if(!$rang->hasPermission("projekt.edit.verifiziert")){
    echo "<erro>Dafür hast du nicht die nötigen Permission.";
    exit();
}
$verify = 0;

$sth = $pdo->prepare("SELECT * FROM projekt WHERE ID = ? LIMIT 1");
$sth->bindParam(1, $pid);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $verify = $row["Verifiziert"];
}
if($verify == 0){
    $verify = 1;
}else {
    $verify = 0;
}
echo $verify;

$sth = $pdo->prepare("UPDATE projekt SET Verifiziert = ? WHERE ID = ?");
$sth->bindParam(1, $verify);
$sth->bindParam(2, $pid);
$sth->execute();
