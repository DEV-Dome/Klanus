<?php
//include "../../../../../php/sql/connection.php";

/*Rang*/
addPermission("setting.name", "Einstellung: Name ändern", "Rang", $pdo);
addPermission("setting.kurzel", "Einstellung: Kurzel ändern", "Rang", $pdo);
addPermission("setting.beschreibung", "Einstellung: Beschreibung ändern", "Rang", $pdo);
addPermission("setting.bild", "Einstellung: Bild ändern", "Rang", $pdo);

foreach ($pdo->query("SELECT * FROM projekt_rang_permission") as $row) {
    foreach ($pdo->query("SELECT * FROM projekt_rang") as $row1) {
        foreach ($pdo->query("SELECT * FROM projekt_rang_permission_syc WHERE Permission like '" . $row["ID"] . "' AND Rang like '" . $row1["ID"] . "'  LIMIT 1 ") as $row3) {
            continue 2;
        }

        if ($row1["ID"] == 1) {
            $pdo->query("INSERT INTO projekt_rang_permission_syc (Permission, Rang,  Haspermission) VALUES ('" . $row["ID"] . "', '" . $row1["ID"] . "', true) ");
        } else {
            $pdo->query("INSERT INTO projekt_rang_permission_syc (Permission, Rang,  Haspermission) VALUES ('" . $row["ID"] . "', '" . $row1["ID"] . "', false) ");
        }
    }
}


function addPermission($permission, $dscribe, $kategorie, $pdo){
    foreach ($pdo->query("SELECT * FROM projekt_rang_permission WHERE Permission like '" . $permission . "' LIMIT 1 ") as $row) {
        if ($row["Permission"] == $permission) {
            return;
        }
    }
    $pdo->query("INSERT INTO projekt_rang_permission (Permission, Dscribe, Kategorie) VALUES ('$permission', '$dscribe', '$kategorie') ");
}
