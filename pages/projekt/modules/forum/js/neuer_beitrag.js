var editor = "";
ClassicEditor.create( document.querySelector( '#editor' ) ).then( editortmp => {
    editor = editortmp;
});

function start_neuen_beitrag(name, forum){
    let inhalt = editor.getData();

    var form_data = new FormData();

    form_data.append("name", name);
    form_data.append("inhalt", inhalt);
    form_data.append("forum", forum);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/forum/assets/Beitrag_erstellen.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
            }

            if(response.startsWith("Beitrag angelegt")){
                let arr_res = response.split(";;");
                beitrag = arr_res[1];

                loadProjektUnderPage('forum', 'Beitrag.php?bid=' + beitrag);
            }else {
                document.getElementById("feedback_hub").innerHTML = response;
                document.getElementById("feedback_hub").style.display = "block";
            }
        }
    });
}
