<?php
session_start();

if(isset($_FILES['img'])) {
    $img = $_FILES['img'];
    $size = $img["size"] / 1024 / 1024; // in kb !


    if(!str_starts_with($img["type"], "image")){
        exit("Du musst ein Bild hochladen!");
    }

    if($size >= 25){
        exit("Das Porfiel Bild draf maximal 25 MB groß sein.");
    }

    //ordner erstellen, wenn nicht vorhanden
    if(!is_dir("../../upload/user/profielimg/")){
        if(!is_dir("../../upload/user/")){
            mkdir("../../upload/user/");
        }
        mkdir("../../upload/user/profielimg/");
    }
    $dtTmpName = $_SESSION["ID"] .".". pathinfo($img["name"], PATHINFO_EXTENSION);


    //wenn er schon ein PB hat löschen!
    if (file_exists("../../upload/user/profielimg/" .$dtTmpName)) {
        unlink("../../upload/user/profielimg/" .$dtTmpName);
    }
    $verzeichnis = "../../upload/user/profielimg/";
    if ( is_dir ( $verzeichnis )){
        if ( $handle = opendir($verzeichnis) ) {
            // einlesen der Verzeichnisses
            while (($file = readdir($handle)) !== false) {
                if($file == "." || $file == "..") continue;
                if(str_starts_with($file, $_SESSION["ID"])){
                    unlink("../../upload/user/profielimg/" . $file);
                }
            }
            closedir($handle);
        }
    }


    move_uploaded_file($img['tmp_name'], "../../upload/user/profielimg/" .$dtTmpName);
    echo "Du hast dein Profiel Bild geändert.";
}

?>