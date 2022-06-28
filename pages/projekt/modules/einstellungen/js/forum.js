function create_kategorie(name, rang){
    var form_data = new FormData();

    form_data.append("name", name);
    form_data.append("rang", rang);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/einstellungen/assets/forum/Create_Kategorie.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
            }

            if(response == "Kategorien angelegt"){
                document.getElementById("feedback_hub").innerHTML = response;
                document.getElementById("feedback_hub").style.display = "block";
            }else {
                loadProjektUnderPage('einstellungen', 'forum/forum_einstellungen.php')
            }
        }
    });
}
function edit_kategorie(name, rang, id){
    var form_data = new FormData();

    form_data.append("name", name);
    form_data.append("rang", rang);
    form_data.append("id", id);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/einstellungen/assets/forum/Create_Kategorie.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
            }

            if(response == "Kategorien angelegt"){
                document.getElementById("feedback_hub").innerHTML = response;
                document.getElementById("feedback_hub").style.display = "block";
            }else {
                loadProjektUnderPage('einstellungen', 'forum/forum_einstellungen.php')
            }
        }
    });
}
function delete_kategorie(id){
    var form_data = new FormData();

    form_data.append("id", id);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/einstellungen/assets/forum/Delete_Kategorie.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            loadProjektUnderPage('einstellungen', 'forum/forum_einstellungen.php')
        }
    });
}