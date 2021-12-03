<?php
include "sqlDaten.php";
try{
    $pdo = new PDO("mysql:host=$host;dbname=$datenbank", $username, $password);
} catch(\mysql_xdevapi\Exception $e){echo $e;}