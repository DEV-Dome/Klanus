<?php
//PHP Teil: wenn nötig
?>
<link href="css/MainPages/login/login.css" rel="stylesheet">
<link href="css/MainPages/login/login_handy.css" rel="stylesheet">

<div class="headline_conatiner" >
    Registrieren
</div>

<div class="page_main page_main_scroll_hidden" >
    <input type="text" placeholder="E-mail" id="email" class="input_fild_normal">
    <input type="text" placeholder="Username" id="name" class="input_fild_normal">
    <input type="password" placeholder="Passwort" id="pw" class="input_fild_normal">
    <input type="password" placeholder="Passwort-wiederholen" id="pww" class="input_fild_normal">

    <span onclick="loadMainPage('login/login.php')" class="linkText">Du hast einen Account ? Hier anmelden.</span>
    <button onclick="register(document.getElementById('email').value, document.getElementById('pw').value, document.getElementById('pww').value, document.getElementById('name').value)" class="buttonAnmeldung">Registrieren</button>

    <div id="feedback_hub" class="feedback_hub">Feedback</div>
</div>
