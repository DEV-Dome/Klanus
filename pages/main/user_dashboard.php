<?php
session_start();

if(!isset($_SESSION["Login"])){
    ?>
    <script>
        location.href = "index.php";
    </script>
    <?php
    exit();
}
$overPath = "../../";
// rang
include_once "../../php/sql/connection.php";
include_once "../../php/rang/Rang.php";
$rang = new Rang($_SESSION['Rang'], $pdo);
?>

<link href="css/MainPages/user_dashboard.css?v=<?php echo time()?>" rel="stylesheet">
<!-- <link href="css/MainPages/userDasbord_handy.css?v=<?php echo time()?>" rel="stylesheet"> -->

<div class="flex_conatiner">
    <span class="headline">Willkommen <?php echo $_SESSION['Name'] ?></span>
    <span class="headline headline_sub">Deine Projekte</span>

    <div class="projekt_conatiner">
        <?php
         $sglstr = "SELECT * FROM projekt_user,projekt WHERE projekt_user.Projekt = projekt.ID AND User = ? ORDER BY projekt_user.IsFavourite DESC, projekt_user.IsOwner DESC ";

        $sth = $pdo->prepare($sglstr);
        $sth->bindParam(1, $_SESSION['ID']);
        $sth->execute();
        foreach ($sth->fetchAll() as $row) {
            $fabicon = '<span onclick="toogleProjektFavourite('.$row["Projekt"].')" class="projekt_tool projekt_tool_fav"><i class="bi bi-heart"></i></span>';
            if($row["IsFavourite"]) {
                $fabicon = '<span onclick="toogleProjektFavourite('.$row["Projekt"].')" class="projekt_tool projekt_tool_fav ProjekttoolrightIsFavourite"><i class="bi bi-suit-heart-fill"></i></span>';
            }

            ?>
            <div class="projekt_box">
                <div class="Projekt_tool_bar">
                    <span class="projekt_tool"  <?php if(!$row["IsOwner"]){?> style="visibility: hidden" <?php }?> ><i  style="color: #fff408;" class="bi bi-x-diamond-fill"></i></span>
                    <?php echo $fabicon ?>
                </div>

                <div class="projekt_teiler">
                    <?php
                    $loadPgClasses = "dashbordProjektImg";
                    $pid = $row["Projekt"];
                    $outputpfad = "";
                    include "../../php/projekt/get/Image.php";
                    ?>
                </div>


                <div class="projekt_teiler">
                    <p class="dashbordProjektName"><?php echo $row["Name"]; if($row["Verifiziert"]) { ?> <i style="color: #45FF58;" class="bi bi-check2-circle"></i> <?php }?></p>
                </div>
                <div class="projekt_teiler">
                    <button onclick="joinProjekt(<?php echo $row["Projekt"] ?>)" class="dashbordProjektButton">Zum Projekt</button>
                </div>

            </div>
            <?php
        }
         ?>
    </div>

    <span class="headline headline_sub">Deine Neuigkeiten</span>
    <div class="news_conatiner">
        <div class="news_box">
            <div class="news_teiler">
                <span class="news_headline">Title</span>
            </div>

            <div class="news_teiler">
                <img class="news_bild" src="assets/default_ankündigung.png">
            </div>

            <div class="news_teiler">
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            </div>
        </div>

        <div class="news_box">
            <div class="news_teiler">
                <span class="news_headline">Title</span>
            </div>

            <div class="news_teiler">
                <img class="news_bild" src="assets/default_ankündigung.png">
            </div>

            <div class="news_teiler">
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            </div>
        </div>

        <div class="news_box">
            <div class="news_teiler">
                <span class="news_headline">Title</span>
            </div>

            <div class="news_teiler">
                <img class="news_bild" src="assets/default_ankündigung.png">
            </div>

            <div class="news_teiler">
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            </div>
        </div>
    </div>
</div>