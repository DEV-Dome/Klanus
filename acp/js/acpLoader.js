function loadMainPage(seite){
    var form_data = new FormData();


    $.ajax({
        type: 'POST',
        url: 'pages/main/' + seite,
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            document.getElementById("MainSek").innerHTML = response;
        }
    });
}