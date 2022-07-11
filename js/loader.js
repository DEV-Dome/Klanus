function loadMainPage(seite){
    show_loader();

    var form_data = new FormData();

    $.ajax({
        type: 'POST',
        url: 'pages/main/' + seite,
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            document.getElementById("MainSek").innerHTML = response;
            closebar();

            if(seite.startsWith("user_dashboard.php")){
                //user Dashboard
                addScript("js/user_dashboard/drag_and_drop.js?v=" + new Date().getTime());
            }

        },
        complete: function (){
            hidden_loader();
        }
    });
}
function joinProjekt(id){
    show_loader();
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
        },
        complete: function (){
            hidden_loader();
        }
    });
}
function loadProjektPage(seite){
    show_loader();
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
            closebar();
        },
        complete: function (){
            hidden_loader();
        }
    });
}
function loadProjektUnderPage(modul,seite){
    show_loader();
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
            loadbar(1);

            //js laden für unterseiten
            if(seite == "menu_einstellungen.php" && modul == "einstellungen"){
                addScript("pages/projekt/modules/einstellungen/js/menu_drag_and_drop.js?v=" + new Date().getTime());
                addScript("pages/projekt/modules/einstellungen/js/menu.js?v=" + new Date().getTime());
            }
            if((seite.startsWith("forum/kategorie_erstellen.php") || seite.startsWith("forum/forum_einstellungen.php")) && modul == "einstellungen"){
                addScript("pages/projekt/modules/einstellungen/js/forum/forum.js?v=" + new Date().getTime());
                addScript("pages/projekt/modules/einstellungen/js/forum/kategorie_drag_and_drop.js?v=" + new Date().getTime());
                addScript("pages/projekt/modules/einstellungen/js/forum/forum_drag_and_drop.js?v=" + new Date().getTime());
            }
            if((seite.startsWith("Neuer_Beitrag.php"))){
                addScript("pages/projekt/modules/forum/js/neuer_beitrag.js?v=" + new Date().getTime());
            }
            if(seite.startsWith("Beitrag.php")){
                addScript("pages/projekt/modules/forum/js/beitrag.js?v=" + new Date().getTime());
            }
        },
        complete: function (){
            hidden_loader();
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