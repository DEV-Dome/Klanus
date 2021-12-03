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


<h1 style='margin-top: 5vh; text-align: center;'>Willkommen <span id="willkommenName"> <?php echo $_SESSION['Name'] ?></span></h1>
