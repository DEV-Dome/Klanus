function setNewProjektName(name, id){
    var form_data = new FormData();

    form_data.append("id", id)
    form_data.append("name", name)

    $.ajax({
        type: 'POST',
        url: 'acp/php/projekt/newName.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
            }

            document.getElementById("feedback_hub").innerHTML = response;
            document.getElementById("feedback_hub").style.display = "block";
        }
    });

}
function setNewProjektKurzel(name, id){
    var form_data = new FormData();

    form_data.append("id", id)
    form_data.append("name", name)


    $.ajax({
        type: 'POST',
        url: 'acp/php/projekt/newKurzel.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
            }

            document.getElementById("feedback_hub").innerHTML = response;
            document.getElementById("feedback_hub").style.display = "block";
        }
    });

}
function setNewProjektBeschreibung(name, id){
    var form_data = new FormData();

    form_data.append("id", id)
    form_data.append("name", name)


    $.ajax({
        type: 'POST',
        url: 'acp/php/projekt/newBeschreibung.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
            }

            document.getElementById("feedback_hub").innerHTML = response;
            document.getElementById("feedback_hub").style.display = "block";
        }
    });

}
function setNewProjektImg(ele, id){
    var form_data = new FormData();
    form_data.append("img", ele.files[0]);
    form_data.append("id", id);

    $.ajax({
        type: 'POST',
        url: 'acp/php/projekt/newImage.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if (response.startsWith("<erro>")) {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            } else {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
            }

            document.getElementById("feedback_hub").innerHTML = response;
            document.getElementById("feedback_hub").style.display = "block";
        }
    });
}
function deleteProjekt(pid){
    var form_data = new FormData();

    form_data.append("id", pid);

    $.ajax({
        type: 'POST',
        url: 'acp/php/projekt/deleteProjekt.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            loadMainPage("userDashboard.php")
            loadbar(0);
        }
    });
}