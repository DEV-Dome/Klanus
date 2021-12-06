<?php
/*
 * Legende:
 * $loadPgClasses - Classen für das Profiel Bild
 * $loadPgOnClick - Auszuführende Sachen im onclick auf das Bild
 * */

if(!isset($_SESSION)){
    session_start();
}
//datei nicht chachen
header("Expires: Mon, 10 Jan 1970 01:01:01 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
//
$verzeichnis = "";
if(!isset($overPath)) {
    $overPath = "../../../";
}
if(!isset($loadPgClasses)) {
    $loadPgClasses = "";
}
if(!isset($loadPgOnClick)) {
    $loadPgOnClick = "";
}
if(!isset($bid)) {
    $bid = $_SESSION["ID"];
}
if(!isset($outputpfad)){
    $outputpfad = $overPath;
}

$verzeichnis = $overPath."php/upload/user/profielimg/";
$verzeichnisout = $outputpfad."php/upload/user/profielimg/";
$out = '<img onclick="'.$loadPgOnClick.'" id="pb_settings" width="200px" src="'.$outputpfad.'/assets/Default_profiel.png" class="'.$loadPgClasses.'" alt="Dein Profiel Bild konnte nicht geladen werden">';

if ( is_dir ( $verzeichnis )){
    if ( $handle = opendir($verzeichnis) ) {
        // einlesen der Verzeichnisses
        while (($file = readdir($handle)) !== false) {
            if($file == "." || $file == "..") continue;
            if(str_starts_with($file, $bid)){
                $pgPath = $verzeichnisout . $file;
                $out = '<img onclick="'.$loadPgOnClick.'" id="pb_settings" width="200px" src="'.$pgPath.'" class="'.$loadPgClasses.'" alt="Dein Profiel Bild konnte nicht geladen werden">';
            }
        }
        closedir($handle);
    }
}

echo $out;
?>