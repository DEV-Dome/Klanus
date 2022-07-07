<?php
$admin = false;
$user = false;

foreach ($pdo->query("SELECT * FROM rang WHERE Isdefault = 1") as $row) {
    if ($row["Name"] == "Admin") $admin = true;
    if ($row["Name"] == "user") $user = true;
}

if (!$admin) $pdo->query("INSERT INTO rang (Name, Dscribe, Isdefault, color, BackgroundColor, Prioritat) VALUES ('Admin', 'Dieser Rang hat alle Berechtigungen; es ist mit Vorsicht umzugehen!',true, '#E53333', 'rgba(229, 51, 51, 0.25)',  100)");
if (!$user) $pdo->query("INSERT INTO rang (Name, Isdefault, color, BackgroundColor, Prioritat) VALUES ('user', true, '#C7CDD8', 'rgba(199, 205, 216, 0.25)', 1)");


/*Rang*/
addPermission("rang.overview", "Rang: einsehen", "Rang", $pdo);
addPermission("rang.add", "Rang: Erstellen", "Rang", $pdo);
addPermission("rang.edit", "Rang: Bearbeiten (Übersicht)", "Rang", $pdo);
addPermission("rang.userlist", "Rang: Alle user auflisten", "Rang", $pdo);
addPermission("rang.ranglist", "Rang: Rangliste anzeigen", "Rang", $pdo);
addPermission("rang.setList", "Rang: auf der Rang Seite anzeigen.", "Rang", $pdo);
echo "<p>Rang Rechte eingerichtet.</p>";

/*user*/
addPermission("user.overview", "user: einsehen", "user", $pdo);
addPermission("user.add", "user: Erstellen", "user", $pdo);
addPermission("user.edit", "user: Bearbeiten (Übersicht)", "user",$pdo);
addPermission("user.edit.name", "user: Namen Bearbeiten ", "user",$pdo);
addPermission("user.edit.mail", "user: Email Bearbeiten", "user",$pdo);
addPermission("user.edit.password", "user: Password Bearbeiten", "user",$pdo);
addPermission("user.edit.agb", "user: AGB Bearbeiten", "user",$pdo);
addPermission("user.delete", "user: Löschen", "user",$pdo);
addPermission("user.edit.assign", "user: Rang zuweisen", "user",$pdo);
echo "<p>user Rechte eingerichtet.</p>";

/*projekt*/
addPermission("projekt.overview", "projekt: einsehen", "projekt", $pdo);
addPermission("projekt.edit.status", "projekt: Status Bearbeiten", "projekt", $pdo);
addPermission("projekt.add.premium", "projekt: Erstellen [Premium]", "projekt", $pdo);
addPermission("projekt.add.partner", "projekt: Erstellen [Partner]", "projekt", $pdo);
addPermission("projekt.edit.verifiziert", "projekt: Verifiziert Bearbeiten", "projekt", $pdo);
addPermission("projekt.edit.lock", "projekt: Spree ein projekt ", "projekt", $pdo);
addPermission("projekt.delete", "projekt: Löschen ", "projekt", $pdo);


echo "<p>projekt Rechte eingerichtet.</p>";

/*Einladnunge (Fremder Projeckte)*/
addPermission("all.einladnung.new", "Einladnung: neu Erstellen (Alle Projekte)", "einladnung", $pdo);
addPermission("all.einladnung.delete", "Einladnung: Löschen (Alle Projekte)", "einladnung", $pdo);


echo "<p>projekt Rechte eingerichtet.</p>";

/*user (Fremder Projeckte)*/

addPermission("all.user.kick", "User: Kicken", "User [Projekte]", $pdo);
addPermission("all.user.info", "User: Info Betretten", "User [Projekte]", $pdo);
addPermission("all.user.info.id", "User: Info - ID ", "User [Projekte]", $pdo);
addPermission("all.user.info.discord", "User: Info - Discord", "User [Projekte]", $pdo);
addPermission("all.user.info.rang", "Info - Rang", "User [Projekte]", $pdo);


echo "<p>projekt Rechte eingerichtet [User].</p>";


addPermission("all.rang.name", "Rang: Name ändern", "Rang [Projekte]", $pdo);
addPermission("all.rang.farbe", "Rang: Farbe ändern", "Rang [Projekte]", $pdo);
addPermission("all.rang.beschreibung", "Rang: beschreibung ändern ", "Rang [Projekte]", $pdo);
addPermission("all.rang.permission", "Rang: Permission ändern ", "Rang [Projekte]", $pdo);
addPermission("all.rang.new", "Rang: Neuen Rang ", "Rang [Projekte]", $pdo);
addPermission("all.rang.delete", "Rang: Löschen ", "Rang [Projekte]", $pdo);
addPermission("all.rang.posistion", "Rang: Reinfolge ändern ", "Rang [Projekte]", $pdo);
addPermission("all.rang.menu", "Rang: Menu Punkt anzeigen ", "Rang [Projekte]", $pdo);


echo "<p>projekt Rechte eingerichtet [Rang].</p>";

