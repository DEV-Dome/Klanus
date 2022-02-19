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
?>

<link href="css/Projekt/projektErstellen.css" rel="stylesheet">

<div class="headline_conatiner" >
    Neues Projekt
</div>

<div class="page_main" >
    <input type="text" placeholder="Name" id="name" class="input_fild_normal">
    <input type="text" placeholder="Kürzel" id="kurzel" class="input_fild_normal">

    <textarea id="beschreibung" class="input_fild_normal input_fild_normal_textarea" rows="4" placeholder="Beschreibung"></textarea>

    <button onclick="newProjeckt(document.getElementById('name').value, document.getElementById('kurzel').value, document.getElementById('beschreibung').value)" class="buttonCrate">Projekt Erstellen</button>

    <div id="feedback_hub" class="feedback_hub">Feedback</div>
</div>
