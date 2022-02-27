<?php
    //PHP Teil: wenn nötig
?>
<link href="css/MainPages/login/login.css" rel="stylesheet">
<link href="css/MainPages/login/login_handy.css" rel="stylesheet">

<div class="headline_conatiner" >
    Einloggen
</div>

<div class="page_main page_main_scroll_hidden" >
    <input type="text" placeholder="Username / E-mail" id="name" class="input_fild_normal">
    <input type="password" placeholder="Passwort" id="pw" class="input_fild_normal">

    <span onclick="loadMainPage('login/register.php')" class="linkText">Noch keinen Account ? Hier einen erstellen.</span>
    <button onclick="login(document.getElementById('name').value, document.getElementById('pw').value)" class="buttonAnmeldung">Anmelden</button>

    <div id="feedback_hub" class="feedback_hub">Feedback</div>
</div>
