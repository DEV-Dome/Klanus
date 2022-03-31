<?php
/*
 * Legende:
 * $loadPgClasses - Classen für das Profiel Bild
 * $loadPgOnClick - Auszuführende Sachen im onclick auf das Bild
 * */


if(!function_exists("startsWith")){
    function startsWith ($string, $startString){
        $len = strlen($startString);
        return (substr($string, 0, $len) == $startString);
    }
}

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

// wenn das Oberste verzeichnis gewählt ist, nur den unterordner wählen!
if($outputpfad == ""){
    $out = '<img onclick="'.$loadPgOnClick.'" id="pb_settings" width="200px" src="assets/Default_profiel.png" class="'.$loadPgClasses.'" alt="Dein Profiel Bild konnte nicht geladen werden">';
}else {
    $out = '<img onclick="'.$loadPgOnClick.'" id="pb_settings" width="200px" src="'.$outputpfad.'/assets/Default_profiel.png" class="'.$loadPgClasses.'" alt="Dein Profiel Bild konnte nicht geladen werden">';
}


if ( is_dir ( $verzeichnis )){
    if ( $handle = opendir($verzeichnis) ) {
        // einlesen der Verzeichnisses
        while (($file = readdir($handle)) !== false) {
            if($file == "." || $file == "..") continue;
            if(startsWith($file, $bid)){
                $pgPath = $verzeichnisout . $file;
                $out = '<img onclick="'.$loadPgOnClick.'" id="pb_settings" width="200px" src="'.$pgPath.'" class="'.$loadPgClasses.'" alt="Dein Profiel Bild konnte nicht geladen werden">';
            }
        }
        closedir($handle);
    }
}

echo $out;

?>