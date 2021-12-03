<?php
session_start();
$overPath = "../../";

if(!isset($_SESSION["Login"])){
    ?>
    <script>
        location.href = "index.php";
    </script>
    <?php
    exit();
}
// rang
include_once "../../php/sql/connection.php";
include_once "../../php/rang/Rang.php";
$rang = new Rang($_SESSION['Rang'], $pdo);
?>
<link href="css/page_settings.css" rel="stylesheet">
<div id="settings_warpper">
    <h1 class="Headline">User - Informationen</h1>
    <h6 class="Headline_subtest" >An dieser Stelle kannst du Informationen über deinen Account einsehen.</h6>

    <!-- Einstellungs Kästen-->
    <div class="Container_Setting">
        <p class="text_info text_ranginfo_name">Dein Rang ist: <span class="text_ranginfo_nameOfRang"><?php echo $rang->name ?></span></p>
        <p class="text_info text_ranginfo_rang"><?php echo $rang->desc ?></p>

        <br/>
    </div>
</div>