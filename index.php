<?php
session_start();

$overPath = "";
$login = true;

// rang
include_once "php/sql/connection.php";
include_once "php/rang/Rang.php";

$rang = "";
if(!isset($_SESSION["Login"])){
    $login = false;
    $rang = new Rang(2, $pdo);
}else {
    $rang = new Rang($_SESSION['Rang'], $pdo);
}

?>
<html>
<head>
    <title>Klanus - Overview</title>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="js/loader.js"></script>
    <script src="js/Main.js"></script>
    <script src="js/projekt.js"></script>
    <script src="js/userSettings.js"></script>
    <script src="js/projektEinstellungen.js"></script>

    <link href="css/main.css" rel="stylesheet">
    <link href="css/mainHandy.css" rel="stylesheet">

    <!-- Allgemeine CSS Classen-->
    <link href="acp/css/classes.css" rel="stylesheet">
    <link href="acp/css/classes_handy.css" rel="stylesheet">

    <!-- Login Javascript-->
    <script src="js/login.js" ></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8"/>
</head>
<body>
    <nav id="LeisteOben" onmouseover="ShowDropDown()" onmouseleave="DiesableDropDown()">
        <span id="LeisteObenTitle">Custy</span>

        <li class="LeisteObenLink" >Team</li>
        <li class="LeisteObenLink" >Partner</li>
            <?php
                if($login){
                    //wenn eingeloggt
                    $loadPgClasses = "LeisteObenPB forntEndLeisteObenPB";
                    $loadPgOnClick = "";
                    include "php/user/get/UserImage.php";
                }else {
                    //wenn nicht eingeloggt
                    ?>
                    <li onclick="loadMainPage('login/login.php')" class='LeisteObenLink LeisteObenLink-LastElement'>Anmelden / Registrien</li>
                    <?php
                }

            ?>
    </nav>

    <div id="displayBereich">
        <nav id="LeisteLinks" class="LeisteLinkSehenNein">
            <script>
                loadbar(false);
            </script>
        </nav>

        <div id="MainSek_container" >
            <div onclick="openbar()" id="MainSekMobileController" > <i  class="bi bi-justify mobileSwitchLlogo"></i> </div>
            <div id="MainSek"></div>
        </div>

        <?php if($login) {
        // Nur Anzeigen wenn man eingeloggt ist!
        ?>
        <div id="DropdownUserMenu" onmouseover="ShowDropDown()" onmouseleave="DiesableDropDown()">
            <ul id="DropdownUserMenuListe">
               <?php if($rang->hasPermission("acp.use")) {?> <li onclick="location.href = 'acp/' " class="DropdownUserMenuListeElement DropdownUserMenuListeElementFrist">Administration</li><?php } ?>
                <li onclick="loadMainPage('settings.php')" class="DropdownUserMenuListeElement">Einstellungen</li>
                <li class="DropdownUserMenuListeElement">Support</li>
                <li onclick="loadMainPage('logout.php'); location.reload();" class="DropdownUserMenuListeElement DropdownUserMenuListeElementred">Abmelden</li>
            </ul>
        </div>
        <?php }?>
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
