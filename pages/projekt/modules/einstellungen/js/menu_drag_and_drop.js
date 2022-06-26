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
function dragstart(e){
    e.dataTransfer.setData("fromID", e.target.dataset.fromid);

    var meineElemente = document.getElementsByClassName('menu_item');

    for(var i = 0; i < meineElemente.length; i++) {
        if(meineElemente[i] == e.target) continue;
        meineElemente[i].classList.add("drag_and_drop_target");
    }
}
function drop(e){
    let formID = e.dataTransfer.getData("fromID");
    let toID = e.target.dataset.fromid;

    var meineElemente = document.getElementsByClassName('drag_and_drop_target');

    for(var i = 0; i < meineElemente.length; i++) {
        meineElemente[i].classList.remove("drag_and_drop_target");
    }

    var form_data = new FormData();

    form_data.append("fromid", formID);
    form_data.append("toid", toID);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/einstellungen/assets/menu/ChancePrioritat.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            loadbar(1);
            loadProjektUnderPage('einstellungen', 'menu_einstellungen.php')
        }
    });
}
