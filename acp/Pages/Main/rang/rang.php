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
if(!$rang->hasPermission("rang.overview")){
    exit("not permission");
}

?>
<link href="css/rang/rang.css" rel="stylesheet">
<link href="css/rang/rang_handy.css" rel="stylesheet">
<link href="css/rang/rang_tablet.css" rel="stylesheet">

<div class="headline_conatiner" >
    Rollen
</div>

<div class="page_main" >
    <?php

    $sth = $pdo->prepare("SELECT * FROM rang ORDER BY Prioritat DESC");
    $sth->execute();

    foreach($sth->fetchAll() as $row) {
        $sth = $pdo->query("SELECT * FROM user WHERE Rang = ". $row["ID"]);
        ?>
        <div id="<?php echo $row["ID"];?>" ondragstart="dragstart(event)" ondrop="drop(event)" ondragover="allowDrop(event)" draggable="true" class="rangUbersichtConatiner">
                <i  id="<?php echo $row["ID"];?>" class="bi bi-grid-3x3-gap-fill rangUbersichtMoveItem dragtaget"></i>
                <button class="rangUbersichtName " style="background-color: <?php echo $row["BackgroundColor"]?>;color: <?php echo $row["Color"]?>;"><?php echo $row["Name"] . "<br/>"; ?></button>

                <span class="rangUbersichtUserZahl"> <?php echo $sth->rowCount() ?> <i class="bi bi-person"></i></span>
                <i class="rangUbersichtDscribe"><?php echo substr($row["Dscribe"], 0, 50);  if(strlen($row["Dscribe"]) >= 51) echo " [...]"; ?></i>

            <button onclick="loadMainPage('rang/rangCreate.php', <?php echo $row["ID"]; ?>)" class="button buttonDelete"><i class="bi bi-pencil"></i></button>
            <?php if(!$row["Isdefault"]){ ?> <button onclick="delRank(<?php echo $row["ID"];?>)" class="button buttonEdit"><i class="bi bi-x-circle"></i></button> <?php } ?>
        </div>
        <?php
    }
    ?>
    <button onclick="loadMainPage('rang/rangCreate.php')" class="button buttonSave">Erstellen</button>
    <span id="output"></span>
</div>