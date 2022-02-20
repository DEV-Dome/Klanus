<?php

addProjektStatus("Userprojekt", "Das ist ein Projekt, welches von einem User erstellt wurde.", 0, $pdo);
addProjektStatus("Privatprojekt", "Das ist ein Projekt, welches von einem User erstellt wurde. Und dem man nur über eine Einladung beitreten kann.", 0, $pdo);
addProjektStatus("Premium", "Das ist ein Projekt, welches von einem Premium User erstellt wurde.", 0, $pdo);
addProjektStatus("Partner", "Das ist ein Projekt, welches von einem Partner erstellt wurde.", 0, $pdo);
addProjektStatus("Offiziell", "Das ist ein Projekt, welches von von der Plattform erstellt wurde.", 0, $pdo);
addProjektStatus("Gesperrt", "Dieses Projekt wurde gesperrt.", 1, $pdo);

function addProjektStatus($name, $dscribe, $isDisalbed, $pdo){
    foreach ($pdo->query("SELECT * FROM projekt_status WHERE Name like '" . $name . "' LIMIT 1 ") as $row) {
            return;
    }
    $pdo->query("INSERT INTO projekt_status (Name, Beschreibung, IsDisabled) VALUES ('$name', '$dscribe', $isDisalbed) ");
}