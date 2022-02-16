<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');

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

<link href="css/projekte/projekte_handy.css" rel="stylesheet">
<link href="css/projekte/projekte_tablet.css" rel="stylesheet">

<div class="headline_conatiner" >
    Projekte
</div>

<div class="page_main" >
    <?php

    $sth = $pdo->prepare("SELECT * FROM projekt ORDER BY ID ASC ");
    $sth->execute();
    foreach($sth->fetchAll() as $row) {
       ?>
        <div id="<?php echo $row["ID"];?>" class="rangUbersichtConatiner">
            <button class="rangUbersichtName " style="background-color: <?php echo $row["BackgroundColor"]?>;color: <?php echo $row["Color"]?>;"><?php echo $row["Name"] . "<br/>"; ?></button>

            <span class="rangUbersichtUserZahl" style="<?php if($row["Verifiziert"]){ echo "color: #14FF00 !important;"; }?>" ><i class="bi bi-check2-circle"></i></span>


            <i class="rangUbersichtDscribe"><?php echo substr($row["Beschreibung"], 0, 30);  if(strlen($row["Beschreibung"]) >= 31) echo " [...]"; ?></i>

            <button onclick="" class="button buttonDelete"><i class="bi bi-pencil"></i></button>
            <button onclick="" class="button buttonDelete"><i class="bi bi-patch-check"></i></button>
             <button onclick="" class="button buttonEdit under-button"><i class="bi bi-x-circle"></i></button>
             <button onclick="" class="button buttonEdit under-button"><i class="bi bi-person-x"></i></button>
        </div>
        <?php
    }
    ?>
</div>