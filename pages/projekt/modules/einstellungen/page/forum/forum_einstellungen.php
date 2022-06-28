<?php
session_start();

include "../../../../../../php/sql/connection.php";
include "../../../rang/projektRang.php";
include_once "../../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);
$pid = $_SESSION["projekt.aktiv"];
if(!$prang->hasPermission("setting.see.forum") && !$rang->hasPermission("all.setting.see.forum")) {
    return;
}
?>

<div class="headline_conatiner" >
    <span class="headline_text">Forum Einstellungen</span> <?php if($prang->hasPermission("forum.setting.kategorie.add") || $rang->hasPermission("all.forum.setting.kategorie.add")) { ?> <button onclick="loadProjektUnderPage('einstellungen', 'forum/kategorie_erstellen.php')" class="button_forum neue_kategorie" style="">Neue Kategorie</button><?php } ?>
</div>

<link href="pages/projekt/modules/einstellungen/css/unterseiten/forum/Main.css?v=<?php echo time() ?>" rel="stylesheet">
<link href="pages/projekt/modules/einstellungen/css/unterseiten/forum/Main_handy.css?v=<?php echo time() ?>" rel="stylesheet">

<div class="page_main " >
    <?php

    $sqlstr = "SELECT *  FROM projekt_forum_kategorien WHERE Projekt = ? ORDER BY prioritat ASC ";
    $sth = $pdo->prepare($sqlstr);
    $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
    $sth->execute();

    foreach($sth->fetchAll() as $row) {
    ?>
    <div class="Forum_Kategorie">
        <div class="Forum_Kategorie_head">
            <p><?php echo $row["Name"]?></p>
            <hr>
        </div>
        <div class="Forum_Kategorie_buttons">
            <?php if($prang->hasPermission("forum.setting.kategorie.edit") || $rang->hasPermission("all.forum.setting.kategorie.edit")) { ?><button onclick="loadProjektUnderPage('einstellungen', 'forum/kategorie_erstellen.php?id=<?php echo $row["ID"] ?>')" class="button_forum edit_kategorie" style="">Bearbeiten</button><?php } ?>
            <?php if($prang->hasPermission("forum.setting.kategorie.delete") || $rang->hasPermission("forum.setting.kategorie.delete")) { ?><button onclick="delete_kategorie(<?php echo $row["ID"] ?>)" class="button_forum delete_kategorie" style="">Löschen</button><?php } ?>
        </div>

        <?php
        $sqlstr1 = "SELECT *  FROM projekt_forum_forn WHERE kategorien = ? ORDER BY prioritat ASC ";
        $sth_fornen = $pdo->prepare($sqlstr1);
        $sth_fornen->bindParam(1, $row["ID"]);
        $sth_fornen->execute();

        foreach($sth_fornen->fetchAll() as $row_foren) {
            ?>

            <div class="Forum">
                <div class="Forum_icon">
                    <i class="bi bi-folder-fill"></i>
                </div>
                <div class="Forum_name">
                    <?php echo utf8_encode($row_foren["Name"]); ?>
                </div>
                <div class="Forum_beschreibung">
                    <?php echo utf8_encode($row_foren["Beschreibung"]); ?>
                </div>
            </div>


            <?php
        }
            echo "</div>";
        }
        ?>
</div>
