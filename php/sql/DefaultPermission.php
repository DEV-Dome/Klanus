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
addPermission("rang.add", "Rang: Erstellen", "Rang", $pdo);
addPermission("rang.edit", "Rang: Bearbeiten", "Rang", $pdo);
addPermission("rang.delete", "Rang: Löschen", "Rang", $pdo);
addPermission("rang.userlist", "Rang: Alle user auflisten", "Rang", $pdo);
addPermission("rang.ranglist", "Rang: Rangliste anzeigen", "Rang", $pdo);
addPermission("rang.setList", "Rang: auf der Rang Seite anzeigen.", "Rang", $pdo);
echo "<p>Rang Rechte eingerichtet.</p>";

/*user*/
addPermission("user.add", "user: Erstellen", "user", $pdo);
addPermission("user.edit", "user: Bearbeiten", "user",$pdo);
addPermission("user.delete", "user: Löschen", "user",$pdo);
addPermission("user.assign", "user: Rang zuweisen", "user",$pdo);
echo "<p>user Rechte eingerichtet.</p>";

/*Global*/
addPermission("acp.use", "Admininterface: Ansehen & Bedienen", "ACP", $pdo);
addPermission("acp.support", "Admininterface: Support sehen", "ACP", $pdo);

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
