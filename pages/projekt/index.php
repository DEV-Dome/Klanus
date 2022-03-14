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

if(!isset($_GET["pid"])){
    exit("projekt nicht vorhanden!");
}
$id = $_GET["pid"];
$pname = ""; //projekt name
$sname = ""; //status name
$beschreibung = ""; //beschreibung vom Projekt

// rang
include_once "../../php/sql/connection.php";
include_once "../../php/rang/Rang.php";
$rang = new Rang($_SESSION['Rang'], $pdo);

$sth = $pdo->prepare("SELECT projekt.Name AS 'pname', projekt_status.Name AS 'sname',projekt.Beschreibung AS 'pBeschreibung' FROM projekt,projekt_status WHERE Status = projekt_status.ID AND projekt.ID = ? LIMIT 1");
$sth->bindParam(1, $id);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $pname = $row["pname"];
    $sname = $row["sname"];
    $beschreibung = $row["pBeschreibung"];
}

?>

<link href="css/MainPages/projekt/main.css" rel="stylesheet">
<p class="headline"><?php echo $pname; ?></p>
<span class="abzeichen"><?php echo $sname; ?></span>

<p class="headline_small_sigel">Das Projekte</p>
<p class="projekt_desc"><?php echo $beschreibung; ?></p>

<p class="headline_small_sigel">Ankündigungen</p>
<div class="ankundigungen">
    <div class="ankundigung_item">
        <p class="ankundigung_headline">Neue Ankündigung</p>
        <img class="ankundigung_img" src="assets/default_ankündigung.png">
        <p class="ankundigung_zusammenfassung">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. </p>
    </div>

    <div class="ankundigung_item">
        <p class="ankundigung_headline">Neue Ankündigung</p>
        <img class="ankundigung_img" src="assets/default_ankündigung.png">
        <p class="ankundigung_zusammenfassung">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. </p>
    </div>

    <div class="ankundigung_item">
        <p class="ankundigung_headline">Neue Ankündigung</p>
        <img class="ankundigung_img" src="assets/default_ankündigung.png">
        <p class="ankundigung_zusammenfassung">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. </p>
    </div>

    <div class="ankundigung_item">
        <p class="ankundigung_headline">Neue Ankündigung</p>
        <img class="ankundigung_img" src="assets/default_ankündigung.png">
        <p class="ankundigung_zusammenfassung">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. </p>
    </div>
</div>