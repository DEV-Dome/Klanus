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
include "../../rang/projektRang.php";
include_once "../../../../../php/rang/Rang.php";

$fid = $_GET["fid"];

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

$sqlstr = "SELECT * FROM projekt_forum_forn WHERE ID = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $fid);
$sth->execute();

foreach($sth->fetchAll() as $row) {
    $fname = $row["Name"];
}

?>

<link href="pages/projekt/modules/forum/css/main_beitrag.css?v=<?php echo time()?>" rel="stylesheet">

<div class="headline_conatiner" >
    <span class="headline-text" >Neuen Beitrag</span><br>
    <span class="headline-text Beitrag_ubersicht_beschreibung" >Du erstellst einen neuen beitragim Fourm <?php echo $fname; ?></span>
</div>

<div class="page_main">
    <input type="text" placeholder="Beitrag Name" id="name" class="input_fild_normal">

    <div class="ck-box">
        <div id="editor" rows="3">

        </div>
    </div>

    <div class="button_container">
        <button class="button_new button_color_gray back_button">Zurück</button>
        <button class="button_new button_color_green senden_button">Neuen Beitrag</button>
    </div>


</div>
