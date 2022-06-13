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
    $sth = $pdo->prepare("SELECT * FROM modul WHERE IsProjekt = 1");
}else {
    $sth = $pdo->prepare("SELECT * FROM modul WHERE IsProjekt = 0");
}

$sth->execute();
foreach ($sth->fetchAll() as $row) {
    if($row["permission"] != ""){
        if(!$prang->hasPermission($row["permission"]) && !$rang->hasPermission($row["permission"])) continue;

    }

    ?>
    <li <?php if($row["Ordner"] == "-" && $row["IsProjekt"] == false) {?>
        onclick='loadMainPage("userDashboard.php");'
    <?php } else if($row["Ordner"] == "-" && $row["IsProjekt"] == true){?>
        onclick='joinProjekt(<?php echo $_SESSION["projekt.aktiv"]?>);'
    <?php } else if($isProjekt == 1) {?>
        onclick='loadProjektPage("<?php echo $row["Ordner"]?>");'
    <?php } ?>
            class="LeisteLinksPunkt">
        <i class="bi <?php echo $row["Icon"]?>"></i> <?php echo $row["Name"]?></li>
    <?php
}
if($isProjekt == 1){
?>
    <li onclick='loadMainPage("userDashboard.php"); loadbar(0)' class="LeisteLinksPunkt"><i class="bi bi-arrow-bar-left"></i> zurück</li>
<?php
}
?>
<li onclick="openbar()" class="LeisteLinksPunkt onlyMobile"><i class="bi bi-x-lg"></i> schlissen</li>
