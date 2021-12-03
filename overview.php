<?php
session_start();

$overPath = "";
if(!isset($_SESSION["Login"])){
    ?>
    <script>
        location.href = "index.php";
    </script>
    <?php
    exit();
}

// rang
include_once "php/sql/connection.php";
include_once "php/rang/Rang.php";
$rang = new Rang($_SESSION['Rang'], $pdo);
//

?>
<html>
<head>
    <title>Klanus - Overview</title>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="js/loader.js"></script>
    <script src="js/Main.js"></script>
    <script src="js/userSettings.js"></script>

    <link href="css/Main.css" rel="stylesheet">
    <link href="css/MainHandy.css" rel="stylesheet">
    <link href="css/MainPages/userDasboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <nav id="LeisteOben" onmouseover="ShowDropDown()" onmouseleave="DiesableDropDown()">
        <span id="LeisteObenTitle">Custy</span>

        <li class="LeisteObenLink" >Team</li>
        <li class="LeisteObenLink" >Partner</li>

            <?php
                $loadPgClasses = "LeisteObenPB";
                $loadPgOnClick = "";
                include "php/user/get/UserImage.php";
            ?>
    </nav>

    <div id="displayBereich">
        <nav id="LeisteLinks">
            <li onclick='loadMainPage("userDashboard.php");' class="LeisteLinksPunkt"><i class="bi bi-house-door LeisteLinksPunktAktiv"></i> Home</li>
            <li class="LeisteLinksPunkt"><i class="bi bi-bookmark"></i> Datenbibliothek</li>
            <li class="LeisteLinksPunkt"><i class="bi bi-gear"></i> Administration</li>
            <li class="LeisteLinksPunkt"><i class="bi bi-person"></i> Team</li>
            <li onclick="openbar()" class="LeisteLinksPunkt onlyMobile"><i class="bi bi-x-lg"></i> schlissen</li>

        </nav>

        <div id="MainSek_container" >
            <div onclick="openbar()" id="MainSekMobileController" > <i  class="bi bi-justify mobileSwitchLlogo"></i> </div>
            <div id="MainSek"></div>
        </div>

        <div id="DropdownUserMenu" onmouseover="ShowDropDown()" onmouseleave="DiesableDropDown()">
            <ul id="DropdownUserMenuListe">
                <li onclick="location.href = 'acp/' " class="DropdownUserMenuListeElement DropdownUserMenuListeElementFrist">Administration</li>
                <li onclick="loadMainPage('settings.php')" class="DropdownUserMenuListeElement">Einstellungen</li>
                <li class="DropdownUserMenuListeElement">Support</li>
                <li onclick="loadMainPage('logout.php')" class="DropdownUserMenuListeElement DropdownUserMenuListeElementred">Abmelden</li>
            </ul>
        </div>
    </div>

    <footer id="footer">
        <span class="footerItem">Datenschutz</span>
        <span class="footerItem">Impressum</span>
    </footer>
<script>
    loadMainPage("userDashboard.php");
</script>
</body>
</html>
