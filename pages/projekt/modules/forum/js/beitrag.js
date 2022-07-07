var editor = "";
ClassicEditor.create( document.querySelector( '#editor' ) ).then( editortmp => {
    editor = editortmp;
},{
    ckfinder: {
        uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
    }
} )

function start_neuen_kommentar(name, beitrag) {
    let inhalt = editor.getData();

    var form_data = new FormData();

    form_data.append("name", name);
    form_data.append("inhalt", inhalt);
    form_data.append("beitrag", beitrag);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/forum/assets/Neuer_Kommentar.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
            }

            if(response == "Kommentar gepostet"){
                loadProjektUnderPage('forum', 'Beitrag.php?bid=' + beitrag);
            }else {
                document.getElementById("feedback_hub").innerHTML = response;
                document.getElementById("feedback_hub").style.display = "block";
            }
        }
    });
}
function Update_like(kommentar, beitrag) {
    var form_data = new FormData();

    form_data.append("kid", kommentar);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/forum/assets/Update_like.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            loadProjektUnderPage('forum', 'Beitrag.php?bid=' + beitrag);
        }
    });
}
function toggle_close_beitrag( beitrag) {
    var form_data = new FormData();

    form_data.append("bid", beitrag);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/forum/assets/toggle_close_beitrag.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            loadProjektUnderPage('forum', 'Beitrag.php?bid=' + beitrag);
        }
    });
}