<?php
include "../../../../../php/sicherheit/XSS.php";
include "../../../../../php/sql/connection.php";
include "../../../../../php/rang/Rang.php";

$uid = intval(xss_clean($_POST["uid"]));
$pid = intval(xss_clean($_POST["pid"]));

$sth = $pdo->prepare("SELECT * FROM projekt_user WHERE User = ? AND Projekt  = ?");
$sth->bindParam(1, $uid);
$sth->bindParam(2, $pid);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    if($row["IsOwner"] == 1){
        exit();
    }
}

$sth = $pdo->prepare("DELETE FROM projekt_user WHERE User = ? AND Projekt  = ?");
$sth->bindParam(1, $uid);
$sth->bindParam(2, $pid);
$sth->execute();