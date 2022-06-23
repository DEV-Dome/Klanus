<?php
//include "../../../../../php/sql/connection.php";

/*Einstellungen*/
addPermissionFrontEnd("setting.see.allgemein", "Einstellung: Kann Allgemien einstellungen sehen", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.see.gefahr", "Einstellung: Kann Gefahrn-bereich einstellungen sehen", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.see.discord", "Einstellung: Kann Discord einstellungen sehen", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.see.minecraft", "Einstellung: Kann Minecraft einstellungen sehen", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.see.forum", "Einstellung: Kann Forum einstellungen sehen", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.see.menu", "Einstellung: Kann Menu einstellungen sehen", "Einstellungen", $pdo);

addPermissionFrontEnd("setting.see", "Einstellung: Kann Menü Punkt sehen", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.name", "Einstellung: Name ändern", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.kurzel", "Einstellung: Kurzel ändern", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.beschreibung", "Einstellung: Beschreibung ändern", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.bild", "Einstellung: Bild ändern", "Einstellungen", $pdo);
addPermissionFrontEnd("setting.delete", "Einstellung: Projekt Löschen", "Einstellungen", $pdo);

/*Einladnungen*/
addPermissionFrontEnd("einladnung.see", "Einladnung: Kann Menü Punkt sehen", "Einladnung", $pdo);
addPermissionFrontEnd("einladnung.new", "Einladnung: neu Erstellen", "Einladnung", $pdo);
addPermissionFrontEnd("einladnung.delete", "Einladnung: Löschen", "Einladnung", $pdo);

/*User*/
addPermissionFrontEnd("user.see", "User: Kann Menü Punkt sehen", "User", $pdo);
addPermissionFrontEnd("user.kick", "User: Kicken", "User", $pdo);
addPermissionFrontEnd("user.info", "User: Info Betretten", "User", $pdo);
addPermissionFrontEnd("user.info.id", "User: Info - ID ", "User", $pdo);
addPermissionFrontEnd("user.info.discord", "User: Info - Discord", "User", $pdo);
addPermissionFrontEnd("user.info.rang", "Info - Rang", "User", $pdo);

/*Rang*/
addPermissionFrontEnd("rang.see", "Rang: Kann Menü Punkt sehen", "Rang", $pdo);
addPermissionFrontEnd("rang.name", "Rang: Name ändern", "Rang", $pdo);
addPermissionFrontEnd("rang.farbe", "Rang: Farbe ändern", "Rang", $pdo);
addPermissionFrontEnd("rang.beschreibung", "Rang: Beschreibung ändern", "Rang", $pdo);
addPermissionFrontEnd("rang.permission", "Rang: Rechte ändern", "Rang", $pdo);
addPermissionFrontEnd("rang.new", "Rang: Rechte Erstellen", "Rang", $pdo);
addPermissionFrontEnd("rang.delete", "Rang: Rechte Löschen", "Rang", $pdo);
addPermissionFrontEnd("rang.posistion", "Rang: Reinfolge ändern", "Rang", $pdo);
addPermissionFrontEnd("rang.menu", "Rang: Menu Punkt anzeigen", "Rang", $pdo);

/*Ankündigungen*/
addPermissionFrontEnd("ankundgungen.see", "Ankündigungen: Kann Menü Punkt sehen", "Ankündigungen", $pdo);
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
