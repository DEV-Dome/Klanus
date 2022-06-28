<?php
session_start();

include "../../../../php/sql/connection.php";
include "../rang/projektRang.php";
include_once "../../../../php/rang/Rang.php";

$sth = $pdo->prepare("SELECT * FROM projekt WHERE ID = ? LIMIT 1");
$sth->bindParam(1, $_SESSION["projekt.aktiv"]);
$sth->execute();

$name = "";
$kurzel = "";
$beschreibung = "";

foreach ($sth->fetchAll() as $row) {
    $name = $row["Name"];
    $kurzel = $row["Kurzel"];
    $beschreibung = $row["Beschreibung"];
}
$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo)
?>
<div class="headline_conatiner" >
    Projekt Einstellungen
</div>

<link href="pages/projekt/modules/einstellungen/css/Main.css" rel="stylesheet">
<!--<link href="pages/projekt/modules/einstellungen/css/Main_handy.css" rel="stylesheet"> -->

<div class="page_main" >
    <div class="overview_container">
        <div class="overview_item">
            <div class="overview_icon overview_item_detail">
                <?php if($prang->hasPermission("setting.see.allgemein") || $rang->hasPermission("all.setting.see.allgemein")) {?>
                    <div class="overview_conatiner_box" onclick="loadProjektUnderPage('einstellungen', 'allegemeine_einstellungen.php')">
                        <i class="bi bi-gear overview_text_icon"></i><br>
                        <span class="overview_text_title">Allgemeine Einstellungen</span>
                    </div>
                <?php }
                if($prang->hasPermission("setting.see.gefahr") || $rang->hasPermission("all.setting.see.gefahr")) {?>
                    <div class="overview_conatiner_box" onclick="loadProjektUnderPage('einstellungen', 'nicht_verfügbar.php')">
                        <i class="bi bi-exclamation-circle overview_text_icon"></i><br>
                        <span class="overview_text_title">Gefährlich Einstellungen</span>
                    </div>
                <?php }
                if($prang->hasPermission("setting.see.discord") || $rang->hasPermission("all.setting.see.discord")) {?>
                    <div class="overview_conatiner_box" onclick="loadProjektUnderPage('einstellungen', 'nicht_verfügbar.php')">
                        <i class="bi bi-discord overview_text_icon"></i><br>
                        <span class="overview_text_title">Discord Einstellungen</span>
                    </div>
                <?php }
                if($prang->hasPermission("setting.see.minecraft") || $rang->hasPermission("all.setting.see.minecraft")) {?>
                    <div class="overview_conatiner_box" onclick="loadProjektUnderPage('einstellungen', 'nicht_verfügbar.php')">
                        <i class="bi bi-controller overview_text_icon"></i><br>
                        <span class="overview_text_title">Minecraft Einstellungen</span>
                    </div>
                <?php }
                if($prang->hasPermission("setting.see.forum") || $rang->hasPermission("all.setting.see.forum")) {?>
                    <div class="overview_conatiner_box" onclick="loadProjektUnderPage('einstellungen', 'forum/forum_einstellungen.php')">
                        <i class="bi bi-body-text overview_text_icon"></i><br>
                        <span class="overview_text_title">Forum Einstellungen</span>
                    </div>
                <?php }
                if($prang->hasPermission("setting.see.menu") || $rang->hasPermission("all.setting.see.menu")) {?>
                    <div class="overview_conatiner_box" onclick="loadProjektUnderPage('einstellungen', 'menu_einstellungen.php')">
                        <i class="bi bi-bar-chart overview_text_icon"></i><br>
                        <span class="overview_text_title">Menü Einstellungen</span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>