<?php
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

include "../sicherheit/XSS.php";
include "../sql/connection.php";

$name = strtolower(trim(xss_clean($_GET["name"])));
$passwort = trim(xss_clean($_GET["passwort"]));
$passwortw = trim(xss_clean($_GET["passwortw"]));
$mail = strtolower(trim(xss_clean($_GET["email"])));
$pepper = zufallsstring(12);

$Boolfalse = false;
$null = null;
$rang = 2;

foreach ($pdo->query("SELECT * FROM user WHERE Email = '" . $mail . "' LIMIT 1") as $row) {
    echo "Diese E-Mail ist bereits registriert!";
    exit();
}

foreach ($pdo->query("SELECT * FROM user WHERE Name = '" . $name . "' LIMIT 1") as $row) {
    echo "Dieser Username ist bereits registriert!";
    exit();
}

if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    echo "Du hast keine gültige E-Mail angegeben!";
    exit();
}

if ($passwort !== $passwortw) {
    echo "Die Passwörter stimmen nicht überein!";
    exit();
}

if (strlen($passwort) <= 7 || strlen($passwort) >= 512) {
    echo "Dein Passwort muss mindestens 8 Zeichen haben!";
    exit();
}

if (strlen($name) <= 2 || strlen($name) >= 128) {
    echo "Dein Username muss mindestens 3 Zeichen haben!";
    exit();
}


$safepw = mySha512($passwort, $salt, $pepper, 10000);
$sth = $pdo->prepare("INSERT INTO user (Email, Password, AGB, Activ, ProfielIMG, Rang, Name, Pepper) VALUE (?, ?, ?, ?, ?, ?, ?, ?)");

$sth->bindParam(1, $mail);
$sth->bindParam(2, $safepw);
$sth->bindParam(3, $Boolfalse);
$sth->bindParam(4, $Boolfalse);
$sth->bindParam(5, $null);
$sth->bindParam(6, $rang);
$sth->bindParam(7, $name);
$sth->bindParam(8, $pepper);
$sth->execute();

echo "Du bist jetzt registirt!";
?>
