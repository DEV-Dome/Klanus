<?php
session_start();

include "../../../../../php/sql/connection.php";
include "../../rang/projektRang.php";
include_once "../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

if(!$prang->hasPermission("setting.see.menu") && !$rang->hasPermission("all.setting.see.menu")) {
    return;
}
?>
<div class="headline_conatiner" >
    Menü Einstellungen
</div>

<link href="pages/projekt/modules/einstellungen/css/unterseiten/menu/Main.css" rel="stylesheet">
<!--<link href="pages/projekt/modules/einstellungen/css/unterseiten/menu/Main_handy.css" rel="stylesheet"> -->

<div class="page_main " >
    <div class="menu_container">
        <div class="menu_item">
            <div class="menu_icon">
                <i class="bi bi-person"></i>
            </div>
            <div class="menu_text">
               User
            </div>
            <div class="menu_button_stop">
                <button class="button stopButtonMenu">
                    <i class="bi bi-slash-circle"></i>
                </button>
            </div>
            <div class="menu_button_edit">
                <button class="button editButtonMenu">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
        </div>

        <div class="menu_item">
            <div class="menu_icon">
                <i class="bi bi-person"></i>
            </div>
            <div class="menu_text">
                Einladungen
            </div>
            <div class="menu_button_stop">
                <button  class="button stopButtonMenu">
                    <i class="bi bi-receipt"></i>
                </button>
            </div>
            <div class="menu_button_edit">
                <button  class="button editButtonMenu">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
        </div>

        <div class="menu_item">
            <div class="menu_icon">
                <i class="bi bi-person-lines-fill"></i>
            </div>
            <div class="menu_text">
                Rang
            </div>
            <div class="menu_button_stop">
                <button onclick="newEinladung()" class="button stopButtonMenu">
                    <i class="bi bi-slash-circle"></i>
                </button>
            </div>
            <div class="menu_button_edit">
                <button onclick="newEinladung()" class="button editButtonMenu">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
        </div>

        <div class="menu_item">
            <div class="menu_icon">
                <i class="bi bi-gear"></i>
            </div>
            <div class="menu_text">
                Einstellungen
            </div>
            <div class="menu_button_stop">
                <button onclick="newEinladung()" class="button stopButtonMenu">
                    <i class="bi bi-slash-circle"></i>
                </button>
            </div>
            <div class="menu_button_edit">
                <button onclick="newEinladung()" class="button editButtonMenu">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
        </div>
    </div>
</div>
