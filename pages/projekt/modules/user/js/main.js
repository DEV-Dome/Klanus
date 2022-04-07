function kickUserFromProjeckt(uid, pid){
    var form_data = new FormData();

    form_data.append("uid", uid);
    form_data.append("pid", pid);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/user/assets/kickUser.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            loadProjektPage("user");
        }
    });
}

function CahngeUserRang(uid, pid, rid){
    var form_data = new FormData();

    form_data.append("uid", uid);
    form_data.append("pid", pid);
    form_data.append("rid", rid);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/user/assets/ChangeUserRang.php',
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