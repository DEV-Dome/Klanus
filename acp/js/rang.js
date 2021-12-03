var dragElement = undefined;

function addRank(name, beschreibung, color){
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
            window.location = "/admin/rank/";
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
}


function drop(ev) {
    console.log(dragElement);
    console.log(ev.target);
}

function dragstart(ev){
    dragElement = ev.target;
}