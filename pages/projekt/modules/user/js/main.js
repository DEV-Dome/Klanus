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
            console.log(response)
            loadProjektPage("user");
        }
    });
}