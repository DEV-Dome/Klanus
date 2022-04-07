<?php
//include "../../../../../php/sql/connection.php";

/*Einstellungen*/
addPermissionFrontEnd("setting.name", "Einstellung: Name ändern", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.kurzel", "Einstellung: Kurzel ändern", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.beschreibung", "Einstellung: Beschreibung ändern", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.bild", "Einstellung: Bild ändern", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.delete", "Einstellung: Projekt Löschen", "Einstellungen", $pdo);

/*Einladnungen*/
addPermissionFrontEnd("einladnung.new", "Einladnung: neu Erstellen", "Einladnung", $pdo);
addPermissionFrontEnd("einladnung.delete", "Einladnung: Löschen", "Einladnung", $pdo);

/*Rang*/
addPermissionFrontEnd("rang.name", "Rang: Name ändern", "Rang", $pdo);
addPermissionFrontEnd("rang.farbe", "Rang: Farbe ändern", "Rang", $pdo);
addPermissionFrontEnd("rang.beschreibung", "Rang: Beschreibung ändern", "Rang", $pdo);
addPermissionFrontEnd("rang.permission", "Rang: Rechte ändern", "Rang", $pdo);

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


function addPermissionFrontEnd($permission, $dscribe, $kategorie, $pdo){
    foreach ($pdo->query("SELECT * FROM projekt_rang_permission WHERE Permission like '" . $permission . "' LIMIT 1 ") as $row) {
        if ($row["Permission"] == $permission) {
            return;
        }
    }
    $pdo->query("INSERT INTO projekt_rang_permission (Permission, Dscribe, Kategorie) VALUES ('$permission', '$dscribe', '$kategorie') ");
}
