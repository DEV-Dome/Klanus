<?php
session_start();
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

<link href="pages/projekt/modules/einladungen/css/main.css" rel="stylesheet">
<link href="pages/projekt/modules/einladungen/css/main_handy.css" rel="stylesheet">

<div class="headline_conatiner" >
    Einladungen verwaltung  <button class="button addbutton">Neue Einladung</button>
</div>

<div class="page_main" >
    <?php
    $sth = $pdo->prepare("SELECT *,user.ID AS 'Uid'  FROM projekt_einladungen,user WHERE user.ID = projekt_einladungen.User AND Projekt = ?");
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
                $bid =  intval($row["Uid"], 10);
                include "../../../../php/user/get/UserImage.php";
            ?>
            <i class="UserText"><?php echo $row["Name"] ?></i>
           <i class="einladungsText"><?php echo $row["Einladung"] ?></i>

            <button class="button deleteButton"><i class="bi bi-x-circle"></i></button>
        </div>

        <?php
    }
    ?>
</div>