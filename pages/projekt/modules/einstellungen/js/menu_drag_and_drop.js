function dragover(e){
    e.preventDefault();
}
function dragstart(e){
    e.dataTransfer.setData("fromID", e.target.dataset.fromid);
}
function drop(e){
    let formID = e.dataTransfer.getData("fromID");
    let toID = e.target.dataset.fromid;

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