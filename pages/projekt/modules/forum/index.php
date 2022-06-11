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
?>
<link href="pages/projekt/modules/forum/css/main.css" rel="stylesheet">

<div id="main_forum">
    <div class="Forum_Kategorie">
        <div class="Forum_Kategorie_head">
            <p>Allgemein </p>
            <hr>
        </div>

        <div class="Forum">
            <div class="Forum_icon">
                <i class="bi bi-folder-fill"></i>
            </div>
            <div class="Forum_name">
                Test-Forum
            </div>
            <div class="Forum_beschreibung">
                Tolle beschreibung
            </div>
        </div>
        <div class="Forum">
            <div class="Forum_icon">
                <i class="bi bi-folder-fill"></i>
            </div>
            <div class="Forum_name">
                Test-Forum
            </div>
            <div class="Forum_beschreibung">
                Tolle beschreibung
            </div>
        </div>
        <div class="Forum">
            <div class="Forum_icon">
                <i class="bi bi-folder-fill"></i>
            </div>
            <div class="Forum_name">
                Test-Forum
            </div>
            <div class="Forum_beschreibung">
                Tolle beschreibung
            </div>
        </div>
        <div class="Forum">
            <div class="Forum_icon">
                <i class="bi bi-folder-fill"></i>
            </div>
            <div class="Forum_name">
                Test-Forum
            </div>
            <div class="Forum_beschreibung">
                Tolle beschreibung
            </div>
        </div>

    </div>

    <div class="Forum_Kategorie">
        <div class="Forum_Kategorie_head">
            <p>Bewerben </p>
            <hr>
        </div>

        <div class="Forum">
            <div class="Forum_icon">
                <i class="bi bi-folder-fill"></i>
            </div>
            <div class="Forum_name">
                Test-Bewerbung Forum
            </div>
            <div class="Forum_beschreibung">
                Tolle beschreibung xD Lolololol
            </div>
        </div>
        <div class="Forum">
            <div class="Forum_icon">
                <i class="bi bi-folder-fill"></i>
            </div>
            <div class="Forum_name">
                Test-Bewerbung Forum
            </div>
            <div class="Forum_beschreibung">
                Tolle beschreibung xD Lolololol
            </div>
        </div>
        <div class="Forum">
            <div class="Forum_icon">
                <i class="bi bi-folder-fill"></i>
            </div>
            <div class="Forum_name">
                Test-Bewerbung Forum
            </div>
            <div class="Forum_beschreibung">
                Tolle beschreibung xD Lolololol
            </div>
        </div>
        <div class="Forum">
            <div class="Forum_icon">
                <i class="bi bi-folder-fill"></i>
            </div>
            <div class="Forum_name">
                Test-Bewerbung Forum
            </div>
            <div class="Forum_beschreibung">
                Tolle beschreibung xD Lolololol
            </div>
        </div>
        <div class="Forum">
            <div class="Forum_icon">
                <i class="bi bi-folder-fill"></i>
            </div>
            <div class="Forum_name">
                Test-Bewerbung Forum
            </div>
            <div class="Forum_beschreibung">
                Tolle beschreibung xD Lolololol
            </div>
        </div>
    </div>

</div>

