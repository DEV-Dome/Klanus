<?php

//User Module
addModul("Home", "", 0,1, "-", "bi-house-door","", 1,$pdo );
addModul("Datenbibliothek", "", 0,1, "-", "bi-bookmark","", 0, $pdo);

//projeckz Module
addModul("Projekt-Home", "", 1,1, "-", "bi-house-door","", 1, $pdo);
addModul("Forum", "Hier findet ihr ein Forum", 1,1, "forum", "bi bi-bookmark","",0, $pdo);
addModul("User", "Hier können die Projekt User Verwaltet werden.", 1,1, "user", "bi-people-fill","",1, $pdo);
addModul("Einladungen", "Hier können die Projekt einladungen Verwaltet werden.", 1,1, "einladungen", "bi-receipt","",1, $pdo);
addModul("Ankündigungen", "Hier kannst du ankündigungen zu deinen Projekt Posten!.", 1,1, "ankundigungen", "bi-broadcast-pin","",0, $pdo);
addModul("Rang", "Hier können die Projekt Ränge geändert werden.", 1,1, "rang", "bi-person-lines-fill","rang.menu",1, $pdo);
addModul("Einstellungen", "Hier können die Projekt einstellungen geändert werden.", 1,1, "einstellungen", "bi-gear", "",1, $pdo);


function addModul($name, $dscribe, $isProjekt, $projekt, $ordner, $icon, $permission,$standert, $pdo){
    foreach ($pdo->query("SELECT * FROM modul WHERE Name = '" . $name . "' LIMIT 1 ") as $row) {
        if ($row["Name"] == $name) {
            return;
        }
    }
    $pdo->query("INSERT INTO modul (Name, Beschreibung, IsProjekt, ProjektState, Ordner, Icon, permission, Standart) VALUE ('$name', '$dscribe', $isProjekt, $projekt, '$ordner', '$icon', '$permission', $standert) ");
}
?>
