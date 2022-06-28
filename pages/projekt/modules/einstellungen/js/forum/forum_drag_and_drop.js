function forum_dragover(e){
    e.preventDefault();

    if(e.target.classList.contains("drag_and_drop_target")){
        e.target.classList.add("drag_and_drop_target_current");
    }

}
function forum_ondragleave(e){
    if(e.target.classList.contains("drag_and_drop_target_current")){
        e.target.classList.remove("drag_and_drop_target_current");
    }
}
function forum_dragend(id){
    var meineElemente = document.getElementsByClassName('Forum');

    for(var i = 0; i < meineElemente.length; i++) {
        if(meineElemente[i].classList.contains("drag_and_drop_target")) meineElemente[i].classList.remove("drag_and_drop_target");
    }
}
function forum_dragstart(e, id){
    e.dataTransfer.setData("fromID", e.target.dataset.fromid);

    var meineElemente = document.getElementsByClassName('Forum');

    for(var i = 0; i < meineElemente.length; i++) {
        if(meineElemente[i] == e.target) continue;
        meineElemente[i].classList.add("drag_and_drop_target");
    }
}
function forum_drop(e, id){
    let formID = e.dataTransfer.getData("fromID");
    let toID = e.target.dataset.fromid;

    let formArr = formID.split(":");
    let toArr = toID.split(":");

    var meineElemente = document.getElementsByClassName('Forum');

    for(var i = 0; i < meineElemente.length; i++) {
        if(meineElemente[i].classList.contains("drag_and_drop_target")) meineElemente[i].classList.remove("drag_and_drop_target");
    }

    var form_data = new FormData();
    form_data.append("formID", formArr[0]);
    form_data.append("formKat", formArr[1]);
    form_data.append("toID", toArr[0]);
    form_data.append("toKat", toArr[1]);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/einstellungen/assets/forum/Prioritat_Forum.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response != "") alert(response);
           loadProjektUnderPage('einstellungen', 'forum/forum_einstellungen.php')
        }
    });

}