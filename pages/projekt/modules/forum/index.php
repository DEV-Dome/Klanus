<?php
session_start();

$overPath = "../../../../";
if(!isset($_SESSION["Login"])){
    ?>
    <script>
        location.href = "../index.php";
    </script>
    <?php
    exit();
}
include "../../../../php/sql/connection.php";
include "../rang/projektRang.php";
include_once "../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo)

/*
 * Name: 50 Zeichen
 * Beschreibung: 50 Zeichen
 */
?>
<link href="pages/projekt/modules/forum/css/main.css" rel="stylesheet">
<link href="pages/projekt/modules/forum/css/main_handy.css" rel="stylesheet">

<div id="main_forum">

    <?php

    $sqlstr = "SELECT *  FROM projekt_forum_kategorien WHERE Projekt = ? ORDER BY priorität ASC ";
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

            <?php
            $sqlstr1 = "SELECT *  FROM projekt_forum_forn WHERE kategorien = ? ORDER BY priorität ASC ";
            $sth_fornen = $pdo->prepare($sqlstr1);
            $sth_fornen->bindParam(1, $row["ID"]);
            $sth_fornen->execute();

            foreach($sth_fornen->fetchAll() as $row_foren) {
            ?>

            <div class="Forum" onclick="loadProjektUnderPage('forum', 'BeitragsUbersicht.php?fid=<?php echo $row_foren["ID"]?>');">
                <div class="Forum_icon">
                    <i class="bi bi-folder-fill"></i>
                </div>
                <div class="Forum_name">
                   <?php echo $row_foren["Name"]; ?>
                </div>
                <div class="Forum_beschreibung">
                    <?php echo $row_foren["Beschreibung"]; ?>
                </div>
        </div>
    <?php
            }
    }
    ?>
</div>

