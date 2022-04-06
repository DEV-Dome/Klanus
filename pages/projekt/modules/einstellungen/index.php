<?php
session_start();

include "../../../../php/sql/connection.php";
$sth = $pdo->prepare("SELECT * FROM projekt WHERE ID = ? LIMIT 1");
$sth->bindParam(1, $_SESSION["projekt.aktiv"]);
$sth->execute();

$name = "";
$kurzel = "";
$beschreibung = "";

foreach ($sth->fetchAll() as $row) {
    $name = $row["Name"];
    $kurzel = $row["Kurzel"];
    $beschreibung = $row["Beschreibung"];
}

?>
<div class="headline_conatiner" >
    Projekt Einstellungen
</div>

<link href="pages/projekt/modules/einstellungen/css/Main.css" rel="stylesheet">
<link href="pages/projekt/modules/einstellungen/css/Main_handy.css" rel="stylesheet">

<div class="page_main page_main_scroll_hidden" >
    <input onchange="setNewProjektName(this.value, <?php echo $_SESSION["projekt.aktiv"]; ?>)"  value="<?php echo $name; ?>" type="text" placeholder="Name" id="name" class="input_fild_normal">
    <input  onchange="setNewProjektKurzel(this.value, <?php echo $_SESSION["projekt.aktiv"]; ?>)" type="text" placeholder="Kürzel" id="kurzel" class="input_fild_normal"  value="<?php echo $kurzel; ?>">

    <textarea id="beschreibung" class="input_fild_normal input_fild_normal_textarea" rows="4" placeholder="Beschreibung" onchange="setNewProjektBeschreibung(this.value, <?php echo $_SESSION["projekt.aktiv"]; ?>)"><?php echo $beschreibung; ?></textarea>



    <div class="drop-zone">
        <span class="drop-zone_prompt">Bild ablegen</span>
        <input onchange="setNewProjektImg(this, <?php echo $_SESSION["projekt.aktiv"]; ?>);" type="file" class="drop-zone__input">
    </div>
    <button onclick="deleteProjekt(<?php echo $_SESSION["projekt.aktiv"]; ?>)" class="button buttonDeleteProjekt">Löschen</button>

    <div class="feedback_hub" id="feedback_hub">Feedback</div>
</div>
