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

$name = strtolower(trim(xss_clean($_POST["name"])));
$passwort = trim(xss_clean($_POST["passwort"]));
$passwortw = trim(xss_clean($_POST["passwortw"]));
$mail = strtolower(trim(xss_clean($_POST["email"])));
$pepper = zufallsstring(12);

$Boolfalse = false;
$null = null;
$rang = 2;


$sth = $pdo->prepare("SELECT * FROM user WHERE Email = ? LIMIT 1");
$sth->bindParam(1, $mail);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    echo "<erro>Diese E-Mail ist bereits registriert!</erro>";
    exit();
}

$sth = $pdo->prepare("SELECT * FROM user WHERE Name = ? LIMIT 1");
$sth->bindParam(1, $name);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    echo "<erro>Dieser Username ist bereits registriert!</erro>";
    exit();
}

if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    echo "<erro>Du hast keine gültige E-Mail angegeben!</erro>";
    exit();
}

if ($passwort !== $passwortw) {
    echo "<erro>Die Passwörter stimmen nicht überein!</erro>";
    exit();
}

if (strlen($passwort) <= 7 || strlen($passwort) >= 512) {
    echo "<erro>Dein Passwort muss mindestens 8 Zeichen haben!</erro>";
    exit();
}

if (strlen($name) <= 2 || strlen($name) >= 128) {
    echo "<erro>Dein Username muss mindestens 3 Zeichen haben!</erro>";
    exit();
}

$safepw = mySha512($passwort, $salt, $pepper, 10000);
$sth = $pdo->prepare("INSERT INTO user (Email, Password, Agb, Activ, ProfielIMG, Rang, Name, Pepper) VALUE (?, ?, ?, ?, ?, ?, ?, ?)");

$sth->bindParam(1, $mail);
$sth->bindParam(2, $safepw);
$sth->bindParam(3, 0);
$sth->bindParam(4, 0);
$sth->bindParam(5, 0);
$sth->bindParam(6, $rang);
$sth->bindParam(7, $name);
$sth->bindParam(8, $pepper);
$sth->execute();

echo "Du bist jetzt registirt!";
?>
