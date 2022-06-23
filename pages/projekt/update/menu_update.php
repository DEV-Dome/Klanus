<?php
/*
 * Prüft, ob es neue Menü Einträge für das Projekt gibt, die verwendet werden können
 */

$sqlstr = "SELECT ID,Name FROM modul WHERE IsProjekt = 1";
$sth = $pdo->prepare($sqlstr);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    //prüfen ob menü eintrag schon vorhanden.
    $sqlstr1 = "SELECT Modul FROM projekt_setting_menubar WHERE Projekt = ? AND Modul = {$row["ID"]}";

    $sth1 = $pdo->prepare($sqlstr1);
    $sth1->bindParam(1, $loader_projeckt_id);
    $sth1->execute();

    if($sth1->rowCount() == 0){
        //wenn nicht vorhanden eintragen
        $sqlstr2 = "INSERT INTO projekt_setting_menubar (DisplayName, Prioritat, Projekt, Modul ) VALUES ";
        $sqlstr2 .= "('{$row["Name"]}', {$row["ID"]}, '$loader_projeckt_id', '{$row["ID"]}')";
        $sth2 = $pdo->prepare($sqlstr2);
        $sth2->execute();
    }
}

?>