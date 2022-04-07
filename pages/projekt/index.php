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
include_once "../../php/sql/connection.php";
include_once "../../php/rang/Rang.php";
include_once "../../pages/projekt/modules/rang/projektRang.php";

//setzten des Projeckts
$_SESSION["projekt.aktiv"] = $_GET["pid"];

$id = $_GET["pid"];
$pname = ""; //projekt name
$sname = ""; //status name
$beschreibung = ""; //beschreibung vom Projekt
$rangID = -1; // id von Projeckt rang

$sqlstr = "SELECT projekt.Name AS 'pname', projekt_status.Name AS 'sname',projekt.Beschreibung AS 'pBeschreibung' FROM projekt,projekt_status WHERE Status = projekt_status.ID AND projekt.ID = ? LIMIT 1";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $id);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $pname = $row["pname"];
    $sname = $row["sname"];
    $beschreibung = $row["pBeschreibung"];
}

$sqlstr = "SELECT * FROM projekt_user WHERE User = ? AND Projekt  = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $_SESSION["ID"]);
$sth->bindParam(2, $_SESSION["projekt.aktiv"]);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $rangID = $row["Rang"];
}
$_SESSION["PRang"] = $rangID;

// rang
$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);
?>

<link href="css/MainPages/projekt/main.css" rel="stylesheet">
<link href="css/MainPages/projekt/main_handy.css" rel="stylesheet">
<p class="headline"><?php echo $pname; ?></p>
<span class="abzeichen"><?php echo $sname; ?></span>

<?php
$loadPgClasses = "projekt_img";
$outputpfad = "";
include "../../php/projekt/get/Image.php";
?>

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