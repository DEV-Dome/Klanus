<?php
session_start();

include "../../../../php/sql/connection.php";
include "../rang/projektRang.php";
include_once "../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

if(!($prang->hasPermission("report.menu") || $rang->hasPermission("all.report.menu"))){
    exit();
}
?>
<div class="headline_conatiner" >
    Gemeldete Inhalte
</div>

<link href="pages/projekt/modules/meldung/css/Main.css" rel="stylesheet">

<div class="page_main" >
    <div class="overview_container">
        <div class="overview_item">
            <div class="overview_icon overview_item_detail">
                <div class="overview_conatiner_box" onclick="loadProjektUnderPage('meldung', 'Beitraege.php')">
                    <i class="bi bi-card-checklist overview_text_icon"></i><br>
                    <span class="overview_text_title">Forum Beiträge</span>
                </div>
                <div class="overview_conatiner_box" onclick="loadProjektUnderPage('meldung', '')">
                    <i class="bi bi-card-heading overview_text_icon"></i><br>
                    <span class="overview_text_title">Forum Kommentare</span>
                </div>
            </div>
        </div>
    </div>
</div>

