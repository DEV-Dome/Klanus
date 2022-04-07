<?php
session_start();

if(!isset($_SESSION["Login"]) || !isset($_GET["join"])){
    ?>
    <script>
        location.href = "index.php";
    </script>
    <?php
    exit();
}
include_once "../../php/sql/connection.php";
include_once "../../php/rang/Rang.php";
$overPath = "../../";

$key = $_GET["join"];
$name = "";
$pid = "";
$load = false;

$sglstr = "SELECT *, projekt.ID AS 'Pid' FROM projekt_einladungen,projekt WHERE Projekt = projekt.ID AND Einladung = ? LIMIT 1";

$sth = $pdo->prepare($sglstr);
$sth->bindParam(1, $key);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $name = $row["Name"];
    $pid = $row["Pid"];

    $load = true;
}
//wenn einladungslink nicht exsitiert
if(!$load) {
    ?>
    <link href="css/MainPages/joinProjekt/main.css" rel="stylesheet">
    <link href="css/MainPages/joinProjekt/main_handy.css" rel="stylesheet">

    <div class="content_container">
        <span class="bild_contatiner">
            <img src="assets/Logo.png" class="projekt_img" >
        </span>
        <span class="joinText">Diese Einladung ist nicht gültig</span>
        <span class="button_container">
            <button onclick='location.href="index.php"' class="button button_schlissen">Schlissen</button>
        </span>
    </div>
    <?php
    exit();
}
//wenn User schon im Projeckt ist
$sglstr = "SELECT * FROM projekt_user WHERE User = ? AND Projekt = ?  LIMIT 1";

$sth = $pdo->prepare($sglstr);
$sth->bindParam(1,$_SESSION["ID"]);
$sth->bindParam(2,$pid);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    ?>
    <link href="css/MainPages/joinProjekt/main.css" rel="stylesheet">
    <link href="css/MainPages/joinProjekt/main_handy.css" rel="stylesheet">

    <div class="content_container">
        <span class="bild_contatiner">
            <?php
            $loadPgClasses = "projekt_img";
            $outputpfad = "";
            include "../../php/projekt/get/Image.php";
            ?>
        </span>

        <span class="joinText">Du bist schon im Projekt <ii class="projektName"><?php echo $name ?></ii></span>

        <span class="button_container">
          <button onclick='location.href="index.php"' class="button button_schlissen">Schlissen</button>
        </span>
    </div>

    <?php
    exit();
}
//wenn alles richtig ist.
?>
<link href="css/MainPages/joinProjekt/main.css" rel="stylesheet">
<link href="css/MainPages/joinProjekt/main_handy.css" rel="stylesheet">

<div class="content_container">
    <span class="bild_contatiner">
        <?php
        $loadPgClasses = "projekt_img";
        $outputpfad = "";
        include "../../php/projekt/get/Image.php";
        ?>
    </span>
    <span class="joinText">Möchtest du dem Projekt <ii class="projektName"><?php echo $name ?></ii> beitretten?</span>

    <span class="button_container">
      <button onclick="userJoinNewProjeckt(<?php echo $pid; ?>);" class="button buttonJoin">Projekt beitretten</button>
      <button onclick='location.href="index.php"' class="button button_schlissen">Schlissen</button>
    </span>
</div>