/*Einstellungen*/
addPermission("all.setting.see.allgemein", "Einstellung: Kann Allgemien einstellungen sehen", "Einstellungen [Projekte]", $pdo);
addPermission("all.setting.see.gefahr", "Einstellung: Kann Gefahrn-bereich einstellungen sehen", "Einstellungen [Projekte]", $pdo);
addPermission("all.setting.see.discord", "Einstellung: Kann Discord einstellungen sehen", "Einstellungen [Projekte]", $pdo);
addPermission("all.setting.see.minecraft", "Einstellung: Kann Minecraft einstellungen sehen", "Einstellungen [Projekte]", $pdo);
addPermission("all.setting.see.forum", "Einstellung: Kann Forum einstellungen sehen", "Einstellungen [Projekte]", $pdo);
addPermission("all.setting.see.menu", "Einstellung: Kann Menü einstellungen sehen", "Einstellungen [Projekte]", $pdo);

addPermission("all.setting.see", "Einstellung: Kann Menü Punkt sehen", "Einstellungen [Projekte]", $pdo);
addPermission("all.setting.name", "Einstellung: Name ändern", "Einstellungen [Projekte]", $pdo);
addPermission("all.setting.kurzel", "Einstellung: Kurzel ändern", "Einstellungen [Projekte]", $pdo);
addPermission("all.setting.beschreibung", "Einstellung: Beschreibung ändern", "Einstellungen [Projekte]", $pdo);
addPermission("all.setting.bild", "Einstellung: Bild ändern", "Einstellungen [Projekte]", $pdo);
addPermission("all.setting.delete", "Einstellung: Projekt Löschen", "Einstellungen [Projekte]", $pdo);

addPermission("all.setting.menu.posistion", "Einstellung: Menu punkt position ändern", "Einstellungen [Projekte]", $pdo);
addPermission("all.setting.menu.disabled", "Einstellung: Menu punkt aktivirn/deaktivirn", "Einstellungen [Projekte]", $pdo);
addPermission("all.setting.menu.name", "Einstellung: Menüpunkt namen ändern", "Einstellungen [Projekte]", $pdo);


echo "<p>projekt Rechte eingerichtet [Einstellungen].</p>";

addPermission("all.forum.setting.kategorie.add", "Forum: Kann Kategorie erstellen", "Forum", $pdo);
addPermission("all.forum.setting.kategorie.delete", "Forum: Kann Kategorie Löschen", "Forum", $pdo);
addPermission("all.forum.setting.kategorie.edit", "Forum: Kann Kategorie Bearbeiten", "Forum", $pdo);
addPermission("all.forum.setting.kategorie.prioritat", "Forum: Kann Kategorie Reinfolge ändern", "Forum", $pdo);
addPermission("all.forum.setting.forum.add", "Forum: Kann Forum erstellen", "Forum", $pdo);
addPermission("all.forum.setting.forum.delete", "Forum: Kann Forum Löschen", "Forum", $pdo);
addPermission("all.forum.setting.forum.edit", "Forum: Kann Forum Bearbeiten", "Forum", $pdo);
addPermission("all.forum.setting.forum.prioritat", "Forum: Kann Forum Reinfolge ändern", "Forum", $pdo);

addPermission("all.forum.beitrag.close", "Forum: Kann Beiträge schlissen/öffnen", "Forum", $pdo);
addPermission("all.forum.beitrag.delete", "Forum: Kann Beiträge löschen", "Forum", $pdo);
addPermission("all.forum.beitrag.edit", "Forum: Kann Beiträge bearbeiten", "Forum", $pdo);

echo "<p>projekt Rechte eingerichtet [Forum].</p>";

/*Global*/
addPermission("acp.use", "Admininterface: Ansehen & Bedienen", "ACP", $pdo);
addPermission("acp.support", "Admininterface: Support sehen", "ACP", $pdo);

echo "<p>Allgemine Rechte eingerichtet.</p>";


foreach ($pdo->query("SELECT * FROM rang_permission") as $row) {
    foreach ($pdo->query("SELECT * FROM rang") as $row1) {
        foreach ($pdo->query("SELECT * FROM rang_permission_syc WHERE Permission like '" . $row["ID"] . "' AND Rang like '" . $row1["ID"] . "'  LIMIT 1 ") as $row3) {
            continue 2;
        }

        if ($row1["ID"] == 1) {
            $pdo->query("INSERT INTO rang_permission_syc (Permission, Rang,  Haspermission) VALUES ('" . $row["ID"] . "', '" . $row1["ID"] . "', true) ");
        } else {
            $pdo->query("INSERT INTO rang_permission_syc (Permission, Rang,  Haspermission) VALUES ('" . $row["ID"] . "', '" . $row1["ID"] . "', false) ");
        }
    }
}


function addPermission($permission, $dscribe, $kategorie, $pdo){
    foreach ($pdo->query("SELECT * FROM rang_permission WHERE Permission like '" . $permission . "' LIMIT 1 ") as $row) {
        if ($row["Permission"] == $permission) {
            return;
        }
    }
    $pdo->query("INSERT INTO rang_permission (Permission, Dscribe, Kategorie) VALUES ('$permission', '$dscribe', '$kategorie') ");
}
