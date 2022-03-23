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


include "../../../../../php/sql/connection.php";
if(isset($_GET["id"])){

    $id = $_GET["id"];

    $sth = $pdo->prepare("SELECT * FROM projekt_rang WHERE ID = ?");
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
}else{
    $id = null;
}

?>

<link href="acp/css/rang/rang.css" rel="stylesheet">
<link href="acp/css/rang/rang_handy.css" rel="stylesheet">
<link href="acp/css/rang/rang_tablet.css" rel="stylesheet">

<div class="headline_conatiner" >
    Rang Erstellen
</div>

<div class="page_main" >
    <input <?php if($id != null) echo "value='$name'"?> type="text" placeholder="Name" id="name" class="input_fild_normal">
    <input  <?php if($id != null) echo "value='".str_replace("#", "", $color)."'"; ?>id="color" type="text" placeholder="Farbe [in Hexadezimal]" class="input_fild_normal">

    <textarea id="beschreibung" class="input_fild_normal input_fild_normal_textarea" rows="4" placeholder="Beschreibung"><?php if($id != null) echo $desc; ?></textarea>

    <div class="permissionFlexConatiner">
        <?php

        if($id == null){
            $sth = $pdo->prepare("SELECT * FROM projekt_rang_permission ORDER BY Kategorie");
        }else {
            $sth = $pdo->prepare("SELECT * FROM projekt_rang_permission,projekt_rang_permission_syc WHERE projekt_rang_permission_syc.Permission = projekt_rang_permission.ID
                                                    AND projekt_rang_permission_syc.Rang = ? ORDER BY Kategorie");
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

    <div class="feedback_hub" id="feedback_hub">Feedback</div>

    <?php if($id == null) {?><button onclick="addRang(document.getElementById('name').value, document.getElementById('beschreibung').value, document.getElementById('color').value)" class="button buttonSave">Speichern</button><?php }?>
    <?php if($id != null) {?><button onclick="updateRang(document.getElementById('name').value, document.getElementById('beschreibung').value, <?php echo $id?> , document.getElementById('color').value)" class="button buttonSave">Ändern</button><?php }?>



</div>
</div>
