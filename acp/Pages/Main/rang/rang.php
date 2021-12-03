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
//
//Permission abfrage!

?>

<div class="headline_conatiner" >
    Rollen
</div>

<div class="page_main" >
    <?php

    $sth = $pdo->prepare("SELECT * FROM rang");
    $sth->execute();

    foreach($sth->fetchAll() as $row) {
        ?>
        <!--ondrop="drop(event)" ondragover="allowDrop(event)" -->
        <div ondragstart="dragstart(event)" ondrop="drop(event)" ondragover="allowDrop(event)"  class="rangUbersichtConatiner" draggable="true">
                <i class="bi bi-grid-3x3-gap-fill rangUbersichtMoveItem"></i>
                <button class="rangUbersichtName " style="background-color: <?php echo $row["BackgroundColor"]?>;color: <?php echo $row["Color"]?>;"><?php echo $row["Name"] . "<br/>"; ?></button>

                <span class="rangUbersichtUserZahl"> 1 <i class="bi bi-person"></i></span>
                <i class="rangUbersichtDscribe"><?php echo substr($row["Dscribe"], 0, 50);  if(strlen($row["Dscribe"]) >= 51) echo " [...]"; ?></i>

               <?php if(!$row["Isdefault"]){ ?> <button onclick="delRank(<?php echo $row["ID"];?>)" class="button buttonEdit"><i class="bi bi-x-circle"></i></button> <?php } ?>
                <button class="button buttonDelete"><i class="bi bi-pencil"></i></button>
                <!-- <button onclick="loadMainPage('rang/rangCreate.php')" class="button buttonAdd"><i class="bi bi-plus-circle"></i></button> -->
            </div>
        <?php
    }
    ?>
    <button onclick="loadMainPage('rang/rangCreate.php')" class="button buttonSave">Neuen Rang</button>
</div>