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
Prioritat int,  
    
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

echo "<p>user Tabelle erstellt.</p>";



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

$pdo->query("CREATE TABLE IF NOT EXISTS projekt_status(
ID INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Name VARCHAR(250) NOT NULL,
Beschreibung LONGTEXT NOT NULL,
IsDisabled BOOL NOT NULL
)");

echo "<p>projekt Status erstellt.</p>";

$pdo->query("CREATE TABLE IF NOT EXISTS projekt(
ID INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Name VARCHAR(64) NOT NULL,
Kurzel CHAR(3) NOT NULL,   
Beschreibung LONGTEXT NOT NULL, 
Status int(10) NOT NULL DEFAULT 0,
Verifiziert BOOL NOT NULL DEFAULT 0,
Besitzer INT(10) NOT NULL,
BackgroundColor VARCHAR(64) NOT NULL DEFAULT 'rgba(199, 205, 216, 0.25)', 
Color VARCHAR(64) NOT NULL DEFAULT '#C7CDD8',    
    
FOREIGN KEY (Status) REFERENCES projekt_status(ID),
FOREIGN KEY (Besitzer) REFERENCES user(ID)
)");

echo "<p>projekt Tabelle erstellt.</p>";

$pdo->query("CREATE TABLE IF NOT EXISTS modul(
ID INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Name VARCHAR(64) NOT NULL,
Beschreibung LONGTEXT NOT NULL, 
IsProjekt BOOL NOT NULL DEFAULT 0,
ProjektState INT(10) NOT NULL,
Icon VARCHAR(128) NOT NULL,
Ordner VARCHAR(128) NOT NULL,
permission VARCHAR(128),
    
FOREIGN KEY (ProjektState) REFERENCES projekt_status(ID)
)");

echo "<p>Modul Tabelle erstellt.</p>";

$pdo->query("CREATE TABLE IF NOT EXISTS projekt_rang(
ID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Name VARCHAR(100) NOT NULL,
Dscribe TEXT(500),
BackgroundColor VARCHAR(64), 
Color VARCHAR(64), 
Prioritat int,
Projekt int,  
    
Isdefault bool NOT NULL,
FOREIGN KEY (Projekt) REFERENCES projekt(ID)
)");

$pdo->query("CREATE TABLE IF NOT EXISTS projekt_rang_permission(
ID int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Permission VARCHAR(100) NOT NULL,
Kategorie VARCHAR(100) NOT NULL,
Dscribe TEXT(500)
)");


$pdo->query("CREATE TABLE IF NOT EXISTS projekt_rang_permission_syc(
ID INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Permission INT(10) NOT NULL,
Rang  INT(10) NOT NULL,
Haspermission BOOL NOT NULL,

FOREIGN KEY (Permission) REFERENCES projekt_rang_permission(ID),
FOREIGN KEY (Rang) REFERENCES projekt_rang(ID)
)");

echo "<p>Projekt Rechte Tabelle erstellt.</p>";

$pdo->query("CREATE TABLE IF NOT EXISTS projekt_user(
ID INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
User INT(10) NOT NULL,
Projekt INT(10) NOT NULL,
Rang INT(10) NOT NULL,
IsOwner BOOL DEFAULT 0 NOT NULL,    
IsFavourite BOOL DEFAULT 0 NOT NULL,    
Datum DATETIME NOT NULL,
    

FOREIGN KEY (User) REFERENCES user(ID),
FOREIGN KEY (Projekt) REFERENCES projekt(ID),
FOREIGN KEY (Rang) REFERENCES projekt_rang(ID)
)");

echo "<p>Projekt-User  Tabelle erstellt.</p>";

$pdo->query("CREATE TABLE IF NOT EXISTS projekt_einladungen(
ID INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Projekt INT(10) NOT NULL,
Einladung CHAR(12),
User INT(10) NOT NULL,    

FOREIGN KEY (Projekt) REFERENCES projekt(ID),
FOREIGN KEY (User) REFERENCES user(ID)
)");

echo "<p>Projekt Einladungen Tabelle erstellt.</p>";

$pdo->query("CREATE TABLE IF NOT EXISTS projekt_forum_kategorien ( 
ID INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Projekt INT(10) NOT NULL,
Name VARCHAR(150) NOT NULL,
prioritat int(10) NOT NULL,

FOREIGN KEY (Projekt) REFERENCES projekt(ID)
)");

echo "<p>Projekt projekt_forum_kategorien Tabelle erstellt.</p>";

$pdo->query("CREATE TABLE IF NOT EXISTS projekt_forum_forn(
ID INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Name VARCHAR(150) NOT NULL,
Beschreibung VARCHAR(1000) NOT NULL,
UnterForum INT(10) NOT NULL,
kategorien INT(10) NOT NULL,
prioritat int(10) NOT NULL,
BeitragKommentar VARCHAR(1000),

FOREIGN KEY (kategorien) REFERENCES projekt_forum_kategorien(ID)
)");

echo "<p>Projekt Forum_Forn Tabelle erstellt.</p>";

$pdo->query("CREATE TABLE IF NOT EXISTS projekt_forum_beitrage(
ID INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Name VARCHAR(150) NOT NULL,
Status INT(10) NOT NULL DEFAULT 1,    
Forum INT(10) NOT NULL,
Owner INT(10) NOT NULL,
ErstelltAm DATETIME NOT NULL,    
IsAngepinnt BOOL NOT NULL DEFAULT 0,
Zugriffe INT(10) NOT NULL DEFAULT 0,     
    
    
FOREIGN KEY (Forum) REFERENCES projekt_forum_forn(ID),
FOREIGN KEY (Owner) REFERENCES user(ID)
)");

echo "<p>Projekt Forum_Beiträge Tabelle erstellt.</p>";

$pdo->query("CREATE TABLE IF NOT EXISTS projekt_forum_beitrage_kommentare(
ID INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Name VARCHAR(150) NOT NULL,
Text TEXT NOT NULL,    
Status INT(10) NOT NULL DEFAULT 1,    
Beitrag INT(10) NOT NULL,
Owner INT(10) NOT NULL,
ErstelltAm DATETIME NOT NULL,    

FOREIGN KEY (Beitrag) REFERENCES projekt_forum_beitrage(ID),
FOREIGN KEY (Owner) REFERENCES user(ID)
)");

echo "<p>Projekt Forum_Beiträge Tabelle erstellt.</p>";

include "DefaultPermission.php";
include "DefaultProjektStatus.php";
include "DefaultModul.php";
include "../../pages/projekt/modules/rang/assets/DefaultPermission.php";

echo "<br/>";
echo "<p>Vorgang abgeschlossen!</p>";
?>


