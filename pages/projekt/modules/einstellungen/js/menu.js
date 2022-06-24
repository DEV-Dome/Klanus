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
            loadbar(1);
            loadProjektUnderPage('einstellungen', 'menu_einstellungen.php')
        }
    });
}
function ChanceMenuName(id, name){
    var form_data = new FormData();

    form_data.append("id", id);
    form_data.append("name", name);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/einstellungen/assets/menu/ChanceMenuName.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub_" + id).style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else {
                document.getElementById("feedback_hub_" + id).style.backgroundColor = "rgba(69, 255, 88, 0.25)";
            }

            document.getElementById("feedback_hub_" + id).innerHTML = response;
            document.getElementById("feedback_hub_" + id).style.display = "block";

            loadbar(1);
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