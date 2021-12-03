<?php
include "connection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$pdo->query("CREATE TABLE IF NOT EXISTS rang(
ID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Name VARCHAR(100) NOT NULL,
Dscribe TEXT(500),
BackgroundColor VARCHAR(64), 
Color VARCHAR(64), 
Isdefault bool NOT NULL
)");

echo "<p>Rang Tabelle erstellt.</p>";

$pdo->query("CREATE TABLE IF NOT EXISTS user(
ID INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Email VARCHAR(500) NOT NULL,
Name VARCHAR(500) NOT NULL,
Password VARCHAR(512) NOT NULL,
Pepper VARCHAR(512) NOT NULL,
Agb BOOLEAN,
Activ INT(10),
ProfielIMG LONGBLOB DEFAULT NULL,
Rang INT(10),

FOREIGN KEY (Rang) REFERENCES rang(ID)
)");

echo "<p>User Tabelle erstellt.</p>";



$pdo->query("CREATE TABLE IF NOT EXISTS rang_permission(
ID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Permission VARCHAR(100) NOT NULL,
Kategorie VARCHAR(100) NOT NULL,
Dscribe TEXT(500)
)");

echo "<p>Rechte Tabelle erstellt.</p>";

$pdo->query("CREATE TABLE IF NOT EXISTS rang_permission_syc(
ID INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Permission INT(10) NOT NULL,
Rang  INT(10) NOT NULL,
Haspermission BOOL NOT NULL,

FOREIGN KEY (Permission) REFERENCES rang_permission(ID),
FOREIGN KEY (Rang) REFERENCES rang(ID)
)");

include "DefaultPermission.php";

echo "<br/>";
echo "<p>Vorgang abgeschlossen!</p>";
?>


