<?php
session_start();
$salt = 'bQ423hbHM8Sbdb9pjquUQU1IWxcxnybBSjqnyBJ23HjqnI3WbkxUQsxnPw813jkq';

function mySha512($str, $salt,$pepper, $iterations)
{
    for ($x = 0; $x < $iterations; $x++) {
        $str = hash('sha512', $salt. $str . $pepper);
    }
    return $str;
}

include "../sicherheit/XSS.php";
include "../sql/connection.php";

$name = strtolower(trim(xss_clean($_POST["name"])));
$passwort = trim(xss_clean($_POST["passwort"]));


$sth = $pdo->prepare("SELECT * FROM user WHERE Email = ? LIMIT 1");
$sth->bindParam(1, $name);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $safepw = mySha512($passwort, $salt, $row["Pepper"],10000);

    if($row["Password"] == $safepw){
        $_SESSION["Login"] = true;
        $_SESSION["Rang"] = $row["Rang"];
        $_SESSION["ID"] = $row["ID"];
        $_SESSION["Name"] = $row["Name"];

        echo "Du bist eingeloggt.";
        exit();
    }else {
        echo "<erro>Es konnte keine E-mail Adresse oder Username: '$name', gefunden werden.</erro>";
        exit();
    }
}

$sth = $pdo->prepare("SELECT * FROM user WHERE Name = ? LIMIT 1");
$sth->bindParam(1, $name);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $safepw = mySha512($passwort, $salt, $row["Pepper"],10000);

    if($row["Password"] == $safepw){
        $_SESSION["Login"] = true;
        $_SESSION["Rang"] = $row["Rang"];
        $_SESSION["ID"] = $row["ID"];
        $_SESSION["Name"] = $row["Name"];

        echo "Du bist eingeloggt.";
        exit();
    }else {
        echo "<erro>Es konnte keine E-mail Adresse oder Username: '$name', gefunden werden.</erro>";
        exit();
    }
}

echo "<erro>Es konnte keine E-mail Adresse oder Username: '$name', gefunden werden.</erro>";
?>