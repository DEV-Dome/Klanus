<?php
session_start();

include "../../../../../php/sql/connection.php";
include "../../rang/projektRang.php";
include_once "../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

if(!$prang->hasPermission("setting.see.menu") && !$rang->hasPermission("all.setting.see.menu")) {
    return;
}
?>
<div class="headline_conatiner" >
    Menü Einstellungen
</div>

<link href="pages/projekt/modules/einstellungen/css/unterseiten/menu/Main.css" rel="stylesheet">
<link href="pages/projekt/modules/einstellungen/css/unterseiten/menu/Main_handy.css" rel="stylesheet">

<div class="page_main " >
    <div class="menu_container">

        <?php
        $sth = $pdo->prepare("SELECT * FROM projekt_setting_menubar,modul WHERE modul.ID = Modul AND Projekt  = ? ORDER BY Prioritat");
        $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
        $sth->execute();

        foreach ($sth->fetchAll() as $row) {
            $name = $row["DisplayName"];
            $icon = $row["Icon"];
            $prioritat = $row["Prioritat"];
        ?>

        <div class="menu_item" data-fromid="<?php echo $prioritat ?>" draggable="true" ondragover="dragover(event)" ondrop="drop(event)" ondragstart="dragstart(event)">
            <div class="menu_icon" data-fromid="<?php echo $prioritat ?>">
                <i class="bi <?php echo $icon ?>"></i>
            </div>
            <div class="menu_text" data-fromid="<?php echo $prioritat ?>">
               <?php echo $name; ?>
            </div>
            <div class="menu_button_edit" data-fromid="<?php echo $prioritat ?>">
                <button class="button editButtonMenu">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
            <?php
                if($row["Standart"] == 1)  {
            ?>
            <div class="menu_button_stop" data-fromid="<?php echo $prioritat ?>">
                <button class="button stopButtonMenu">
                    <i class="bi bi-slash-circle"></i>
                </button>
            </div>
            <?php
                }
            ?>
        </div>
        <?php
        }
        ?>

    </div>
</div>
<!-- include JS-->
<?php

?>
<script>

    test();
</script>