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
                <span class="headline-text" ><?php echo $bname; ?></span><br>
                <span class="headline-text Beitrag_ubersicht_beschreibung" ><?php echo $bbeschreibung; ?></span>
            </div>
        </div>
        <div class="beitrag_teiler beitrag_teile_input">
            <div class="beitrag_verwalter_conatiner">
                    <div class="beitrag_verwlater helper">
                        <div class="beitrag_abzeige_conatiner beitrag_abzeige_conatiner_userinfo"></div>
                        <div class="beitrag_abzeige_conatiner beitrag_abzeige_conatiner_beitraginfo"></div>
                    </div>
                    <div class="beitrag_verwlater"></div>
                    <div class="beitrag_verwlater"></div>
            </div>
        </div>
</div>