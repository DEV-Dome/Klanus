<?php
session_start();

$overPath = "../../../../../";
if(!isset($_SESSION["Login"])){
    ?>
    <script>
        location.href = "../index.php";
    </script>
    <?php
    exit();
}
include "../../../../../php/sql/connection.php";

$bid = $_GET["bid"]; // Forum ID
$bname = ""; // Beitrag Namen
$bbeschreibung = "";  // Beitrag Beschreibung

include "../../rang/projektRang.php";
include_once "../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

//information getten


$sqlstr = "SELECT BeitragKommentar,projekt_forum_beitrage.Name AS 'Name' FROM projekt_forum_beitrage,projekt_forum_forn WHERE Forum = projekt_forum_forn.ID  AND projekt_forum_beitrage.ID = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $bid);
$sth->execute();

foreach($sth->fetchAll() as $row) {
    $bname = $row["Name"];
    $bbeschreibung = $row["BeitragKommentar"];
}
?>

<link href="pages/projekt/modules/forum/css/main.css" rel="stylesheet">
<link href="pages/projekt/modules/forum/css/main_handy.css" rel="stylesheet">
<link href="pages/projekt/modules/forum/css/main_tablet.css" rel="stylesheet">

<div class="beitrag_main_container">
        <div class="beitrag_teiler beitrag_teile_headline">
            <div class="headline_conatiner" >
                <span class="headline-text" ><?php echo utf8_encode($bname); ?></span><br>
                <span class="headline-text Beitrag_ubersicht_beschreibung" ><?php echo utf8_encode($bbeschreibung); ?></span>
            </div>
        </div>
        <div class="beitrag_teiler beitrag_teile_input">
            <div class="beitrag_verwalter_conatiner">
                <?php
                    $sqlstr = "SELECT *,user.name AS 'uname' FROM projekt_forum_beitrage_kommentare,user,projekt_user,projekt_rang WHERE projekt_rang.ID = projekt_user.Rang AND projekt_user.User = user.ID AND projekt_user.Projekt = ? AND Owner = user.ID AND Beitrag = ? ORDER BY projekt_forum_beitrage_kommentare.ID";
                    $sth = $pdo->prepare($sqlstr);
                    $sth->bindParam(2, $bid);
                    $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
                    $sth->execute();

                    foreach($sth->fetchAll() as $row) {
                ?>
                <div class="beitrag_verwlater helper">
                <div class="beitrag_abzeige_conatiner beitrag_abzeige_conatiner_userinfo">
                    <?php
                    $loadPgClasses = "beitrag_kommentar_bild";
                    $loadPgOnClick = "";
                    $outputpfad = "";
                    $bid =  intval($row["Owner"], 10);
                    include "../../../../../php/user/get/UserImage.php";
                    ?>
                    <span class="beitrag_kommentar_user_name" style="color: <?php echo $row["Color"]; ?>"><?php echo utf8_encode(ucfirst($row["uname"])) ?></span>
                </div>
                <div class="beitrag_abzeige_conatiner beitrag_abzeige_conatiner_beitraginfo">

                </div>
            </div>
                <?php
                    }
                ?>

            </div>
        </div>
</div>