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

    $dragable = "";
    if($prang->hasPermission("forum.setting.kategorie.prioritat") || $rang->hasPermission("all.forum.setting.kategorie.prioritat")) {
        $dragable = 'draggable="true"';
    }

    $dragable_forum = "";
    if($prang->hasPermission("forum.setting.forum.prioritat") || $rang->hasPermission("all.forum.setting.forum.prioritat")) {
        $dragable_forum = 'draggable="true"';
    }

    foreach($sth->fetchAll() as $row) {
    ?>
    <div class="Forum_Kategorie">
        <div class="Forum_Kategorie_head" data-fromid="<?php echo $row['ID']?>" id="<?php echo $row['ID']?>"  <?php echo $dragable ?> ondragend="dragend()" ondragleave="menu_ondragleave(event)" ondragover="menu_dragover(event);" ondrop="drop(event)" ondragstart="dragstart(event)">
            <p data-fromid="<?php echo $row['ID']?>"><?php echo $row["Name"]?></p>
            <hr data-fromid="<?php echo $row['ID']?>">
        </div>
        <div  class="Forum_Kategorie_buttons">
            <?php if($prang->hasPermission("forum.setting.forum.add") || $rang->hasPermission("all.forum.setting.forum.add")) { ?><button onclick="loadProjektUnderPage('einstellungen', 'forum/forum_erstellen.php?kid=<?php echo $row["ID"] ?>')" class="button_forum create_forum" style="">Forum Erstellen</button><?php } ?>
            <?php if($prang->hasPermission("forum.setting.kategorie.edit") || $rang->hasPermission("all.forum.setting.kategorie.edit")) { ?><button onclick="loadProjektUnderPage('einstellungen', 'forum/kategorie_erstellen.php?id=<?php echo $row["ID"] ?>')" class="button_forum edit_kategorie" style="">Bearbeiten</button><?php } ?>
            <?php if($prang->hasPermission("forum.setting.kategorie.delete") || $rang->hasPermission("all.forum.setting.kategorie.delete")) { ?><button onclick="delete_kategorie(<?php echo $row["ID"] ?>)" class="button_forum delete_kategorie" style="">Löschen</button><?php } ?>
        </div>

        <?php
        $sqlstr1 = "SELECT *  FROM projekt_forum_forn WHERE kategorien = ? ORDER BY prioritat ASC ";
        $sth_fornen = $pdo->prepare($sqlstr1);
        $sth_fornen->bindParam(1, $row["ID"]);
        $sth_fornen->execute();

        foreach($sth_fornen->fetchAll() as $row_foren) {
            $gragGeter = $row_foren['ID'] . ":" . $row["ID"];
            ?>

            <div class="Forum" data-fromid="<?php echo $gragGeter ?>" id="<?php echo $gragGeter?>" <?php echo $dragable_forum ?> ondragend="forum_dragend()" ondragleave="forum_ondragleave(event)" ondragover="forum_dragover(event);" ondrop="forum_drop(event)" ondragstart="forum_dragstart(event)">
                <div data-fromid="<?php echo $gragGeter?>" class="Forum_icon">
                    <i data-fromid="<?php echo $gragGeter?>" class="bi bi-folder-fill"></i>
                </div>
                <div data-fromid="<?php echo $gragGeter?>"  class="Forum_name">
                    <span data-fromid="<?php echo $gragGeter?>" class="Forum_name_text"><?php echo ($row_foren["Name"]); ?></span>
                    <div data-fromid="<?php echo $gragGeter?>" class="forn_button_container">
                         <?php if($prang->hasPermission("forum.setting.forum.delete") || $rang->hasPermission("all.forum.setting.forum.edit")) { ?><button onclick="loadProjektUnderPage('einstellungen', 'forum/forum_erstellen.php?kid=<?php echo $row["ID"] ?>&id=<?php echo $row_foren["ID"] ?>')" class="button_forum_small edit_kategorie"><i class="bi bi-pencil"></i></button><?php } ?>
                         <?php if($prang->hasPermission("forum.setting.forum.delete") || $rang->hasPermission("all.forum.setting.forum.edit")) { ?><button onclick="delete_forum(<?php echo $row_foren["ID"] ?>)" class="button_forum_small delete_kategorie"><i class="bi bi-trash"></i></button><?php } ?>
                    </div>
                </div>
                <div data-fromid="<?php echo $gragGeter?>" class="Forum_beschreibung">
                    <?php echo ($row_foren["Beschreibung"]); ?>
                </div>
            </div>


            <?php
        }
            echo "</div>";
        }
        ?>
</div>
