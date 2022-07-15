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

$kann_alle_beiträge_sehen = false;
$kann_seine_beiträge_sehen = false;
$kann_beiträge_schreiben = false;

include "../../rang/projektRang.php";
include_once "../../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

//information getten


$sqlstr = "SELECT * FROM projekt_forum_forn WHERE  ID = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $fid);
$sth->execute();

foreach($sth->fetchAll() as $row) {
    $fname = ($row["Name"]);
    $fbeschreibung = ($row["Beschreibung"]);

    //permission abfragen
    $sqlstr1 = "SELECT * FROM projekt_rang WHERE  ID = ?";
    $sth1 = $pdo->prepare($sqlstr1);
    $sth1->bindParam(1, $row["KannSehenBeitrage"]);
    $sth1->execute();
    foreach($sth1->fetchAll() as $row1) {
        if($prang->prioritat >= $row1["Prioritat"]){
            $kann_alle_beiträge_sehen = true;
        }
    }

    $sqlstr1 = "SELECT * FROM projekt_rang WHERE  ID = ?";
    $sth1 = $pdo->prepare($sqlstr1);
    $sth1->bindParam(1, $row["KannSehenBeitrageOnly"]);
    $sth1->execute();
    foreach($sth1->fetchAll() as $row1) {
        if($prang->prioritat >= $row1["Prioritat"]){
            $kann_seine_beiträge_sehen = true;
        }
    }

    $sqlstr1 = "SELECT * FROM projekt_rang WHERE  ID = ?";
    $sth1 = $pdo->prepare($sqlstr1);
    $sth1->bindParam(1, $row["KannschreibenBeitrage"]);
    $sth1->execute();
    foreach($sth1->fetchAll() as $row1) {
        if($prang->prioritat >= $row1["Prioritat"]){
            $kann_beiträge_schreiben = true;
        }
    }
}
?>

<link href="pages/projekt/modules/forum/css/main.css?v=<?php echo time()?>" rel="stylesheet">
<link href="pages/projekt/modules/forum/css/main_handy.css?v=<?php echo time()?>" rel="stylesheet">
<link href="pages/projekt/modules/forum/css/main_tablet.css?v=<?php echo time()?>" rel="stylesheet">

<div class="headline_conatiner" >
    <span class="headline-text" ><?php echo $fname; ?></span><br>
    <span class="headline-text Beitrag_ubersicht_beschreibung" ><?php echo $fbeschreibung; ?></span>

    <!-- Buttons -->
    <?php
        if($kann_beiträge_schreiben) {
    ?>
            <button onclick="loadProjektUnderPage('forum', 'Neuer_Beitrag.php?fid=<?php echo $fid; ?>')" class="beitrag_button neuen_beitrag_button" style="">Neuen Beitrag</button>
    <?php
        }
    ?>
</div>

<div class="beitrag_container">
    <?php
        if(!$kann_alle_beiträge_sehen && !$kann_seine_beiträge_sehen){
            ?>
                <p>Leider sind in diesem Forum noch keine Beiträge vorhanden.</p>
             <?php
            exit();
        }
        //TODO: Forum Berechtigunugen Einbauen

        //angepinnte Beiträge
        //Atrebute zuordenen
        $sqlzuordnung = "projekt_forum_beitrage.Name AS 'bname', ";
        $sqlzuordnung .= "projekt_rang.Color AS 'usercolor', ";
        $sqlzuordnung .= "user.ID AS 'uid', ";
        $sqlzuordnung .= "user.Name AS 'uname', ";
        $sqlzuordnung .= "projekt_forum_beitrage.ID AS 'bid', ";
        $sqlzuordnung .= "Zugriffe, IsAngepinnt, ErstelltAm, Status"; // alles andere

        $permiss_where = "";

        //Prüfe ob Permission vorhanden sind
        if(!$kann_alle_beiträge_sehen){
            if($kann_seine_beiträge_sehen){
                $permiss_where = "AND projekt_forum_beitrage.Owner = " . $_SESSION["ID"] . " ";
            }else {
                echo '<p style="text-align: center">Leider sind in diesem Forum noch keine Beiträge vorhanden.</p>';
                exit();
            }
        }


        $sqlstr  = "SELECT $sqlzuordnung FROM projekt_forum_beitrage,user,projekt_user,projekt_rang ";
        $sqlstr .= "WHERE projekt_rang.ID = projekt_user.Rang AND projekt_user.Projekt = ? AND projekt_user.User = user.id AND user.id = Owner AND Forum = ? AND Status != 3 ";
        $sqlstr .= "$permiss_where";
        $sqlstr .= "ORDER BY IsAngepinnt DESC, ErstelltAm DESC";

        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
        $sth->bindParam(2, $fid);
        $sth->execute();

        $erster_lauf = true;
        $save_IsAngepinnt = -1;
        if($sth->rowCount() == 0){
            echo '<p style="text-align: center">Leider sind in diesem Forum noch keine Beiträge vorhanden.</p>';
            exit();
        }
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

                $sth_beitrag_zahl = $pdo->prepare("SELECT * FROM projekt_forum_beitrage_kommentare WHERE Beitrag = ?");
                $sth_beitrag_zahl->bindParam(1, $row["bid"]);
                $sth_beitrag_zahl->execute();
                ?>
                <div class="beitrag_name"><?php echo ($row["bname"]); ?>
                    <br> <span class="beitrag_subtitle">erstellt von <span style="color: <?php echo $row["usercolor"]; ?>"><?php echo ucfirst($row["uname"]) ?></span></span></div>



                <div class="beitrag_antworten"><?php echo $sth_beitrag_zahl->rowCount() ?></div>
                <div class="beitrag_zugriffe"><?php echo $row["Zugriffe"] ?></div>
                <div class="beitrag_letzer_beitrag">von <span style="color: <?php echo $row["usercolor"]; ?>"><?php echo ucfirst($row["uname"]) ?></span><br><span class="beitrag_subtitle" >am <b ><?php echo $dt->format("d.m.Y") ?></b></span></div>
            </div>
            <?php
        }
    ?>
</div>
