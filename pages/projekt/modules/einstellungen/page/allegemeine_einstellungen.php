<?php
session_start();

include "../../../../../php/sql/connection.php";
include "../../rang/projektRang.php";
include_once "../../../../../php/rang/Rang.php";

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
$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo)

//TDDO: Permission überarbeiten!
?>
<div class="headline_conatiner" >
    Allgemeine Einstellungen
</div>

<link href="pages/projekt/modules/einstellungen/css/unterseiten/Main.css" rel="stylesheet">
<link href="pages/projekt/modules/einstellungen/css/unterseiten/Main_handy.css" rel="stylesheet">

<div class="page_main page_main_scroll_hidden" >
    <input <?php if(!$prang->hasPermission("setting.name") && !$rang->hasPermission("all.setting.name")) echo "disabled"?> oninput="setNewProjektName(this.value, <?php echo $_SESSION["projekt.aktiv"]; ?>)"  value="<?php echo $name; ?>" type="text" placeholder="Name" id="name" class="input_fild_normal">
    <input <?php if(!$prang->hasPermission("setting.kurzel") && !$rang->hasPermission("all.setting.kurzel")) echo "disabled"?> oninput="setNewProjektKurzel(this.value, <?php echo $_SESSION["projekt.aktiv"]; ?>)" type="text" placeholder="Kürzel" id="kurzel" class="input_fild_normal"  value="<?php echo $kurzel; ?>">

    <textarea <?php if(!$prang->hasPermission("setting.beschreibung") && !$rang->hasPermission("all.setting.beschreibung")) echo "disabled"?> id="beschreibung" class="input_fild_normal input_fild_normal_textarea" rows="4" placeholder="Beschreibung" oninput="setNewProjektBeschreibung(this.value, <?php echo $_SESSION["projekt.aktiv"]; ?>)"><?php echo $beschreibung; ?></textarea>


    <?php if($prang->hasPermission("setting.bild") || $rang->hasPermission("all.setting.bild")){ ?>
    <div class="drop-zone">
        <span class="drop-zone_prompt">Bild ablegen</span>
        <input onchange="setNewProjektImg(this, <?php echo $_SESSION["projekt.aktiv"]; ?>);" type="file" class="drop-zone__input">
    </div>
    <?php
    }

    if ($prang->hasPermission("setting.delete") || $rang->hasPermission("all.setting.delete")){ ?>
    <button onclick="deleteProjekt(<?php echo $_SESSION["projekt.aktiv"]; ?>)" class="button buttonDeleteProjekt">Löschen</button>
    <?php
    }
    ?>

    <div class="feedback_hub" id="feedback_hub">Feedback</div>
</div>
