<?php

addProjektStatus("Userprojekt", "Das ist ein projekt, welches von einem user erstellt wurde.", 0, $pdo);
addProjektStatus("Privatprojekt", "Das ist ein projekt, welches von einem user erstellt wurde. Und dem man nur über eine Einladung beitreten kann.", 0, $pdo);
addProjektStatus("Premium", "Das ist ein projekt, welches von einem Premium user erstellt wurde.", 0, $pdo);
addProjektStatus("Partner", "Das ist ein projekt, welches von einem Partner erstellt wurde.", 0, $pdo);
addProjektStatus("Offiziell", "Das ist ein projekt, welches von von der Plattform erstellt wurde.", 0, $pdo);
addProjektStatus("Gesperrt", "Dieses projekt wurde gesperrt.", 1, $pdo);

function addProjektStatus($name, $dscribe, $isDisalbed, $pdo){
    foreach ($pdo->query("SELECT * FROM projekt_status WHERE Name like '" . $name . "' LIMIT 1 ") as $row) {
            return;
    }
    $pdo->query("INSERT INTO projekt_status (Name, Beschreibung, IsDisabled) VALUES ('$name', '$dscribe', $isDisalbed) ");
}