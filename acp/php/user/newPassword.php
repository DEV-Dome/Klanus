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

function zufallsstring ($stinglaenge) {
    srand ((double)microtime()*1000000);
    $zufall = rand();
    $zufallsstring = substr( md5($zufall) , 0 , $stinglaenge);
    return $zufallsstring;
}

include "../../../php/sicherheit/XSS.php";
include "../../../php/rang/Rang.php";
include "../../../php/sql/connection.php";

$id = trim(xss_clean($_POST["id"]));
$pw = trim(xss_clean($_POST["pw"]));
$pww = trim(xss_clean($_POST["pww"]));
$pepper = zufallsstring(12);
$rang = new Rang($_SESSION['Rang'], $pdo);

$safepw = mySha512($pw, $salt, $pepper, 10000);
if ($pw != "" && $pww != "") {
    if(!$rang->hasPermission("user.edit.password")){
        echo "<erro>Dafür hast du nicht die nötigen Permission.";
        exit();
    }

    if ($pw !== $pww) {
        echo "<erro>Die Passwörter stimmen nicht überein!";
        exit();
    }

    if (strlen($pw) <= 7 || strlen($pw) >= 512) {
        echo "<erro>Dein Passwort muss mindestens 8 Zeichen haben!";
        exit();
    }

    $sth = $pdo->prepare("UPDATE user SET Password=?,Pepper=? WHERE id=?");

    $sth->bindParam(1, $safepw);
    $sth->bindParam(2, $pepper);
    $sth->bindParam(3, $id);
    $sth->execute();

    echo "Das Passwort wurde geändert.";
}

