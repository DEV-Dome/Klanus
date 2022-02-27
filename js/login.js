function register(email, passwort, passwortw, username){
    var form_data = new FormData();

    form_data.append("name", username);
    form_data.append("passwort", passwort);
    form_data.append("passwortw", passwortw);
    form_data.append("email", email);

    $.ajax({
        type: 'POST',
        url: 'php/login/register.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else if(response == ""){
                return;
            }else {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
                location.reload();
            }

            document.getElementById("feedback_hub").innerHTML = response;
            document.getElementById("feedback_hub").style.display = "block";
        }
    });


    /* $.get("php/login/login.php?name=" + name + "&passwort=" + passwort, function (response) {
         if(response.startsWith("<erro>")){
             document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
         }else if(response == ""){
             return;
         }else {
             document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
             location.reload();
         }

         document.getElementById("feedback_hub").innerHTML = response;
         document.getElementById("feedback_hub").style.display = "block";
     });*/
}

function login(name, passwort){
    var form_data = new FormData();

    form_data.append("name", name);
    form_data.append("passwort", passwort);


    $.ajax({
        type: 'POST',
        url: 'php/login/login.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else if(response == ""){
                return;
            }else {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
                location.reload();
            }

            document.getElementById("feedback_hub").innerHTML = response;
            document.getElementById("feedback_hub").style.display = "block";
        }
    });

}