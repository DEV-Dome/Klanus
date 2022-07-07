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

$bid = $_GET["bid"]; // Forum ID
$bname = ""; // Beitrag Namen
$bbeschreibung = "";  // Beitrag Beschreibung
$zugriffe = 0;
$owner = -1;
$bstatus = -1;
$fid = -1;

include "../../rang/projektRang.php";
include_once "../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);



//information getten
$sqlstr = "SELECT BeitragKommentar,projekt_forum_beitrage.Name AS 'Name', Zugriffe,Owner,Status,Forum FROM projekt_forum_beitrage,projekt_forum_forn WHERE Forum = projekt_forum_forn.ID  AND projekt_forum_beitrage.ID = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $bid);
$sth->execute();
foreach($sth->fetchAll() as $row) {
    $bname = $row["Name"];
    $bbeschreibung = $row["BeitragKommentar"];
    $zugriffe = $row["Zugriffe"];
    $owner = $row["Owner"];
    $bstatus = $row["Status"];
    $fid = $row["Forum"];
}
//zugriff rauf zählen
$zugriffe++;
$sqlstr = "UPDATE projekt_forum_beitrage SET Zugriffe = ? WHERE ID = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $zugriffe);
$sth->bindParam(2, $bid);
$sth->execute();
?>

<link href="pages/projekt/modules/forum/css/main.css?v=<?php echo time()?>" rel="stylesheet">
<link href="pages/projekt/modules/forum/css/main_handy.css?v=<?php echo time()?>" rel="stylesheet">
<link href="pages/projekt/modules/forum/css/main_tablet.css?v=<?php echo time()?>" rel="stylesheet">
<!-- Modal -->


