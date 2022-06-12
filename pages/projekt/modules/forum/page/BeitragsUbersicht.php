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

$fid = $_GET["fid"]; // Forum ID
$fname = ""; // Forum Namen
$fbeschreibung = "";  // Forum Beschreibung

include "../../rang/projektRang.php";
include_once "../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

//information getten


$sqlstr = "SELECT * FROM projekt_forum_forn WHERE ID = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $fid);
$sth->execute();

foreach($sth->fetchAll() as $row) {
    $fname = $row["Name"];
    $fbeschreibung = $row["Beschreibung"];
}
?>

<link href="pages/projekt/modules/forum/css/main.css" rel="stylesheet">
<link href="pages/projekt/modules/forum/css/main_handy.css" rel="stylesheet">

<div class="headline_conatiner" >
    <span class="headline-text" ><?php echo $fname; ?></span><br>
    <span class="headline-text Beitrag_ubersicht_beschreibung" ><?php echo $fbeschreibung; ?></span>

    <!-- Buttons -->
    <button class="beitrag_button neuen_beitrag_button" style="">Neuen Beitrag</button>
</div>

<div class="beitrag_container">
    <span style="margin-left: 10% !important; font-size: 20px;">Angepinnt</span>

    <span class="beitrag_letzer_beitrag none_margin_top" style="margin-right: 3%!important;">Letzter Beitrag</span>
    <span class="beitrag_zugriffe none_margin_top" style="margin-right: 8% !important;">zugriffe</span>
    <span class="beitrag_antworten none_margin_top" style="margin-right: 3% !important;">Antworten</span>
    <hr>

    <div class="beitrage">
        <img onclick="" id="pb_settings" width="200px" src="php/upload/user/profielimg/1.png" class="beitrag_bild" alt="Dein Profiel Bild konnte nicht geladen werden">
        <div class="beitrag_name">Tolles Update <br> <span class="beitrag_subtitle">erstellt von Nico</span></div>
        <div class="beitrag_antworten">3</div>
        <div class="beitrag_zugriffe">396</div>
        <div class="beitrag_letzer_beitrag">von Dome<br><span class="beitrag_subtitle" >am <b >17.04.2022</b></span></div>
    </div>
    <div class="beitrage">
        <img onclick="" id="pb_settings" width="200px" src="php/upload/user/profielimg/1.png" class="beitrag_bild" alt="Dein Profiel Bild konnte nicht geladen werden">
        <div class="beitrag_name">Tolles Update 1<br> <span class="beitrag_subtitle">erstellt von Nico</span></div>
        <div class="beitrag_antworten">3</div>
        <div class="beitrag_zugriffe">396</div>
        <div class="beitrag_letzer_beitrag">von Dome<br><span class="beitrag_subtitle" >am <b >17.04.2022</b></span></div>
    </div>
    <div class="beitrage">
        <img onclick="" id="pb_settings" width="200px" src="php/upload/user/profielimg/1.png" class="beitrag_bild" alt="Dein Profiel Bild konnte nicht geladen werden">
        <div class="beitrag_name">Tolles Update 2<br> <span class="beitrag_subtitle">erstellt von Nico</span></div>
        <div class="beitrag_antworten">3</div>
        <div class="beitrag_zugriffe">396</div>
        <div class="beitrag_letzer_beitrag">von Dome<br><span class="beitrag_subtitle" >am <b >17.04.2022</b></span></div>
    </div>
    <div class="beitrage">
        <img onclick="" id="pb_settings" width="200px" src="php/upload/user/profielimg/1.png" class="beitrag_bild" alt="Dein Profiel Bild konnte nicht geladen werden">
        <div class="beitrag_name">Tolles Update 3<br> <span class="beitrag_subtitle">erstellt von Nico</span></div>
        <div class="beitrag_antworten">3</div>
        <div class="beitrag_zugriffe">396</div>
        <div class="beitrag_letzer_beitrag">von Dome<br><span class="beitrag_subtitle" >am <b >17.04.2022</b></span></div>
    </div>
</div>

<div class="beitrag_container">
    <span style="margin-left: 10% !important; font-size: 20px;">Alle Beiträge</span>

    <span class="beitrag_letzer_beitrag none_margin_top" style="margin-right: 3%!important;">Letzter Beitrag</span>
    <span class="beitrag_zugriffe none_margin_top" style="margin-right: 8% !important;">zugriffe</span>
    <span class="beitrag_antworten none_margin_top" style="margin-right: 3% !important;">Antworten</span>
    <hr>

    <div class="beitrage">
        <img onclick="" id="pb_settings" width="200px" src="php/upload/user/profielimg/1.png" class="beitrag_bild" alt="Dein Profiel Bild konnte nicht geladen werden">
        <div class="beitrag_name">User Beitrag <br> <span class="beitrag_subtitle">erstellt von Nico</span></div>
        <div class="beitrag_antworten">3</div>
        <div class="beitrag_zugriffe">396</div>
        <div class="beitrag_letzer_beitrag">von Dome<br><span class="beitrag_subtitle" >am <b >17.04.2022</b></span></div>
    </div>
    <div class="beitrage">
        <img onclick="" id="pb_settings" width="200px" src="php/upload/user/profielimg/1.png" class="beitrag_bild" alt="Dein Profiel Bild konnte nicht geladen werden">
        <div class="beitrag_name">User Beitrag 1<br> <span class="beitrag_subtitle">erstellt von Nico</span></div>
        <div class="beitrag_antworten">3</div>
        <div class="beitrag_zugriffe">396</div>
        <div class="beitrag_letzer_beitrag">von Dome<br><span class="beitrag_subtitle" >am <b >17.04.2022</b></span></div>
    </div>
    <div class="beitrage">
        <img onclick="" id="pb_settings" width="200px" src="php/upload/user/profielimg/1.png" class="beitrag_bild" alt="Dein Profiel Bild konnte nicht geladen werden">
        <div class="beitrag_name">User Beitrag 2<br> <span class="beitrag_subtitle">erstellt von Nico</span></div>
        <div class="beitrag_antworten">3</div>
        <div class="beitrag_zugriffe">396</div>
        <div class="beitrag_letzer_beitrag">von Dome<br><span class="beitrag_subtitle" >am <b >17.04.2022</b></span></div>
    </div>
    <div class="beitrage">
        <img onclick="" id="pb_settings" width="200px" src="php/upload/user/profielimg/1.png" class="beitrag_bild" alt="Dein Profiel Bild konnte nicht geladen werden">
        <div class="beitrag_name">User Beitrag 3<br> <span class="beitrag_subtitle">erstellt von Nico</span></div>
        <div class="beitrag_antworten">3</div>
        <div class="beitrag_zugriffe">396</div>
        <div class="beitrag_letzer_beitrag">von Dome<br><span class="beitrag_subtitle" >am <b >17.04.2022</b></span></div>
    </div>
</div>
