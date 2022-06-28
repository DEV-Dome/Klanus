<?php
session_start();

include "../../../../../../php/sql/connection.php";
include "../../../rang/projektRang.php";
include_once "../../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);
$pid = $_SESSION["projekt.aktiv"];

$update = false;
if(isset($_GET["id"])){
    if(!$prang->hasPermission("forum.setting.kategorie.edit") && !$rang->hasPermission("forum.setting.kategorie.edit")) {
        return;
    }

    $update = true;

    $id = $_GET["id"];
    $name = "";
    $rang = -1;

    $sqlstr = "SELECT *  FROM projekt_forum_kategorien WHERE Id = $id ";
    $sth = $pdo->prepare($sqlstr);
    $sth->execute();

    foreach($sth->fetchAll() as $row) {
        $name = $row["Name"];
        $rang = $row["Rang"];
    }

}else {
    if(!$prang->hasPermission("forum.setting.kategorie.add") && !$rang->hasPermission("forum.setting.kategorie.add")) {
        return;
    }
}

?>
<div class="headline_conatiner" >
   <?php if(!$update) { ?> <span class="headline_text">Kategorie Erstellen</span> <?php } ?>
   <?php if($update) { ?> <span class="headline_text">Kategorie Bearbeiten</span> <?php } ?>
</div>

<link href="pages/projekt/modules/einstellungen/css/unterseiten/forum/Main.css?v=<?php echo time() ?>" rel="stylesheet">
<link href="pages/projekt/modules/einstellungen/css/unterseiten/forum/Main_handy.css?v=<?php echo time() ?>" rel="stylesheet">

<div class="page_main " >
    <input <?php if($update) echo "value='$name'" ?> type="text" placeholder="Name" id="name" class="input_fild_normal">

    <div class="hinweis">
        Bitte wähle hier einen Rang aus deinem Projekt aus der mindestens vorhanden seinen muss um diese Kategorie zu sehen. Dann können dieser Rang und alle die Darüber angeordnet sind die Kategorie sehen und betreten.
    </div>

    <select style="margin-top: 0%" id="rang" class="input_fild_normal">

        <?php
        $sqlstr = "SELECT *  FROM projekt_rang WHERE Projekt = ? ORDER BY Prioritat DESC ";
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
        $sth->execute();

        $nosel = false;
        foreach($sth->fetchAll() as $row) {
            if($rang == $row["ID"]){
                echo "<option selected value='{$row["ID"]}'>{$row["Name"]}</option>";
                $nosel = true;
            }else {
                echo "<option value='{$row["ID"]}'>{$row["Name"]}</option>";
            }
        }
        ?>
        <option <?php if(!$nosel) echo "selected"; ?> disabled value="-1">Bitte Rang wählen</option>
    </select>

    <div class="feedback_hub" style="margin-top: 1%!important; margin-bottom: 1%; width: 92% !important;" id="feedback_hub">Feedback</div>

    <div class="create_button_conatiner">
        <button onclick="loadProjektUnderPage('einstellungen', 'forum/forum_einstellungen.php')" class="button_forum back_kategorie" style="">Zurück</button>
        <?php if(!$update) { ?><button onclick="create_kategorie(document.getElementById('name').value, document.getElementById('rang').value)" class="button_forum edit_kategorie" style="">Erstellen</button><?php } ?>
        <?php if($update)  { ?><button onclick="edit_kategorie(document.getElementById('name').value, document.getElementById('rang').value, <?php echo $id; ?>)" class="button_forum edit_kategorie" style="">Bearbeiten</button><?php } ?>
    </div>


</div>
