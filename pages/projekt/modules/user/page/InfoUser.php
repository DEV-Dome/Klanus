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
$uid = $_GET["uid"];
?>

<link href="pages/projekt/modules/user/css/main.css" rel="stylesheet">
<link href="pages/projekt/modules/user/css/main_handy.css" rel="stylesheet">
<link href="pages/projekt/modules/user/css/main_tablet.css" rel="stylesheet">

<div class="headline_conatiner" >
    <span class="headline-text" >User informationen</span>
</div>

<div class="page_main page_main_scroll_hidden" >
    <input disabled type="text" placeholder="ID" id="id" class="input_fild_half">
    <input disabled type="text" placeholder="Discord-Tag" id="dct" class="input_fild_half">

    <?php
        $loadPgClasses = "userListeBildInfoSeite";
        $loadPgOnClick = "";
        $outputpfad = "";
        $bid =  intval($uid, 10);
        include "../../../../../php/user/get/UserImage.php";
    ?>
    <p class="infotext">Weiter Anzeigen werden hier noch ergänzt</p>
    <input disabled type="text" placeholder="Name" id="name" class="input_fild_half input_fild_half_neben_pb">

    <select class="input_fild_normal ">
        <option>Rang ändern</option>
    </select>
</div>