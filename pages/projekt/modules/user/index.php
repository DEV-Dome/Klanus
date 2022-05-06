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
include "../rang/projektRang.php";
include_once "../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo)
?>

<link href="pages/projekt/modules/user/css/main.css" rel="stylesheet">
<link href="pages/projekt/modules/user/css/main_handy.css" rel="stylesheet">
<link href="pages/projekt/modules/user/css/main_tablet.css" rel="stylesheet">

<div class="headline_conatiner" >
    <span class="headline-text" >User verwaltung</span>
</div>

<div class="page_main" >
    <?php
    $sqlstr = "SELECT *,user.Name AS 'uname',projekt_rang.Name AS 'rname',projekt_user.Projekt AS 'pid',projekt_user.User AS 'uid'  FROM projekt_user,projekt_rang,user WHERE user.ID = projekt_user.User AND projekt_rang.ID = projekt_user.Rang AND projekt_user.Projekt = ? ORDER BY projekt_user.IsOwner DESC,projekt_rang.Prioritat DESC";
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
            <i class="UserText "><?php echo $row["uname"] ?></i>


            <button class="userUbersichtRang" style="background-color: <?php echo $row["BackgroundColor"]?>;color: <?php echo $row["Color"]?>;"><?php echo $row["rname"] . "<br/>"; ?></button>

            <?php if($prang->hasPermission("user.info") || $rang->hasPermission("all.user.info")) { ?><button onclick="loadProjektUnderPage('user', 'InfoUser.php?uid=<?php echo $row["uid"] ?>')" class="button infoButton"><i class="bi bi-info-circle"></i></button><?php } ?>
            <?php if($prang->hasPermission("user.kick") || $rang->hasPermission("all.user.kick")) { if(!$row["IsOwner"]){?><button onclick="kickUserFromProjeckt(<?php echo $row["uid"] ?>, <?php echo $row["pid"] ?>);" class="button deleteButton"><i class="bi bi-person-dash"></i></button><?php } } ?>
        </div>

        <?php
    }
    ?>
</div>