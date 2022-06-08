<?php
session_start();

$overPath = "../../../../../";
if(!isset($_SESSION["Login"])){
    ?>
    <script>
        location.href = "../index.php";
    </script>
    <?php
    exit();
}
include "../../../../../php/sql/connection.php";
$uid = $_GET["uid"];

$name = "";
$discordtag = "Exmaple#001";
$rangID = -1;
$owner = false;

//abfrage User Daten
$sqlstr = "SELECT * FROM user WHERE ID = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $uid);
$sth->execute();

foreach($sth->fetchAll() as $row) {
 $name = ucfirst($row["Name"]);
}

//anfrage für den Projeckt Rang
$sqlstr = "SELECT * FROM projekt_user WHERE User = ? AND Projekt = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $uid);
$sth->bindParam(2, $_SESSION["projekt.aktiv"]);
$sth->execute();

foreach($sth->fetchAll() as $row) {
    $rangID = $row["Rang"];
    $owner = $row["IsOwner"];
}

include "../../rang/projektRang.php";
include_once "../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo)
?>

<link href="pages/projekt/modules/user/css/main.css" rel="stylesheet">
<link href="pages/projekt/modules/user/css/main_handy.css" rel="stylesheet">
<link href="pages/projekt/modules/user/css/main_tablet.css" rel="stylesheet">

<div class="headline_conatiner" >
    <span class="headline-text" >User informationen</span>
</div>

<div class="page_main page_main_scroll_hidden" >
    <?php if($prang->hasPermission("user.info.id") || $rang->hasPermission("all.user.info.id")) { ?> <input value="<?php echo $uid; ?>" disabled type="text" placeholder="ID" id="id" class="input_fild_half"><?php } ?>
    <?php if($prang->hasPermission("user.info.discord") || $rang->hasPermission("all.user.info.discord")) { ?> <input value="<?php echo $discordtag; ?>" disabled type="text" placeholder="Discord-Tag" id="dct" class="input_fild_half"><?php } ?>

    <?php
        $loadPgClasses = "userListeBildInfoSeite";
        $loadPgOnClick = "";
        $outputpfad = "";
        $bid =  intval($uid, 10);
        include "../../../../../php/user/get/UserImage.php";
    ?>
    <p class="infotext">Weiter Anzeigen werden hier noch ergänzt</p>
    <input value="<?php echo $name; ?>" disabled type="text" placeholder="Name" id="name" class="input_fild_half input_fild_half_neben_pb">

    <?php if($prang->hasPermission("user.info.rang") || $rang->hasPermission("all.user.info.rang")) { ?>
    <select <?php if($owner)  echo "disabled"; ?>  onchange="CahngeUserRang(<?php echo $uid;?>, <?php echo $_SESSION["projekt.aktiv"];?>, this.value)"  class="input_fild_normal">
        <?php
        $sqlstr = "SELECT *,projekt_rang.ID AS 'rid' FROM projekt_rang WHERE Projekt  = ? ORDER BY Prioritat DESC";
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
        $sth->execute();

        foreach($sth->fetchAll() as $row) {
            $opt = "";
            if($row["rid"] == $rangID){
                $opt .= "selected";
            }
            ?>
            <option <?php echo $opt;?> value="<?php echo $row["rid"];?>" ><?php echo $row["Name"] ?></option>
        <?php
        }
        ?>
    </select>
    <?php
    }
    ?>

    <div class="feedback_hub" id="feedback_hub">Feedback</div>
</div>