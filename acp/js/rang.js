var dragElement = undefined;

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
    console.log(reg);

    $.get("../php/rang/addRang.php?beschreibung=" + beschreibung +"&name=" + name + "&color=" + color  +"&" + reg, function(data) {
        if(data.toString() == "Rang Angelegt"){
            loadMainPage('rang/rang.php');
        }
        document.getElementById("output").innerHTML = data;
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
    console.log(reg);

    $.get("../php/rang/addRang.php?beschreibung=" + beschreibung +"&name=" + name + "&" + "id=" + id + "&color=" + color + "&update=true&" +reg, function(data) {
        if(data.toString() == "Rang Daten geändert"){
            loadMainPage('rang/rang.php');
        }
        document.getElementById("output").innerHTML = data;
    })
}

function delRank(id) {
    $.get("../php/rang/delRang.php?id=" + id, function(data) {
        if(data.toString() == "Rang gelöscht"){
            loadMainPage('rang/rang.php');
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
            url: '../php/rang/changePrioritat.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                if(response == "rang getauscht"){
                    loadMainPage('rang/rang.php');
                }
            }
        });
    }

}

function dragstart(ev){
    dragElement = ev.target;
}