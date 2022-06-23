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
        ?>

        <div class="menu_item">
            <div class="menu_icon">
                <i class="bi <?php echo $icon ?>"></i>
            </div>
            <div class="menu_text">
               <?php echo $name; ?>
            </div>
            <div class="menu_button_edit">
                <button class="button editButtonMenu">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
            <?php
                if($row["Standart"] == 1)  {
            ?>
            <div class="menu_button_stop">
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
