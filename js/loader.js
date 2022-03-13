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
function joinProjekt(id){
    var form_data = new FormData();

    $.ajax({
        type: 'GET',
        url: 'pages/projekt/index.php?pid=' + id,
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            document.getElementById("MainSek").innerHTML = response;
        }
    });
}
function loadProfielImage(out){
    $.ajax({
        type: 'POST',
        url: 'php/user/get/UserImage.php',
        contentType: false,
        processData: false,
        success: function (response) {
            document.getElementById(out).innerHTML = response;
        }
    });
}