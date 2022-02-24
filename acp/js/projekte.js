function chanceVerfiziert(pid){
    var form_data = new FormData();

    form_data.append("pid", pid);

    $.ajax({
        type: 'POST',
        url: 'php/projekt/chanceVerifiziert.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            console.log(response)
            loadMainPage("projekt/projekt.php");
        }
    });
}
function chanceLock(pid){
    var form_data = new FormData();

    form_data.append("id", pid);

    $.ajax({
        type: 'POST',
        url: 'php/projekt/lockProjekt.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            console.log(response)
            loadMainPage("projekt/projekt.php");
        }
    });
}
function deleteProjekt(pid){
    var form_data = new FormData();

    form_data.append("id", pid);

    $.ajax({
        type: 'POST',
        url: 'php/projekt/deleteProjekt.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            console.log(response)
            loadMainPage("projekt/projekt.php");
        }
    });
}
function setNewProjektName(name, id){
    var form_data = new FormData();

    form_data.append("id", id)
    form_data.append("name", name)


    $.ajax({
        type: 'POST',
        url: 'php/projekt/newName.php',
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
        url: 'php/projekt/newKurzel.php',
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
        url: 'php/projekt/newBeschreibung.php',
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
function setNewProjektStatus(name, id){
    var form_data = new FormData();

    form_data.append("id", id)
    form_data.append("name", name)


    $.ajax({
        type: 'POST',
        url: 'php/projekt/newStatus.php',
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