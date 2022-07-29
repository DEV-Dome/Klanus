<?php
session_start();
$overPath = "../../../../../";

include "../../../../../php/sql/connection.php";
include "../../rang/projektRang.php";
include_once "../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

if(!($prang->hasPermission("report.menu") || $rang->hasPermission("all.report.menu"))){
    exit();
}


?>
<link href="pages/projekt/modules/meldung/css/unterseiten/Beitrage.css" rel="stylesheet">
<link href="pages/projekt/modules/meldung/css/unterseiten/Beitrag_handy.css" rel="stylesheet">

<div class="headline_conatiner" >
    Gemeldete Forum Beiträge
</div>

<div class="page_main" >
    <div class="flex-conatiner">
        <?php
        $sqlstr = "SELECT *,User.ID AS 'userID' FROM projekt_melden,user,projekt_user WHERE projekt_user.Projekt = ? AND projekt_user.User = projekt_melden.User AND projekt_melden.User = user.ID AND  Modul = 4 AND Kategorie = 'Beitrag'";
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
        $sth->execute();

        foreach($sth->fetchAll() as $row) {
            $local_projeckt_rang = new projektRang($row["Rang"], $pdo);
            ?>
            <div class="flex-item">
                <span class="flex-item-user-container">
                    <?php
                    $loadPgClasses = "beitrag_bild";
                    $loadPgOnClick = "";
                    $outputpfad = "";
                    $bid =  intval($row["userID"], 10);
                    include "../../../../../php/user/get/UserImage.php";
                    ?>
                   <span class="flex-item-user-name" style="color: <?php echo $local_projeckt_rang->color; ?>;"><?php echo ucfirst($row["Name"]) ?></span>
                </span>
                <span class="flex-item-grund"><?php echo str_replace("<br>", " ", $row["Grund"]) ?></span>

                <div class="button_conatiner">
                    <button class="button_new button button_color_green">
                        <i class="bi bi-check-circle"></i>
                    </button>

                    <button class="button_new button button_color_blue">
                        <i class="bi bi-reply"></i>
                    </button>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</div>



