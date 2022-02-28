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


<h1>Willkommen <span id="willkommenName"><?php echo $_SESSION['Name'] ?></span></h1>
<p class="dashbordUberschrift" >Deine Projekte</p>

<!-- TODO Datenbank-->
<div class="dashbordProjektKasten">
    <span class="Projekttool"><i  style="color: #fff408;" class="bi bi-x-diamond-fill"></i></span>
    <span class="Projekttool Projekttoolright"><i class="bi bi-heart"></i></span>

    <img class="dashbordProjektImg" src="assets/default_projeckt.png">

    <p class="dashbordProjektName">Name</p>
    <button class="dashbordProjektButton">Zum Projekt</button>
</div>

