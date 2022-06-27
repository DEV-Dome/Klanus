<?php
session_start();
include "../../sql/connection.php";
include "../../../pages/projekt/modules/rang/projektRang.php";
include_once "../../rang/Rang.php";

if(!isset($_SESSION["Login"])){
    $rang = new Rang(2, $pdo);
}else {
    $rang = new Rang($_SESSION['Rang'], $pdo);
    if(isset($_SESSION['PRang'])) $prang = new projektRang($_SESSION['PRang'], $pdo);
}

$isProjekt =  $_POST["projekt"];
$sth = "";

if($isProjekt == 1){
    $sth = $pdo->prepare("SELECT * FROM projekt_setting_menubar,modul WHERE modul.ID = Modul  AND Projekt  = ? AND IsDisabled = 0 ORDER BY Prioritat");
    $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
    $sth->execute();
    foreach ($sth->fetchAll() as $row) {
        if($row["permission"] != ""){
            if(!$prang->hasPermission($row["permission"]) && !$rang->hasPermission($row["permission"])) continue;
        }

        ?>
        <li <?php if($row["Ordner"] == "-"){?>
            onclick='joinProjekt(<?php echo $_SESSION["projekt.aktiv"]?>);'
        <?php } else  {?>
            onclick='loadProjektPage("<?php echo $row["Ordner"]?>");'
        <?php } ?> class="LeisteLinksPunkt"> <i class="bi <?php echo $row["Icon"]?>"></i> <?php echo $row["DisplayName"]?></li>
        <?php
    }
?>
    <li onclick='loadMainPage("user_dashboard.php"); loadbar(0)' class="LeisteLinksPunkt"><i class="bi bi-arrow-bar-left"></i> zurück</li>
    <li onclick="openbar()" class="LeisteLinksPunkt onlyMobile"><i class="bi bi-x-lg"></i> schlissen</li>
    <?php
}else {
    $sth = $pdo->prepare("SELECT * FROM modul WHERE IsProjekt = 0");
    $sth->execute();
    foreach ($sth->fetchAll() as $row) {
        if($row["permission"] != ""){
            if(!$prang->hasPermission($row["permission"]) && !$rang->hasPermission($row["permission"])) continue;
        }

        ?>
        <li <?php if($row["Ordner"] == "-" ) {?> onclick='loadMainPage("user_dashboard.php");' <?php } ?>class="LeisteLinksPunkt"><i class="bi <?php echo $row["Icon"]?>"></i> <?php echo $row["Name"]?></li>
        <?php
    }
    if(isset($_SESSION["Login"])){
        ?>

        <li onclick="loadMainPage('settings.php')" class="LeisteLinksPunkt onlyMobile"><i class="bi bi-gear"></i> Einstellungen</li>
        <li onclick="openbar()" class="LeisteLinksPunkt onlyMobile"><i class="bi bi-person-lines-fill"></i> Support</li>
        <li onclick="loadMainPage('logout.php'); location.reload();" class="LeisteLinksPunkt onlyMobile"><i class="bi bi-x-square"></i> Abmelden</li>
        <?php
    }else {
        ?>
        <li onclick="loadMainPage('login/login.php')"  class="LeisteLinksPunkt onlyMobile"><i class="bi bi-box-arrow-in-right"></i> Anmelden</li>
        <?php
    }
    ?>

    <li onclick="openbar()" class="LeisteLinksPunkt onlyMobile"><i class="bi bi-x-lg"></i> schlissen</li>
    <?php
}

