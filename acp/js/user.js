function setNewUserName(name, id){
    var form_data = new FormData();

    form_data.append("id", id)
    form_data.append("name", name)


    $.ajax({
        type: 'POST',
        url: 'php/user/newName.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
            }

            document.getElementById("feedback_hub").innerHTML = response;
            document.getElementById("feedback_hub").style.display = "block";
        }
    });

}
function setNewEmail(email, id){
    var form_data = new FormData();

    form_data.append("id", id)
    form_data.append("email", email)


    $.ajax({
        type: 'POST',
        url: 'php/user/newEmail.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
            }

            document.getElementById("feedback_hub").innerHTML = response;
            document.getElementById("feedback_hub").style.display = "block";
        }
    });
}
function setNewPassword(pw,pww, id){
    var form_data = new FormData();

    form_data.append("id", id);
    form_data.append("pw", pw);
    form_data.append("pww", pww);


    $.ajax({
        type: 'POST',
        url: 'php/user/newPassword.php',
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
            }

            document.getElementById("feedback_hub").innerHTML = response;
            document.getElementById("feedback_hub").style.display = "block";
        }
    });

}
function setNewRang(rang, id){
    var form_data = new FormData();

    form_data.append("id", id);
    form_data.append("rang", rang);


    $.ajax({
        type: 'POST',
        url: 'php/user/newRang.php',
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
            }

            document.getElementById("feedback_hub").innerHTML = response;
            document.getElementById("feedback_hub").style.display = "block";
        }
    });
}

function setNewAGB(agb, id){
    var form_data = new FormData();

    form_data.append("id", id);
    form_data.append("agb", agb);

    $.ajax({
        type: 'POST',
        url: 'php/user/newAGB.php',
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
            }

            document.getElementById("feedback_hub").innerHTML = response;
            document.getElementById("feedback_hub").style.display = "block";
        }
    });

}