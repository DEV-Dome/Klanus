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
    Rollen bearbeiten
</div>

<div class="page_main" >
    <input type="text" placeholder="Name" id="name" class="input_fild_normal">
    <input id="color" type="text" placeholder="Farbe [in Hexadezimal]" class="input_fild_normal">

    <textarea id="beschreibung" class="input_fild_normal input_fild_normal_textarea" rows="4" placeholder="Beschreibung"></textarea>

    <div class="permissionFlexConatiner">
    <?php

    $sth = $pdo->prepare("SELECT * FROM rang_permission ORDER BY Kategorie");
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
            continue;
        }

        ?>
            <p class="permissionConatiner"><input class="permissiomCheckbox permission" type="checkbox" > <?php echo $row["Dscribe"]; ?></p>
    <?php
    }
    ?>
            </div>
    </div>


        <button onclick="addRank(document.getElementById('name').value, document.getElementById('beschreibung').value, document.getElementById('color').value)" class="button buttonSave">Speichern</button>
        <span id="output"></span>
    </div>
</div>
