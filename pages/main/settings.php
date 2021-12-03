<?php
session_start();
$overPath = "../../";

if(!isset($_SESSION["Login"])){
    ?>
    <script>
        location.href = "index.php";
    </script>
    <?php
    exit();
}

//anzeige werte
$id = -1;
$email = "-";
$name = "-";

// rang
include_once "../../php/sql/connection.php";
include_once "../../php/rang/Rang.php";
$rang = new Rang($_SESSION['Rang'], $pdo);

$sth = $pdo->prepare("SELECT * FROM user WHERE ID = ? LIMIT 1");
$sth->bindParam(1, $_SESSION['ID']);
$sth->execute();

foreach ($sth->fetchAll() as $row) {
    $id = $row["ID"];
    $email = $row["Email"];
    $name = $row["Name"];
}

?>
<link href="css/page_settings.css" rel="stylesheet">
<div id="settings_warpper">
    <h1 class="Headline">User - Einstellungen</h1>
    <h6 class="Headline_subtest" >An dieser Stelle kannst du deinen Account verwalten.</h6>

    <!-- Einstellungs Kästen-->
    <div class="Container_Setting">
        <p class="Container_Headline">Account-Daten</p>
        <p class="Container_Headline_subtext">Hier kannst du alle deine daten abändern</p>

        <div class="alert alert-success alert-success-settings" role="alert">
            A simple success alert—check it out!
        </div>

        <div class="mb-2 fild">
            <input disabled type="number" class="form-control" id="0" value="<?php echo $id; ?>">
        </div>

        <div class="mb-2 fild">
            <input disabled type="text" class="form-control" id="1" value="<?php echo $email; ?>">
        </div>

        <div  class="mb-2 fild">
            <input  type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $name; ?>">
        </div>

        <br/>
        <br/>
    </div>

    <div class="Container_Setting">
        <p class="Container_Headline">Profiel Bild</p>
        <p class="Container_Headline_subtext">Hier kannst du dein Profiel Bild ändern</p>

        <div id="img_output" style="display: none" class="alert alert-success alert-success-settings" role="alert"></div>

        <p id="pb_settings_container" class="Container_Headline_subtext">
            <?php
                $loadPgClasses = "img-thumbnail rounded";
                include "../../php/user/get/UserImage.php";
            ?>
        </p>

        <div class="mb-3 fild">
            <input onchange="saveImage(this, 'img_output', 'pb_settings_container')" class="form-control" type="file" id="formFile">
        </div>
        <br/>
        <br/>
    </div>

    <div class="Container_Setting">
        <p class="Container_Headline">Passwort ändern</p>
        <p class="Container_Headline_subtext">Hier kannst du dein Passwort ändern</p>

        <div  class="mb-2 fild">
            <input  type="password" class="form-control" id="2" placeholder="passwort">
        </div>

        <div  class="mb-2 fild">
            <input  type="password" class="form-control" id="3" placeholder="passwort wiederholen">
        </div>
        <br/>
        <br/>
    </div>

    <div style="" class="Container_Setting gefahr_setting_berich">
        <p class="Container_Headline">Bereich mit gefahr</p>
        <p style="color: white" class="Container_Headline_subtext">In diesem berich hast du alle gefährlichen einstellung</p>

        <button type="button" class="btn btn-dark gefahr_setting_button">Account Deaktiviren</button>
        <button type="button" class="btn btn-dark gefahr_setting_button">Account Löschen</button>

        <br/>
        <br/>
        <br/>
    </div>

    <!-- Enterferm wemm Footer das ist.-->
    <br/>
    <br/>
    <br/>

</div>



