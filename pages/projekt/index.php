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
    exit("Projekt nicht vorhanden!");
}
$id = $_GET["pid"];

// rang
include_once "../../php/sql/connection.php";
include_once "../../php/rang/Rang.php";
$rang = new Rang($_SESSION['Rang'], $pdo);


?>
<p>Willkommen im Projeckt</p>
