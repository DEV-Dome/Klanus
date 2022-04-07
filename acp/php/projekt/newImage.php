<?php
session_start();

header("Expires: Mon, 10 Jan 1970 01:01:01 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

if(!function_exists("startsWith")){
    function startsWith ($string, $startString){
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }
}
include "../../../php/sql/connection.php";
include "../../../pages/projekt/modules/rang/projektRang.php";
include "../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);

if(isset($_SESSION['PRang'])){
    //wenn ein Projekt gesetzt ist
    $prang = new projektRang($_SESSION['PRang'], $pdo);
    if(!$prang->hasPermission("setting.bild") && !$rang->hasPermission("projekt.edit.bild")){
        echo "<erro>Dafür hast du nicht die nötigen Permission.";
        exit();
    }
}else {
    if(!$rang->hasPermission("projekt.edit.bild")){
        echo "<erro>Dafür hast du nicht die nötigen Permission.";
        exit();
    }
}

if(isset($_FILES['img'])) {
    $img = $_FILES['img'];
    $id = $_POST["id"];
    $size = $img["size"] / 1024 / 1024; // in kb !

    if(!startsWith($img["type"], "image")){
        exit("<erro>Du musst ein Bild hochladen!</erro>");
    }

    if($size >= 5){
        exit("Das Porfiel Bild draf maximal 25 MB groß sein.");
    }

    if(!is_dir("../../../php/upload/projekt/$id/")){
        if(!is_dir("../../../php/upload/projekt/")){
            mkdir("../../../php/upload/projekt/");
        }
        mkdir("../../../php/upload/projekt/$id/");
    }

    $dtTmpName =  "pb.". pathinfo($img["name"], PATHINFO_EXTENSION);

    //wenn es schon ein PB hat löschen!
    if (file_exists("../../../php/upload/projekt/$id/" .$dtTmpName)) {
        unlink("../../../php/upload/projekt/$id/" .$dtTmpName);
    }

    move_uploaded_file($img['tmp_name'], "../../../php/upload/projekt/$id/" .$dtTmpName);
    echo "Du hast das Projekt Bild geändert.";
}

?>