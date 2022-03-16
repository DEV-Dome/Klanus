<?php

//User Module
addModul("Home", "", 0,1, "-", "bi-house-door",$pdo);
addModul("Datenbibliothek", "", 0,1, "-", "bi-bookmark", $pdo);

//projeckz Module
addModul("Projekt-Home", "", 1,1, "-", "bi-house-door", $pdo);
addModul("Einstellungen", "Hier können die Projekt einstellungen geändert werden.", 1,1, "einstellungen", "bi-gear", $pdo);

function addModul($name, $dscribe, $isProjekt, $projekt, $ordner, $icon, $pdo){
    foreach ($pdo->query("SELECT * FROM modul WHERE Name = '" . $name . "' LIMIT 1 ") as $row) {
        if ($row["Name"] == $name) {
            return;
        }
    }
    $pdo->query("INSERT INTO modul (Name, Beschreibung, IsProjekt, ProjektState, Ordner, Icon) VALUE ('$name', '$dscribe', $isProjekt, $projekt, '$ordner', '$icon') ");
}
?>
