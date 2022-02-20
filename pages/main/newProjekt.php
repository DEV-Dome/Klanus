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
include_once "../../php/sql/connection.php";
include_once "../../php/rang/Rang.php";
$rang = new Rang($_SESSION['Rang'], $pdo);
?>

<link href="css/Projekt/projektErstellen.css" rel="stylesheet">

<div class="headline_conatiner" >
    Neues Projekt
</div>

<div class="page_main" >
    <input type="text" placeholder="Name" id="name" class="input_fild_normal">
    <input type="text" placeholder="Kürzel" id="kurzel" class="input_fild_normal">

    <textarea id="beschreibung" class="input_fild_normal input_fild_normal_textarea" rows="4" placeholder="Beschreibung"></textarea>

    <select id="projektType" class="input_fild_half">
        <option value="1">Öffentliches Projekt</option>
        <option value="2">Privates Projekt</option>
        <option value="3" <?php if(!$rang->hasPermission("projekt.add.premium")) echo "disabled"?>>Premium Projekt</option>
        <option value="4" <?php if(!$rang->hasPermission("projekt.add.partner")) echo "disabled"?>>Partner Projekt</option>
    </select>

    <button onclick="newProjeckt(document.getElementById('name').value, document.getElementById('kurzel').value, document.getElementById('beschreibung').value, document.getElementById('projektType').value)" class="buttonCrate">Projekt Erstellen</button>

    <div id="feedback_hub" class="feedback_hub">Feedback</div>
</div>
