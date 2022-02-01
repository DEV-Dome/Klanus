<?php
session_start();

include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../php/sql/connection.php";

$mail = strtolower(trim(xss_clean($_POST["email"])));
$id = trim(xss_clean($_POST["id"]));

$rang = new Rang($_SESSION['Rang'], $pdo);
if(!$rang->hasPermission("user.edit.mail")){
    echo "<erro>Dafür hast du nicht die nötigen Permission.";
    exit();
}

$sth = $pdo->prepare("SELECT * FROM user WHERE Email = ? LIMIT 1");
$sth->bindParam(1, $mail);
$sth->execute();

if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    echo "<erro>Du hast keine gültige E-Mail angegeben!";
    exit();
}

foreach ($sth->fetchAll() as $row) {
    echo "<erro>Diese Email Adresse ist bereits registriert!";
    exit();
}

$sth = $pdo->prepare("UPDATE user SET Email = ? WHERE ID = ?");
$sth->bindParam(1, $mail);
$sth->bindParam(2, $id);
$sth->execute();

echo "Die Neue Email Adresse ist: $mail";
