<?php
if(!isset($_SESSION)) session_start();
if(!isset($pdo)) include_once "../../../php/sql/connection.php";

$loader_projeckt_id = $_SESSION["projekt.aktiv"];

$verzeichnis = "update/";
if ( is_dir ( $verzeichnis )) {
    if ($handle = opendir($verzeichnis)) {
        // einlesen der Verzeichnisses
        while (($file = readdir($handle)) !== false) {
            if($file == "." || $file == "..") continue;
            if($file == "loader.php" || $file == "readme.txt") continue;


            include "update/$file";
        }
    }
}
?>
