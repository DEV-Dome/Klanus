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

$fid = $_GET["fid"]; // Forum ID
$fname = ""; // Forum Namen
$fbeschreibung = "";  // Forum Beschreibung

include "../../rang/projektRang.php";
include_once "../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

//information getten


$sqlstr = "SELECT * FROM projekt_forum_forn WHERE ID = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $fid);
$sth->execute();

foreach($sth->fetchAll() as $row) {
    $fname = ($row["Name"]);
    $fbeschreibung = ($row["Beschreibung"]);
}
?>

<link href="pages/projekt/modules/forum/css/main.css?v=<?php echo time()?>" rel="stylesheet">
<link href="pages/projekt/modules/forum/css/main_handy.css?v=<?php echo time()?>" rel="stylesheet">
<link href="pages/projekt/modules/forum/css/main_tablet.css?v=<?php echo time()?>" rel="stylesheet">

<div class="headline_conatiner" >
    <span class="headline-text" ><?php echo $fname; ?></span><br>
    <span class="headline-text Beitrag_ubersicht_beschreibung" ><?php echo $fbeschreibung; ?></span>

    <!-- Buttons -->
    <button onclick="loadProjektUnderPage('forum', 'Neuer_Beitrag.php?fid=<?php echo $fid; ?>')" class="beitrag_button neuen_beitrag_button" style="">Neuen Beitrag</button>
</div>

<div class="beitrag_container">
    <?php
        //TODO: Forum Berechtigunugen Einbauen

        //angepinnte Beiträge
        //Atrebute zuordenen
        $sqlzuordnung = "projekt_forum_beitrage.Name AS 'bname', ";
        $sqlzuordnung .= "projekt_rang.Color AS 'usercolor', ";
        $sqlzuordnung .= "user.ID AS 'uid', ";
        $sqlzuordnung .= "user.Name AS 'uname', ";
        $sqlzuordnung .= "projekt_forum_beitrage.ID AS 'bid', ";
        $sqlzuordnung .= "Zugriffe, IsAngepinnt, ErstelltAm"; // alles andere



        $sqlstr = "SELECT $sqlzuordnung FROM projekt_forum_beitrage,user,projekt_user,projekt_rang WHERE projekt_rang.ID = projekt_user.Rang AND projekt_user.Projekt = ? AND projekt_user.User = user.id AND user.id = Owner AND Forum = ? ORDER BY IsAngepinnt DESC";
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
        $sth->bindParam(2, $fid);
        $sth->execute();

        $erster_lauf = true;
        $save_IsAngepinnt = -1;

        foreach($sth->fetchAll() as $row) {
            if($save_IsAngepinnt != $row["IsAngepinnt"]){
                    $erster_lauf = true;
            }
                $save_IsAngepinnt = $row["IsAngepinnt"];

                if($erster_lauf && $save_IsAngepinnt == 1){
                    //Übersicht angepinnt zeigen
                    ?>
                        <div class="beitrag_headline_conatiner">
                            <span style="margin-left: 10% !important; font-size: 20px;">Angepinnt</span>

                            <span class="beitrag_letzer_beitrag none_margin_top" style="margin-right: 3%!important;">Letzter Beitrag</span>
                            <span class="beitrag_zugriffe none_margin_top" style="margin-right: 9% !important;"><i class="bi bi-eye"></i></span>
                            <span class="beitrag_antworten none_margin_top" style="margin-right: 9% !important;"><i class="bi bi-reply"></i></span>
                            <hr>
                        </div>
                      <?php
                    $erster_lauf = false;
                }else if($erster_lauf) {
                    //Übersicht alle beiträge zeigen
                    ?>
                        <div class="beitrag_headline_conatiner beitrag_headline_conatiner_with_top">
                            <span style="margin-left: 10% !important; font-size: 20px;">Alle Beiträge</span>

                            <span class="beitrag_letzer_beitrag none_margin_top" style="margin-right: 3%!important;">Letzter Beitrag</span>
                            <span class="beitrag_zugriffe none_margin_top" style="margin-right: 9% !important;"><i class="bi bi-eye"></i></span>
                            <span class="beitrag_antworten none_margin_top" style="margin-right: 9% !important;"><i class="bi bi-reply"></i></span>
                            <hr>
                        </div>
                    <?php
                    $erster_lauf = false;
                }
                //beitrag ausgeben
                $dt = new DateTime($row["ErstelltAm"]);

                ?>
            <div class="beitrage" onclick="loadProjektUnderPage('forum', 'Beitrag.php?bid=<?php echo $row["bid"]?>');">
                <?php
                $loadPgClasses = "beitrag_bild";
                $loadPgOnClick = "";
                $outputpfad = "";
                $bid =  intval($row["uid"], 10);
                include "../../../../../php/user/get/UserImage.php";
                ?>
                <div class="beitrag_name"><?php echo ($row["bname"]) ?> <br> <span class="beitrag_subtitle">erstellt von <span style="color: <?php echo $row["usercolor"]; ?>"><?php echo ucfirst($row["uname"]) ?></span></span></div>
                <div class="beitrag_antworten">0</div>
                <div class="beitrag_zugriffe"><?php echo $row["Zugriffe"] ?></div>
                <div class="beitrag_letzer_beitrag">von <span style="color: <?php echo $row["usercolor"]; ?>"><?php echo ucfirst($row["uname"]) ?></span><br><span class="beitrag_subtitle" >am <b ><?php echo $dt->format("d.m.Y") ?></b></span></div>
            </div>
            <?php
        }
    ?>
</div>
