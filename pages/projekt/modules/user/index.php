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
include "../../../../php/sql/connection.php";
?>

<link href="pages/projekt/modules/user/css/main.css" rel="stylesheet">
<link href="pages/projekt/modules/user/css/main_handy.css" rel="stylesheet">
<link href="pages/projekt/modules/user/css/main_tablet.css" rel="stylesheet">

<div class="headline_conatiner" >
    <span class="headline-text" >User verwaltung</span>
</div>

<div class="page_main" >
    <?php
    $sqlstr = "SELECT *,user.Name AS 'uname',projekt_rang.Name AS 'rname' FROM projekt_user,projekt_rang,user WHERE user.ID = projekt_user.User AND projekt_rang.ID = projekt_user.Rang AND projekt_user.Projekt = ? ORDER BY projekt_user.IsOwner DESC,projekt_rang.Prioritat DESC";
    $sth = $pdo->prepare($sqlstr);
    $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
    $sth->execute();

    foreach($sth->fetchAll() as $row) {
        ?>
        <div class="item_container">
            <!-- Profiel Bild-->
            <?php
            $loadPgClasses = "userListeBild";
            $loadPgOnClick = "";
            $outputpfad = "";
            $bid =  intval($row["User"], 10);
            include "../../../../php/user/get/UserImage.php";
            ?>
            <i class="UserText"><?php echo $row["uname"] ?></i>

            <button class="userUbersichtRang" style="background-color: <?php echo $row["BackgroundColor"]?>;color: <?php echo $row["Color"]?>;"><?php echo $row["rname"] . "<br/>"; ?></button>

            <button onclick="" class="button deleteButton"><i class="bi bi-person-dash"></i></button>
            <button onclick="" class="button infoButton"><i class="bi bi-info-circle"></i></button>
        </div>

        <?php
    }
    ?>
</div>