function addRang(name, beschreibung, color){
    var permission = document.getElementsByClassName("permission");
    var reg = "";

    for(var i = 0; i < permission.length; i++) {
        if(permission[i].checked){
            if(reg == ""){
                reg += "perm[]=" + permission[i].id + ":yes";
            }else{
                reg += "&perm[]=" + permission[i].id + ":yes";
            }
        }else {
            if(reg == ""){
                reg += "perm[]=" + permission[i].id + ":no";
            }else{
                reg += "&perm[]=" + permission[i].id + ":no";
            }

        }
    }
    $.get("pages/projekt/modules/rang/assets/addRang.php?beschreibung=" + beschreibung +"&name=" + name + "&color=" + color  +"&" + reg, function(response) {
        if(response.toString() == "Rang Angelegt"){
            loadProjektPage("rang");
        }
        if (response.startsWith("<erro>")) {
            document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
        } else {
            document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
        }

        document.getElementById("feedback_hub").innerHTML = response;
        document.getElementById("feedback_hub").style.display = "block";
    })
}
function updateRang(name, beschreibung, id, color){
    var permission = document.getElementsByClassName("permission");
    var reg = "";

    for(var i = 0; i < permission.length; i++) {
        if(permission[i].checked){
            if(reg == ""){
                reg += "perm[]=" + permission[i].id + ":yes";
            }else{
                reg += "&perm[]=" + permission[i].id + ":yes";
            }
        }else {
            if(reg == ""){
                reg += "perm[]=" + permission[i].id + ":no";
            }else{
                reg += "&perm[]=" + permission[i].id + ":no";
            }

        }
    }

    $.get("pages/projekt/modules/rang/assets/addRang.php?beschreibung=" + beschreibung +"&name=" + name + "&" + "id=" + id + "&color=" + color + "&update=true&" +reg, function(response) {
        if(response.toString() == "Rang Daten geändert"){
            loadProjektPage("rang");
        }
        if (response.startsWith("<erro>")) {
            document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
        } else {
            document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
        }

        document.getElementById("feedback_hub").innerHTML = response;
        document.getElementById("feedback_hub").style.display = "block";
    })
}

function delRank(id) {
    $.get("pages/projekt/modules/rang/assets/delRang.php?id=" + id, function(data) {
        if(data.toString() == "Rang gelöscht"){
            loadProjektPage("rang");
        }
    })
}

function allowDrop(ev) {
    ev.preventDefault();
    //
    if(ev.target.classList.contains("dragtaget")){
        ev.target.classList.add("color-green");

        setTimeout(function() {
            ev.target.classList.remove("color-green");
        }, 500);
    }else {
        ev.target.classList.add("bg-red");

        setTimeout(function() {
            ev.target.classList.remove("bg-red");
        }, 500);
    }
}


function drop(ev) {
    //zeihe element: dragElement
    //ziel: ev.target

    if(ev.target.classList.contains("dragtaget")){
        idTarget = ev.target.id;
        iDBase = dragElement.id;

        var form_data = new FormData();

        form_data.append('baseID', iDBase);
        form_data.append('targetID', idTarget);

        $.ajax({
            type: 'POST',
            url: 'pages/projekt/modules/rang/assets/changePrioritat.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                if(response == "rang getauscht"){
                    loadProjektPage("rang");
                }
            }
        });
    }

}

function dragstart(ev){
    dragElement = ev.target;
}