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
//addPermission("projekt.add", "projekt: Erstellen", "projekt", $pdo);
addPermission("projekt.edit", "projekt: Bearbeiten (Übersicht)", "projekt", $pdo);
addPermission("projekt.edit.name", "projekt: Namen Bearbeiten", "projekt", $pdo);
addPermission("projekt.edit.kurzel", "projekt: Kurzel Bearbeiten", "projekt", $pdo);
addPermission("projekt.edit.beschreibung", "projekt: Beschreibung Bearbeiten", "projekt", $pdo);
addPermission("projekt.edit.bild", "projekt: Bild Bearbeiten", "projekt", $pdo);
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
