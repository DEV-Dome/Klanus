<?php
session_start();

include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../php/sql/connection.php";

$id = trim(xss_clean($_POST["id"]));

$rang = new Rang($_SESSION['Rang'], $pdo);
if(!$rang->hasPermission("projekt.edit.lock")){
    echo "<erro>Dafür hast du nicht die nötigen Permission.";
    exit();
}

$sth = $pdo->prepare("SELECT * FROM projekt WHERE id = ? LIMIT 1");
$sth->bindParam(1, $id);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    if($row["Status"] == 6){
        //freigeben
        $sth = $pdo->prepare("UPDATE projekt SET Status = 2 WHERE ID = ?");
        $sth->bindParam(1, $id);
        $sth->execute();
    }else {
        //lock
        $sth = $pdo->prepare("UPDATE projekt SET Status = 6 WHERE ID = ?");
        $sth->bindParam(1, $id);
        $sth->execute();
    }
}
