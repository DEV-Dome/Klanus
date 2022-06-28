function menu_dragover(e){
    e.preventDefault();

    if(e.target.classList.contains("drag_and_drop_target")){
        e.target.classList.add("drag_and_drop_target_current");
    }

}
function menu_ondragleave(e){
    if(e.target.classList.contains("drag_and_drop_target_current")){
        e.target.classList.remove("drag_and_drop_target_current");
    }
}
function dragend(){
    var meineElemente = document.getElementsByClassName('Forum_Kategorie_head');

    for(var i = 0; i < meineElemente.length; i++) {
        if(meineElemente[i].classList.contains("drag_and_drop_target")) meineElemente[i].classList.remove("drag_and_drop_target");
    }
}
function dragstart(e){
    e.dataTransfer.setData("fromID", e.target.dataset.fromid);

    var meineElemente = document.getElementsByClassName('Forum_Kategorie_head');

    for(var i = 0; i < meineElemente.length; i++) {
        if(meineElemente[i] == e.target) continue;
        meineElemente[i].classList.add("drag_and_drop_target");
    }
}
function drop(e){
    let formID = e.dataTransfer.getData("fromID");
    let toID = e.target.dataset.fromid;

    var meineElemente = document.getElementsByClassName('Forum_Kategorie_head');

    for(var i = 0; i < meineElemente.length; i++) {
        if(meineElemente[i].classList.contains("drag_and_drop_target")) meineElemente[i].classList.remove("drag_and_drop_target");
    }

    var form_data = new FormData();

    form_data.append("formID", formID);
    form_data.append("toID", toID);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/einstellungen/assets/forum/Prioritat_Kategorie.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            loadProjektUnderPage('einstellungen', 'forum/forum_einstellungen.php')
        }
    });

}