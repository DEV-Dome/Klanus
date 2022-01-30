<?php
session_start();

$overPath = "../";
if(!isset($_SESSION["Login"])){
    ?>
    <script>
        location.href = "../index.php";
    </script>
    <?php
    exit();
}

// rang
include_once "../php/sql/connection.php";
include_once "../php/rang/Rang.php";
$rang = new Rang($_SESSION['Rang'], $pdo);
//
//Permission abfrage!
?>
<html>
<head>
    <title>Klanus - ACP</title>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="../js/Main.js"></script>
    <script src="js/acpLoader.js"></script>
    <script src="js/rang.js"></script>
    <script src="js/user.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/mainHandy.css" rel="stylesheet">
    <link href="../css/MainPages/userDasboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <link href="css/classes.css" rel="stylesheet">
    <link href="css/classes_handy.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<nav id="LeisteOben" onmouseover="ShowDropDown()" onmouseleave="DiesableDropDown()">
    <span id="LeisteObenTitle">Custy - ACP</span>

    <li class="LeisteObenLink" >Team</li>
    <li class="LeisteObenLink" >Partner</li>

    <?php
    $loadPgClasses = "LeisteObenPB";
    $loadPgOnClick = "";
    include "../php/user/get/UserImage.php";
    ?>
</nav>

<div id="displayBereich">
    <nav id="LeisteLinks" class="LeisteLinkSehenNein">
        <li onclick='' class="LeisteLinksPunkt"><i class="bi bi-columns-gap LeisteLinksPunktAktiv"></i> Dashboard</li>
        <li onclick="loadMainPage('user/user.php');" class="LeisteLinksPunkt"><i class="bi bi-person"></i> User Verwaltung</li>
        <li onclick="loadMainPage('rang/rang.php');" class="LeisteLinksPunkt"><i class="bi bi-shield"></i> Rang Verwaltung</li>
        <li class="LeisteLinksPunkt"><i class="bi bi-terminal"></i> Module</li>
        <li class="LeisteLinksPunkt"><i class="bi bi-pin-angle"></i> Ankündigungen</li>
        <li onclick="openbar()" class="LeisteLinksPunkt onlyMobile"><i class="bi bi-x-lg"></i> schlissen</li>
    </nav>

    <div id="MainSek_container" >
        <div id="MainSekMobileController" > <i onclick="openbar()" class="bi bi-justify mobileSwitchLlogo"></i> </div>
        <div id="MainSek"></div>
    </div>

    <div id="DropdownUserMenu" onmouseover="ShowDropDown()" onmouseleave="DiesableDropDown()">
        <ul id="DropdownUserMenuListe">
            <li onclick="location.href = '../' " class="DropdownUserMenuListeElement DropdownUserMenuListeElementFrist">Front end</li>
            <li onclick="" class="DropdownUserMenuListeElement DropdownUserMenuListeElementred">Abmelden</li>
        </ul>
    </div>
</div>

<footer id="footer">
    <span class="footerItem">Datenschutz</span>
    <span class="footerItem">Impressum</span>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
    loadMainPage("addminDashboard.php");
</script>
</body>
</html>