function set_menu_eintrag_disabled(mid, pid){
    var form_data = new FormData();

    form_data.append("mid", mid);
    form_data.append("pid", pid);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/einstellungen/assets/menu/setDisabled.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            console.log(response);
            loadbar(1);
            loadProjektUnderPage('einstellungen', 'menu_einstellungen.php')
        }
    });
}
function set_menu_eintrag_no_disabled(mid, pid){
    var form_data = new FormData();

    form_data.append("mid", mid);
    form_data.append("pid", pid);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/einstellungen/assets/menu/setNoDisabled.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            console.log(response);
            loadbar(1);
            loadProjektUnderPage('einstellungen', 'menu_einstellungen.php')
        }
    });
}
function show_edit_bereich(id, button){
    if(document.getElementById(id).style.display == "flex"){
        //beriech verstecken
        document.getElementById(id).style.display = "none";

        if( document.getElementById(button).classList.contains("editButtonMenuRed")) document.getElementById(button).classList.remove("editButtonMenuRed");
        document.getElementById(button).classList.add("editButtonMenu");

    }else {
        //bereich zeigen
        document.getElementById(id).style.display = "flex";

        if( document.getElementById(button).classList.contains("editButtonMenu")) document.getElementById(button).classList.remove("editButtonMenu");
        document.getElementById(button).classList.add("editButtonMenuRed");
    }

}