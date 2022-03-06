<?php
session_start();

if(!isset($_SESSION["Login"])){
    ?>
    <script>
        location.href = "index.php";
    </script>
    <?php
    exit();
}
$overPath = "../../";

// rang
include_once "../../php/sql/connection.php";
include_once "../../php/rang/Rang.php";
$rang = new Rang($_SESSION['Rang'], $pdo);
?>

<link href="css/MainPages/userDasboard.css" rel="stylesheet">

<h1>Willkommen <span id="willkommenName"><?php echo $_SESSION['Name'] ?></span></h1>
<p class="dashbordUberschrift" >Deine Projekte</p>

<!-- TODO Datenbank-->
<div class="flexbox">
    <?php
    //TODO: Projeckt wo man mitgild ist hinzufügen
    $sth = $pdo->prepare("SELECT * FROM projekt WHERE Besitzer  = ? LIMIT 5");
    $sth->bindParam(1, $_SESSION['ID']);
    $sth->execute();

    foreach ($sth->fetchAll() as $row) {
        ?>
        <div class="dashbordProjektKasten">
            <span class="Projekttool"><i  style="color: #fff408;" class="bi bi-x-diamond-fill"></i></span>
            <span class="Projekttool Projekttoolright"><i class="bi bi-heart"></i></span>

            <img class="dashbordProjektImg" src="assets/default_projeckt.png">

            <p class="dashbordProjektName"><?php echo $row["Name"]; if($row["Verifiziert"]) { ?> <i style="color: #45FF58;" class="bi bi-check2-circle"></i> <?php }?></p>
            <button class="dashbordProjektButton">Zum Projekt</button>
        </div>
        <?php
    }
    ?>
</div>

<div class="buttonMoreProjektsContainer">
    <!-- Mehr Button-->
    <i class="bi bi-chevron-compact-down buttonMoreProjekts"></i>
</div>



