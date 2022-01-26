<?php
session_start();

$overPath = "../";
$id = null;
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
$default = false;
if(isset($_POST["id"])){
    //update
    $id =  $_POST["id"];

    $sth = $pdo->prepare("SELECT * FROM rang WHERE ID = ?");
    $sth->bindParam(1, $id);
    $sth->execute();

    $name = "";
    $color = "";
    $desc = "";

    $kat = "-";
    foreach($sth->fetchAll() as $row) {
        $name = $row["Name"];
        $color = $row["Color"];
        $desc = $row["Dscribe"];
        $default = $row["Isdefault"];
    }
}
?>
<link href="css/rang/rang.css" rel="stylesheet">
<link href="css/rang/rang_handy.css" rel="stylesheet">
<link href="css/rang/rang_tablet.css" rel="stylesheet">

<div class="headline_conatiner" >
    Rollen bearbeiten
</div>

<div class="page_main" >
    <input <?php if($id != null) echo "value='$name'";?> <?php if($default) echo "disabled" ?> type="text" placeholder="Name" id="name" class="input_fild_normal">
    <input <?php if($id != null) echo "value='".str_replace("#", "", $color)."'";?> id="color" type="text" placeholder="Farbe [in Hexadezimal]" class="input_fild_normal">

    <textarea id="beschreibung" class="input_fild_normal input_fild_normal_textarea" rows="4" placeholder="Beschreibung"><?php if($id != null) echo "$desc";?></textarea>

    <div class="permissionFlexConatiner">
    <?php

    if($id == null){
        $sth = $pdo->prepare("SELECT * FROM rang_permission ORDER BY Kategorie");
    }else {
        $sth = $pdo->prepare("SELECT * FROM rang_permission,rang_permission_syc WHERE rang_permission_syc.Permission = rang_permission.ID
                                                    AND rang_permission_syc.Rang = ? ORDER BY Kategorie");
        $sth->bindParam(1, $id);
    }
    $sth->execute();

    $kat = "-";
    foreach($sth->fetchAll() as $row) {
    if($kat == "-"){
             ?>
                    <div class="permissionBlock">
                    <p class="permissionTitle"><?php echo $row["Kategorie"]; ?></p>
            <?php
            $kat = $row["Kategorie"];
    }

        if($kat != $row["Kategorie"]){
            ?>
                </div>
                <div class="permissionBlock">
                <p class="permissionTitle"><?php echo $row["Kategorie"]; ?></p>
            <?php
            $kat = $row["Kategorie"];
        }

        ?>
            <p class="permissionConatiner"><input id="<?php echo $row["Permission"]; ?>" <?php if($id != null && $row["Haspermission"]) echo "checked='true'" ?> class="permissiomCheckbox permission" type="checkbox" > <?php echo $row["Dscribe"]; ?></p>
    <?php
    }
    ?>
            </div>
    </div>


        <?php if($id == null) {?><button onclick="addRang(document.getElementById('name').value, document.getElementById('beschreibung').value, document.getElementById('color').value)" class="button buttonSave">Speichern</button><?php }?>
        <?php if($id != null) {?><button onclick="updateRang(document.getElementById('name').value, document.getElementById('beschreibung').value, <?php echo $id?> , document.getElementById('color').value)" class="button buttonSave">Ändern</button><?php }?>


    <span id="output"></span>
    </div>
</div>
