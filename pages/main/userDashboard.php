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

<link href="css/MainPages/userDasboard.css" rel="stylesheet">
<link href="css/MainPages/userDasbord_handy.css" rel="stylesheet">

<h1>Willkommen <span id="willkommenName"><?php echo $_SESSION['Name'] ?></span></h1>


<p class="dashbordUberschrift" >Deine Projekte</p>

<div class="flexbox_container" <?php if(isset($_GET["all"])) {?> style="height: 62vh !important; overflow-y: scroll !important;" <?php }?>>
    <div class="flexbox">
        <?php
        $fullansicht = true;
        $i = 0;
        $sglstr = "SELECT * FROM projekt_user,projekt WHERE projekt_user.Projekt = projekt.ID AND User = ? ORDER BY projekt_user.IsFavourite DESC, projekt_user.IsOwner DESC ";

        if(!isset($_GET["all"])){
            $sglstr .= "LIMIT 5";
            $fullansicht = false;
        }

        $sth = $pdo->prepare($sglstr);
        $sth->bindParam(1, $_SESSION['ID']);
        $sth->execute();

        foreach ($sth->fetchAll() as $row) {
        if($fullansicht){
        if($i == 5){
        $i = 0;
        ?>
    </div>
    <div class="flexbox">
        <?php
        }
        }
        ?>
        <div class="dashbordProjektKasten">
             <span class="Projekttool"  <?php if(!$row["IsOwner"]){?> style="visibility: hidden" <?php }?> ><i  style="color: #fff408;" class="bi bi-x-diamond-fill"></i></span>
            <?php
                if($row["IsFavourite"]) {
                    //wenn es ein favourite ist
            ?>
                    <span onclick="toogleProjektFavourite(<?php echo $row["Projekt"] ?>)" class="Projekttool Projekttoolright ProjekttoolrightIsFavourite"><i class="bi bi-suit-heart-fill"></i></span>
            <?php
                }else {
                    //wenn es kein favourite ist
            ?>
                    <span onclick="toogleProjektFavourite(<?php echo $row["Projekt"] ?>)" class="Projekttool Projekttoolright"><i class="bi bi-heart"></i></span>
            <?php
            }
            $loadPgClasses = "dashbordProjektImg";
            $pid = $row["Projekt"];
            $outputpfad = "";
            include "../../php/projekt/get/Image.php";
            ?>

            <p class="dashbordProjektName"><?php echo $row["Name"]; if($row["Verifiziert"]) { ?> <i style="color: #45FF58;" class="bi bi-check2-circle"></i> <?php }?></p>
            <button onclick="joinProjekt(<?php echo $row["Projekt"] ?>)" class="dashbordProjektButton">Zum Projekt</button>
        </div>
        <?php
        $i++;
        }
        ?>
    </div>

    <div  <?php if($fullansicht){ ?> style="visibility: hidden;" <?php }?> onclick="loadMainPage('userDashboard.php?all=true');" class="buttonMoreProjektsContainer">
        <!-- Mehr Button-->
        <i class="bi bi-chevron-compact-down buttonMoreProjekts"></i>
    </div>
</div>

<?php if(!$fullansicht){ ?>
<p class="dashbordUberschrift" >Deine Neuigkeiten</p>

<div class="flexbox_container_news" >
    <div class="flexbox">
        <div class="dashbordNewsKasten">
            <p class="newsTitle">News Title</p>
            <hr>
            <p class="newsIhnhalt">News Zusammenfassung</p>
        </div>

        <div class="dashbordNewsKasten">
            <p class="newsTitle">News Title</p>
            <hr>
            <p class="newsIhnhalt">News Zusammenfassung</p>
        </div>

        <div class="dashbordNewsKasten">
            <p class="newsTitle">News Title</p>
            <hr>
            <p class="newsIhnhalt">News Zusammenfassung</p>
        </div>
    </div>
</div>
<?php } ?>