<div class="beitrag_main_container">
        <div class="beitrag_teiler beitrag_teile_headline">
            <div class="headline_conatiner headline_conatiner_beitrag" >
                <div class="headline_conatiner_head">
                    <span class="headline-text" ><?php echo ($bname); ?></span>

                    <span class="headline_button_coantiner">
                        <?php if($_SESSION["ID"] == $owner ||$prang->hasPermission("forum.beitrag.edit") || $rang->hasPermission("all.forum.beitrag.edit")) { ?><button class="button headline_button button_grun"><i class="bi bi-pencil"></i></button>   <?php }?>
                        <?php if($prang->hasPermission("forum.beitrag.close") || $rang->hasPermission("all.forum.beitrag.close")) { ?>
                            <button onclick="toggle_close_beitrag(<?php echo $bid; ?>)" class="button headline_button button_blau">
                                <?php if($bstatus != 2) {?><i class="bi bi-lock"></i><?php  } ?>
                                <?php if($bstatus == 2) {?><i class="bi bi-unlock"></i><?php } ?>
                            </button>
                        <?php }?>
                        <?php if($prang->hasPermission("forum.beitrag.delete") || $rang->hasPermission("all.forum.beitrag.delete")) { ?><button onclick="Delete_beitrag(<?php echo $bid; ?>, <?php echo $fid; ?>)" class="button headline_button button_rot"><i class="bi bi-trash"></i></button>     <?php }?>
                        <button class="button headline_button button_rot"><i class="bi bi-exclamation-octagon"></i></button>
                    </span>
                </div>

                <span class="headline-text-sub Beitrag_ubersicht_beschreibung" ><?php echo ($bbeschreibung); ?></span>
            </div>
        </div>
        <div class="beitrag_teiler beitrag_teile_input">
            <div class="beitrag_verwalter_conatiner">
                <?php
                    $sqlstr = "SELECT *,user.name AS 'uname',projekt_forum_beitrage_kommentare.Name AS 'kname',projekt_forum_beitrage_kommentare.ID AS 'kid' FROM projekt_forum_beitrage_kommentare,user,projekt_user,projekt_rang WHERE projekt_rang.ID = projekt_user.Rang AND projekt_user.User = user.ID AND projekt_user.Projekt = ? AND Owner = user.ID AND Beitrag = ? ORDER BY projekt_forum_beitrage_kommentare.ID";
                    $sth = $pdo->prepare($sqlstr);
                    $sth->bindParam(2, $bid);
                    $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
                    $sth->execute();


                    foreach($sth->fetchAll() as $row) {

                    // liks abrufen
                    $sqlstr1 = "SELECT * FROM projekt_forum_beitrage_kommentare_like,user WHERE user.ID = User AND  User = ? AND Kommentar = ? ";
                    $sth1 = $pdo->prepare($sqlstr1);
                    $sth1->bindParam(1, $_SESSION["ID"]);
                    $sth1->bindParam(2, $row["kid"]);
                    $sth1->execute();

                    $liks_str = "";
                    foreach($sth1->fetchAll() as $row1) {
                        $liks_str .= $row1["Name"] . ", ";
                    }
                    //sonder beiträge
                    if($row["Status"] == 2){
                        include "beitrag_sonderanzeigen/ticket_geschlossen.php";
                    }else if($row["Status"] == 3){
                        include "beitrag_sonderanzeigen/ticket_gesoffnet.php";
                    } else {
                ?>
                <div class="beitrag_verwalter">
                <div class="beitrag_abzeige_conatiner beitrag_abzeige_conatiner_userinfo">
                    <?php
                    $loadPgClasses = "beitrag_kommentar_bild";
                    $loadPgOnClick = "";
                    $outputpfad = "";
                    $bid =  intval($row["Owner"], 10);
                    include "../../../../../php/user/get/UserImage.php";
                    $dt_erstellt_am = new DateTime($row["ErstelltAm"]);
                    ?>
                    <span class="beitrag_kommentar_user_name" style="color: <?php echo $row["Color"]; ?>"><?php echo utf8_encode(ucfirst($row["uname"])) ?></span>
                </div>
                <div class="beitrag_abzeige_conatiner beitrag_abzeige_conatiner_beitraginfo">
                    <span class="beitrag_kommentar_user_headline">
                        <span class="beitrag_kommentar_user_headline_name"><?php echo utf8_encode(ucfirst($row["kname"])) ?><br></span>
                        <span class="beitrag_kommentar_user_headline_subtext">erstellt von <span style="color: <?php echo $row["Color"]; ?>"><?php echo utf8_encode(ucfirst($row["uname"])) ?></span> am <b><?php echo $dt_erstellt_am->format("d.m.Y") ?></b></span>
                    </span><br>
                    <span class="beitrag_kommentar_user_beitrag"><?php echo (ucfirst($row["Text"])) ?></span><br><br>

                    <?php

                    ?>
                    <span class="beitrag_kommentar_user_beitrag">Folgende Benutzer sich für den Beitrag dedankt:</span><br>
                    <span class="beitrag_kommentar_user_danks" style="margin-top: 0% !important;"><?php echo $liks_str?></span>
                    <span class="beitrag_kommentar_user_button" >
                        <button class="button meldebutton"><i class="bi bi-exclamation-octagon"></i></button>
                        <button onclick="Update_like(<?php echo $row["kid"];?>, <?php echo $_GET["bid"];?>)"class="button likebutton"><i class="bi bi-hand-thumbs-up"></i></button>
                    </span>
                </div>
            </div>
                <?php
                      }
                    }
                    if($bstatus == 1){
                ?>

                <!-- editor-->
                <div class="beitrag_verwalter">
                    <div class="beitrag_abzeige_conatiner beitrag_abzeige_conatiner_userinfo">
                        <?php
                        $loadPgClasses = "beitrag_kommentar_bild";
                        $loadPgOnClick = "";
                        $outputpfad = "";
                        $bid =  intval($_SESSION["ID"], 10);
                        include "../../../../../php/user/get/UserImage.php";
                        ?>
                        <span class="beitrag_kommentar_user_name" style="color: <?php echo $prang->color; ?>"><?php echo utf8_encode(ucfirst($_SESSION["Name"])); ?></span>
                    </div>
                    <div class="beitrag_abzeige_conatiner beitrag_abzeige_conatiner_beitraginfo">
                    <span class="beitrag_kommentar_user_headline">
                       Neuer Kommentar:
                    </span><br>
                        <input type="text" placeholder="Beitrag Name" id="name" class="input_fild_normal">
                        <span class="beitrag_kommentar_user_beitrag ck-box">
                            <div id="editor"></div>
                        </span>


                        <span class="beitrag_kommentar_user_button" ></span>

                        <div class="feedback_hub" style="margin-top: 1%!important; margin-bottom: 1%; width: 92% !important;" id="feedback_hub">Feedback</div>

                        <div class="button_container">
                            <button onclick="start_neuen_kommentar(document.getElementById('name').value, <?php echo $_GET["bid"];?>)" class="button_new button_color_green senden_button">Neuen Kommentar</button>
                        </div>
                    </div>
                </div>

                <?php } ?>
            </div>
        </div>
</div>