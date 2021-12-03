function register(email, passwort, passwortw, username){
    $.get("php/login/register.php?name=" + username + "&passwort=" + passwort + "&passwortw=" + passwortw + "&email=" + email, function (data) {
        if(data == "Du bist jetzt registirt!"){
            location.href = "index.php";
        }
        document.getElementById("res").innerHTML = data;
    });
}

function login(name, passwort){
    $.get("php/login/login.php?name=" + name + "&passwort=" + passwort, function (data) {
        if(data == "Du bist eingeloggt."){
            location.href = "overview.php";
        }
        document.getElementById("res").innerHTML = data;
    });
}