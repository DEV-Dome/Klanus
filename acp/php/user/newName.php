<?php
session_start();

include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../php/sql/connection.php";

$name = strtolower(trim(xss_clean($_POST["name"])));
$id = trim(xss_clean($_POST["id"]));

$rang = new Rang($_SESSION['Rang'], $pdo);
if(!$rang->hasPermission("user.edit.name")){
    echo "<erro>Dafür hast du nicht die nötigen Permission.";
    exit();
}

$sth = $pdo->prepare("SELECT * FROM user WHERE Name = ? LIMIT 1");
$sth->bindParam(1, $name);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    echo "<erro>Dieser Username ist bereits registriert!";
    exit();
}

$sth = $pdo->prepare("UPDATE user SET Name = ? WHERE ID = ?");
$sth->bindParam(1, $name);
$sth->bindParam(2, $id);
$sth->execute();

echo "Der Neue Username ist: $name";
