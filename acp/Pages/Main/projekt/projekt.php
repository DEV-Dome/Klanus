<?php
session_start();

$overPath = "../";
if(!isset($_SESSION["Login"])){
    ?>
    <script>
        location.href = "../index.php";
    </script>
    <?php
    exit();
}

// rang
include_once "../../../../php/sql/connection.php";
include_once "../../../../php/rang/rang.php";
$rang = new Rang($_SESSION['Rang'], $pdo);

if(!$rang->hasPermission("user.overview")){
    exit("not permission");
}

?>
<link href="css/rang/rang.css" rel="stylesheet">
<link href="css/rang/rang_handy.css" rel="stylesheet">
<link href="css/rang/rang_tablet.css" rel="stylesheet">

<div class="headline_conatiner" >
    Projekte
</div>

<div class="page_main" >

</div>