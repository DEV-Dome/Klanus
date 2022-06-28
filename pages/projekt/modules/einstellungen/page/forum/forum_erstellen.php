<?php
session_start();

include "../../../../../../php/sql/connection.php";
include "../../../rang/projektRang.php";
include_once "../../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);
$kid = $_GET["kid"];

$update = false;
$rang_1 = -1;
$rang_2 = -1;
$rang_3 = -1;
$rang_4 = -1;

if(isset($_GET["id"])){
    $update = true;
    $id = $_GET["id"];
    if(!$prang->hasPermission("forum.setting.forum.edit") && !$rang->hasPermission("all.forum.setting.forum.edit")) {
        return;
    }

    $name = "";
    $bkommentar = "";
    $beschreibung = "";


    $sqlstr = "SELECT *  FROM projekt_forum_forn WHERE ID = $id ";
    $sth = $pdo->prepare($sqlstr);
    $sth->execute();

    foreach($sth->fetchAll() as $row) {
        $name = $row["Name"];
        $bkommentar = $row["BeitragKommentar"];
        $beschreibung = $row["Beschreibung"];

        $rang_1 = $row["KannSehen"];
        $rang_2 = $row["KannSehenBeitrage"];
        $rang_3 = $row["KannSehenBeitrageOnly"];
        $rang_4 = $row["KannschreibenBeitrage"];
    }

}else {
    if(!$prang->hasPermission("forum.setting.forum.add") && !$rang->hasPermission("all.forum.setting.forum.add")) {
        return;
    }
}

?>
<div class="headline_conatiner" >
    <span class="headline_text">Forum Erstellen</span>
</div>

<link href="pages/projekt/modules/einstellungen/css/unterseiten/forum/Main.css?v=<?php echo time() ?>" rel="stylesheet">
<link href="pages/projekt/modules/einstellungen/css/unterseiten/forum/Main_handy.css?v=<?php echo time() ?>" rel="stylesheet">

<div class="page_main " >
    <input  <?php if($update) echo "value='$name'" ?> type="text" placeholder="Name" id="name" class="input_fild_normal">

    <input  <?php if($update) echo "value='$bkommentar'" ?> type="text" placeholder="Beitragskommentar" id="bkommentar" class="input_fild_normal">

    <textarea placeholder="Beschreibung" id="beschreibung"  class="input_fild_normal input_fild_normal_textarea"> <?php if($update) echo "$beschreibung" ?></textarea>

    <div class="hinweis">
        Bitte wähle hier einen Rang aus deinem Projekt aus der mindestens vorhanden seinen muss um folgende aktionen auszuführen. Dann können diese Ränge und alle die Darüber angeordnet sind die aktionen ausführen.
    </div>

    <select style="margin-top: 0%" id="rang_1" class="input_fild_normal">

        <?php
        $sqlstr = "SELECT *  FROM projekt_rang WHERE Projekt = ? ORDER BY Prioritat DESC ";
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
        $sth->execute();

        $nosel = false;
        foreach($sth->fetchAll() as $row) {
            if($rang_1 == $row["ID"]){
                echo "<option selected value='{$row["ID"]}'>{$row["Name"]}</option>";
                $nosel = true;
            }else {
                echo "<option value='{$row["ID"]}'>{$row["Name"]}</option>";
            }

        }
        ?>
        <option <?php if(!$nosel) echo "selected" ?> disabled value="-1">Wer kann das Forum sehen ?</option>
    </select>

    <select  id="rang_2" class="input_fild_normal">

        <?php
        $sqlstr = "SELECT *  FROM projekt_rang WHERE Projekt = ? ORDER BY Prioritat DESC ";
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
        $sth->execute();

        $nosel = false;
        foreach($sth->fetchAll() as $row) {
            if($rang_2 == $row["ID"]){
                echo "<option selected value='{$row["ID"]}'>{$row["Name"]}</option>";
                $nosel = true;
            }else {
                echo "<option value='{$row["ID"]}'>{$row["Name"]}</option>";
            }

        }
        ?>
        <option <?php if(!$nosel) echo "selected" ?> disabled value="-1">Wer kann das Forum sehen ?</option>
    </select>

    <select  id="rang_3" class="input_fild_normal">

        <?php
        $sqlstr = "SELECT *  FROM projekt_rang WHERE Projekt = ? ORDER BY Prioritat DESC ";
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
        $sth->execute();

        $nosel = false;
        foreach($sth->fetchAll() as $row) {
            if($rang_3 == $row["ID"]){
                echo "<option selected value='{$row["ID"]}'>{$row["Name"]}</option>";
                $nosel = true;
            }else {
                echo "<option value='{$row["ID"]}'>{$row["Name"]}</option>";
            }

        }
        ?>
        <option <?php if(!$nosel) echo "selected" ?> disabled value="-1">Wer kann das Forum sehen ?</option>
    </select>

    <select id="rang_4" class="input_fild_normal">

        <?php
        $sqlstr = "SELECT *  FROM projekt_rang WHERE Projekt = ? ORDER BY Prioritat DESC ";
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
        $sth->execute();

        $nosel = false;
        foreach($sth->fetchAll() as $row) {
            if($rang_4 == $row["ID"]){
                echo "<option selected value='{$row["ID"]}'>{$row["Name"]}</option>";
                $nosel = true;
            }else {
                echo "<option value='{$row["ID"]}'>{$row["Name"]}</option>";
            }

        }
        ?>
        <option <?php if(!$nosel) echo "selected" ?> disabled value="-1">Wer kann das Forum sehen ?</option>
    </select>

    <div class="feedback_hub" style="margin-top: 1%!important; margin-bottom: 1%; width: 92% !important;" id="feedback_hub">Feedback</div>

    <div class="create_button_conatiner">
        <button onclick="loadProjektUnderPage('einstellungen', 'forum/forum_einstellungen.php')" class="button_forum back_kategorie" style="">Zurück</button>

      <?php if(!$update) { ?>  <button onclick="create_forum(document.getElementById('name').value, document.getElementById('beschreibung').value, <?php echo $kid; ?>,document.getElementById('bkommentar').value, document.getElementById('rang_1').value,document.getElementById('rang_2').value, document.getElementById('rang_3').value, document.getElementById('rang_4').value)" class="button_forum edit_kategorie" style="">Erstellen</button><?php } ?>
      <?php if($update) { ?>  <button onclick="update_forum(document.getElementById('name').value, document.getElementById('beschreibung').value, <?php echo $kid; ?>,document.getElementById('bkommentar').value, document.getElementById('rang_1').value,document.getElementById('rang_2').value, document.getElementById('rang_3').value, document.getElementById('rang_4').value, <?php echo $id ?>)" class="button_forum edit_kategorie" style="">Bearbeiten</button> <?php } ?>
    </div>

</div>
