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
$prang = new projektRang($_SESSION['PRang'], $pdo);
$prang_prioritat = 0;

    $sqlstr = "SELECT *  FROM projekt_rang WHERE ID = ? ";
    $sth = $pdo->prepare($sqlstr);
    $sth->bindParam(1, $_SESSION['PRang']);
    $sth->execute();

    foreach($sth->fetchAll() as $row) {
        $prang_prioritat = $_SESSION['PRang'];
    }
    echo $prang_prioritat;
?>
<link href="pages/projekt/modules/forum/css/main.css?v=<?php echo time() ?>" rel="stylesheet">
<link href="pages/projekt/modules/forum/css/main_handy.css?v=<?php echo time() ?>" rel="stylesheet">

<div id="main_forum">

    <?php

    $sqlstr = "SELECT *,projekt_forum_kategorien.Name AS 'kname',projekt_forum_kategorien.ID 'kID'  FROM projekt_forum_kategorien,projekt_rang WHERE  ";
    $sqlstr .= "projekt_forum_kategorien.Rang = projekt_rang.ID AND projekt_forum_kategorien.Projekt = ? AND projekt_rang.Prioritat <= $prang_prioritat ";
    $sqlstr .= "ORDER BY projekt_forum_kategorien.prioritat ASC";
    $sth = $pdo->prepare($sqlstr);
    $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
    $sth->execute();

    foreach($sth->fetchAll() as $row) {
        $frang
    ?>
        <div class="Forum_Kategorie">
            <div class="Forum_Kategorie_head">
                <p><?php echo $row["kname"]?></p>
                <hr>
            </div>

            <?php
            $sqlstr1 = "SELECT *,projekt_forum_forn.Name AS 'fName',projekt_forum_forn.ID AS 'fID'  FROM projekt_forum_forn,projekt_rang ";
            $sqlstr1 .= "WHERE KannSehen = projekt_rang.ID AND kategorien = ? AND projekt_rang.Prioritat <= $prang_prioritat ";
            $sqlstr1 .= "ORDER BY projekt_forum_forn.prioritat ASC";
            $sth_fornen = $pdo->prepare($sqlstr1);
            $sth_fornen->bindParam(1, $row["kID"]);
            $sth_fornen->execute();

            foreach($sth_fornen->fetchAll() as $row_foren) {
            ?>

            <div class="Forum" onclick="loadProjektUnderPage('forum', 'BeitragsUbersicht.php?fid=<?php echo $row_foren["fID"]?>');">
                <div class="Forum_icon">
                    <i class="bi bi-folder-fill"></i>
                </div>
                <div class="Forum_name">
                   <?php echo ($row_foren["fName"]); ?>
                </div>
                <div class="Forum_beschreibung">
                    <?php echo ($row_foren["Beschreibung"]); ?>
                </div>
        </div>
    <?php
            }
    }
    ?>
</div>

