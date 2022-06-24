<?php
session_start();

include "../../../../../php/sql/connection.php";
include "../../rang/projektRang.php";
include_once "../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);
$pid = $_SESSION["projekt.aktiv"];
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
        $sth = $pdo->prepare("SELECT *,projekt_setting_menubar.ID AS 'mid' FROM projekt_setting_menubar,modul WHERE modul.ID = Modul AND Projekt  = ? ORDER BY Prioritat");
        $sth->bindParam(1, $pid);
        $sth->execute();

        foreach ($sth->fetchAll() as $row) {
            $name = $row["DisplayName"];
            $icon = $row["Icon"];
            $prioritat = $row["Prioritat"];
            $disabled = $row["IsDisabled"];

            $id = $row["mid"];
            //TODO nur drag and DROP wenn man auch die rechte hat
        ?>

        <div class="menu_item" data-fromid="<?php echo $prioritat ?>" draggable="true" ondragleave="menu_ondragleave(event)" ondragover="menu_dragover(event);" ondrop="drop(event)" ondragstart="dragstart(event)" >
            <div class="menu_icon" data-fromid="<?php echo $prioritat ?>">
                <i <?php if($disabled) echo "style='color: red;'" ?> data-fromid="<?php echo $prioritat ?>" class="bi <?php echo $icon ?>"></i>
            </div>
            <div class="menu_text" data-fromid="<?php echo $prioritat ?>">
               <?php echo $name; ?>
            </div>
            <div onclick="show_edit_bereich('editbereich_<?php echo $id?>', 'editButtonMenu_<?php echo $id?>')" class="menu_button_edit" data-fromid="<?php echo $prioritat ?>">
                <button class="button editButtonMenu" id="editButtonMenu_<?php echo $id?>">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
            <?php
                if($row["Standart"] == 0)  {
                    if($disabled == 0){
                        //button zum ausbleden
                        ?>
                        <div class="menu_button_stop" data-fromid="<?php echo $prioritat ?>">
                            <button class="button stopButtonMenu" onclick="set_menu_eintrag_disabled(<?php echo $id ?>, <?php echo $pid ?>)">
                                <i class="bi bi-slash-circle"></i>
                            </button>
                        </div>
                        <?php
                    }else {
                        //button zum einblednen
                        ?>
                        <div class="menu_button_stop" data-fromid="<?php echo $prioritat ?>">
                            <button class="button renewButtonMenu" onclick="set_menu_eintrag_no_disabled(<?php echo $id ?>, <?php echo $pid ?>)">
                                <i class="bi bi-check-circle"></i>
                            </button>
                        </div>
                        <?php
                    }
                }
            ?>
            <div class="editbereich" id="editbereich_<?php echo $id?>">
                 <span class="editbereich_text">Menu-Name:</span>
                <input value="<?php echo $name; ?>" type="text" placeholder="Name" id="name" class="input_fild_normal">
            </div>
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