function newEinladung(){
    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/einladungen/assets/addEinladnung.php',
        contentType: false,
        processData: false,
        success: function (response) {
            loadProjektPage("einladungen");
        }
    });

}

function deleteEinladung(id){
    var form_data = new FormData();

    form_data.append("id", id);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/einladungen/assets/deleteEinladung.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            loadProjektPage("einladungen");
        }
    });
}