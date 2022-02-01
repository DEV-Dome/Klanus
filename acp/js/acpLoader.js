function loadMainPage(seite, id = ""){
    var form_data = new FormData();

    if(id != ""){
        form_data.append("id", id)
    }

    $.ajax({
        type: 'POST',
        url: 'pages/main/' + seite,
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response == "not permission"){
                alert("nop");
                return;
            }
            document.getElementById("MainSek").innerHTML = response;
        }
    });
}