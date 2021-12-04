<?php
function hex2rgba( $color, $opacity = false ) {

    $default = 'rgb(0,0,0)';

    // Return default if no color provided
    if( empty( $color ) ) {
        return $default;
    }

    // Sanitize $color if "#" is provided
    if( $color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    // Check if color has 6 or 3 characters and get values
    if( strlen( $color ) == 6 ) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    // Convert hexadec to rgb
    $rgb = array_map( 'hexdec', $hex );

    // Check if opacity is set(rgba or rgb)
    if( $opacity ) {
        if( abs( $opacity ) > 1 ) {
            $opacity = 1.0;
        }
        if( preg_match("/^[0-9,]+$/", $opacity) ) {
            $opacity = str_replace(',', '.', $opacity);
        }
        $output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode( ",", $rgb ) . ', 0.25)';
    }

    // Return rgb(a) color string
    return $output;

}

session_start();

$update = false;
$id_update = 0;

include "../sicherheit/XSS.php";
include "../sql/connection.php";
include "Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);


if(isset($_GET["update"])){
    $update = true;
    $id_update = $_GET["id"];

    if ((!$rang->hasPermission("acp.use") || !$rang->hasPermission("rang.edit"))){
        echo "Du hast nicht nötigen Permission für diese seite.";
        exit();
    }
}else {
    $update = false;

    if ((!$rang->hasPermission("acp.use") || !$rang->hasPermission("rang.add"))){
        echo "Du hast nicht nötigen Permission für diese seite.";
        exit();
    }
}

$beschreibung = trim(xss_clean( $_GET["beschreibung"]));
if($beschreibung != ""){

    $temp = str_split($beschreibung);
    $max = sizeof($temp);

    if($max <= 2){
        echo ("Die Beschreibung, muss min. 3 Zeichen lang seinen!");
        exit();
    }

    if($max >= 250){
        echo("Die Beschreibung, darf max. 250 Zeichen lang seinen!");
        exit();
    }
}else {
    echo("Es muss eine Beschreibung angeben werden.");
    exit();
}

$name = trim(xss_clean($_GET["name"]));
if($name != ""){
    $temp = str_split($name);
    $max = sizeof($temp);

    if($max <= 2){
        echo ("Der Name, muss min. 3 Zeichen lang seinen!");
        exit();
    }

    if($max >= 100){
        echo ("Der Name, darf max. 100 Zeichen lang seinen!");
        exit();
    }

    if(!$update){
        $sth = $pdo->prepare("SELECT * FROM rang WHERE Name like ? LIMIT 1");
        $sth->bindParam(1, $name);
        $sth->execute();

        foreach ($sth->fetchAll() as $row) {
            echo ("Es gibt Bereits einen Rang mit dem Namen!");
            exit();
        }
    }

}else {
    echo ("Es muss ein Name angeben werden.");
    exit();
}

$color = "#" . trim($_GET["color"]);

if($color == "#") {
    echo("Du musst eine Farbe angeben!");
    exit();
}

$bgcolor = hex2rgba($color);

$pem = $_GET["perm"];

if($update){
    $pdo->query("UPDATE rang SET Name='$name',Dscribe='$beschreibung' WHERE ID like $id_update");
    for($i = 0; $i < sizeof($pem); $i++){
        $tmp = explode(":",$pem[$i]);

        $permission = 0;
        if($tmp[1] == "yes"){
            $permission = 1;
        }
        $sth = $pdo->prepare("SELECT * FROM rang_permission WHERE ID = ?");
        $sth->bindParam(1, $tmp[0]);
        $sth->execute();

        foreach ($sth->fetchAll() as $row) {
            $id = $row["ID"];


            $sth = $pdo->prepare("UPDATE rang_permission_syc SET Permission=?,Rang=?,Haspermission=? WHERE Permission = ? AND Rang = ?");
            $sth->bindParam(1, $id);
            $sth->bindParam(2, $id_update);
            $sth->bindParam(3, $permission);
            $sth->bindParam(4, $id);
            $sth->bindParam(5, $id_update);
            $sth->execute();
        }
    }
    echo "Rang Daten geändert";
}else {
    $sth = $pdo->prepare("INSERT INTO rang (Name, Dscribe, Isdefault, Color, BackgroundColor) VALUES (?, ?, false, ?, ?)");
    $sth->bindParam(1, $name);
    $sth->bindParam(2, $beschreibung);
    $sth->bindParam(3, $color);
    $sth->bindParam(4, $bgcolor);
    $sth->execute();

    $rang = "";

    $sth = $pdo->prepare("SELECT * FROM rang WHERE Name like ? LIMIT 1");
    $sth->bindParam(1, $name);
    $sth->execute();

    foreach ($sth->fetchAll() as $row) {
        $rang = $row["ID"];
    }

    $sth = $pdo->prepare("UPDATE rang SET Prioritat=? WHERE ID = ?");
    $sth->bindParam(1, $rang);
    $sth->bindParam(2, $rang);
    $sth->execute();

    for ($i = 0; $i < sizeof($pem); $i++) {
        $tmp = explode(":", $pem[$i]);

        $permission = 0;
        if ($tmp[1] == "yes") $permission = 1;


        foreach ($pdo->query("SELECT * FROM rang_permission WHERE Permission like '$tmp[0]'") as $row) {
            $id = $row["ID"];

            $sth = $pdo->prepare("INSERT INTO rang_permission_syc (Permission , Rang, Haspermission) VALUES (?, ?, ?)");
            $sth->bindParam(1, $id);
            $sth->bindParam(2, $rang);
            $sth->bindParam(3, $permission);
            $sth->execute();
        }
    }


    echo "Rang Angelegt";


}