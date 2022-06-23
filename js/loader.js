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
            loadbar(1);
        }
    });
}
function loadProjektPage(seite){
    var form_data = new FormData();

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/' + seite + "/index.php",
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            document.getElementById("MainSek").innerHTML = response;
            setUploadAktiv();
        }
    });
}
function loadProjektUnderPage(modul,seite){
    var form_data = new FormData();

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/' + modul + "/page/" +seite,
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            document.getElementById("MainSek").innerHTML = response;
            setUploadAktiv();

            //js laden für unterseiten
            if(seite == "menu_einstellungen.php" && modul == "einstellungen"){
                addScript("pages/projekt/modules/einstellungen/js/menu_drag_and_drop.js");
            }
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