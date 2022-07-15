<?php
session_start();

include "../../../../../php/sql/connection.php";
include "../../rang/projektRang.php";
include_once "../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

if(!($prang->hasPermission("report.menu") || $rang->hasPermission("all.report.menu"))){
    exit();
}


?>
<link href="pages/projekt/modules/meldung/css/unterseiten/beitrage.css" rel="stylesheet">

<div class="page_main" >
    <div class="flex-conatiner">
        <?php
        $sqlstr = "SELECT * FROM projekt_melden WHERE Modul = 4 AND Kategorie = 'Beitrag'";
        $sth = $pdo->prepare($sqlstr);
        $sth->execute();

        foreach($sth->fetchAll() as $row) {
            ?>
            <div class="flex-item">
                <?php
                $loadPgClasses = "beitrag_bild";
                $loadPgOnClick = "";
                $outputpfad = "";
                $bid =  intval($row["User"], 10);
                include "../../../../../php/user/get/UserImage.php";
                ?>
                <span><?php echo str_replace("<br>", " ", $row["Grund"]) ?></span>

                <div class="button_conatiner">
                    <button class="button">
                        <i class="bi bi-brush"></i>
                    </button>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</div>



