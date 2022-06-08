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
include "../rang/projektRang.php";
include_once "../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo)
?>
<link href="acp/css/rang/rang.css" rel="stylesheet">
<link href="acp/css/rang/rang_handy.css" rel="stylesheet">
<link href="pages/projekt/modules/rang/css/main.css" rel="stylesheet">

<div class="headline_conatiner" >
    Rang verwaltung  <?php if($prang->hasPermission("rang.new") || $rang->hasPermission("all.rang.new")) { ?> <button onclick="loadProjektUnderPage('rang', 'createRang.php')" class="rangUbersichtName newRangButton" style="">Neuen Rang</button><?php } ?>
</div>

<div class="page_main" >
    <?php

    $sth = $pdo->prepare("SELECT * FROM projekt_rang WHERE Projekt =" .$_SESSION["projekt.aktiv"]. " ORDER BY Prioritat DESC");
    $sth->execute();
    foreach($sth->fetchAll() as $row) {
        //$sth = $pdo->query("SELECT * FROM user WHERE Rang = ". $row["ID"]);
        ?>
        <div id="<?php echo $row["ID"];?>" ondragstart="dragstart(event)" ondrop="drop(event)" ondragover="allowDrop(event)" draggable="true" class="rangUbersichtConatiner">

            <?php if($prang->hasPermission("rang.posistion") || $rang->hasPermission("all.rang.posistion")) { ?>
            <i  id="<?php echo $row["ID"];?>" class="bi bi-grid-3x3-gap-fill rangUbersichtMoveItem dragtaget"></i>
            <?php  }?>
            <button class="rangUbersichtName " style="background-color: <?php echo $row["BackgroundColor"]?>;color: <?php echo $row["Color"]?>;"><?php echo substr($row["Name"], 0,15) . "<br/>"; ?></button>

            <span class="rangUbersichtUserZahl"> 0 <i class="bi bi-person"></i></span>
            <i class="rangUbersichtDscribe"><?php echo substr($row["Dscribe"], 0, 50);  if(strlen($row["Dscribe"]) >= 51) echo " [...]"; ?></i>

            <?php if($prang->hasPermission("rang.name") || $prang->hasPermission("rang.farbe") ||
            $prang->hasPermission("rang.beschreibung") || $prang->hasPermission("rang.permission") ||
                $rang->hasPermission("all.rang.name") || $rang->hasPermission("all.rang.farbe") ||
                $rang->hasPermission("all.rang.beschreibung") || $rang->hasPermission("all.rang.permission")
            ) { ?>
            <button onclick="loadProjektUnderPage('rang', 'createRang.php?id=<?php echo $row["ID"]?>')" class="button buttonDelete buttonDeleteFrontEnd"><i class="bi bi-pencil"></i></button>
            <?php }?>

            <?php if(!$row["Isdefault"]){ ?>
            <?php if($prang->hasPermission("rang.delete") || $rang->hasPermission("all.rang.delete")) { ?>
                <button onclick="delRank(<?php echo $row["ID"];?>)" class="button buttonEdit buttonDeleteFrontEnd"><i class="bi bi-x-circle"></i></button>
            <?php } }?>
        </div>
        <?php
    }
    ?>
</div>