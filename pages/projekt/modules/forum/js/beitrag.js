var editor = "";
var edtior_melden_beitrag = "";
var edtior_melden_kommentar = "";
var modal = document.getElementById("myModal");
var modal_beitrag_verchieben = document.getElementById("Modal_beitrag_verschieben");
var Modal_kommentar = document.getElementById("Modal_kommentar");
var LastKommentarMelde = 0;

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == Modal_kommentar) {
        Modal_kommentar.style.display = "none";
    }
}
var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
    modal.style.display = "none";
}
var span = document.getElementsByClassName("close")[1];
span.onclick = function() {
    Modal_kommentar.style.display = "none";
}
var span = document.getElementsByClassName("close")[2];
span.onclick = function() {
    modal_beitrag_verchieben.style.display = "none";
}

function show_melde_moodal_beitrag(){
    document.getElementById('myModal').style.display = 'block';
    if(edtior_melden_beitrag == ""){
        ClassicEditor.create( document.querySelector( '#edtior_melden_beitrag' ) ).then( editortmp => {
            edtior_melden_beitrag = editortmp;
        });
    }
}
function show_melde_moodal_kommentar(){
    document.getElementById('Modal_kommentar').style.display = 'block';
    if(edtior_melden_kommentar == ""){
        ClassicEditor.create( document.querySelector( '#edtior_melden_kommentar' ) ).then( editortmp => {
            edtior_melden_kommentar = editortmp;
        });
    }
}
function createEditor(){
    if(!!document.getElementById("editor") && editor == ""){
        ClassicEditor.create( document.querySelector( '#editor' ) ).then( editortmp => {
            editor = editortmp;
        });
    }
}

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
        url: 'pages/projekt/modules/forum/assets/Toggle_close_beitrag.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            loadProjektUnderPage('forum', 'Beitrag.php?bid=' + beitrag);
        }
    });
}
function Delete_beitrag(beitrag, forum) {
    var form_data = new FormData();

    form_data.append("bid", beitrag);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/forum/assets/Delete_beitrag.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            loadProjektUnderPage('forum', 'BeitragsUbersicht.php?fid=' + forum);
        }
    });
}
function Mede_beitrag(beitrag){
    var form_data = new FormData();
    var grund = edtior_melden_beitrag.getData();

    form_data.append("bid", beitrag);
    form_data.append("grund", grund);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/forum/assets/Beitrag_Melden.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else {
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
            }


            if(response == "Beitrag gemeldet"){
                let ret = "<p class='modal_headline'>Vielen Dank</p>";
                ret += "<div class='modal_button_conatiner'><p>Du hast diesen Beitrag erfolgreich gemeldet. Es wird sich in kürze jemand für dieses Forum Verantwortlich um diesen Vorfall kümmern. Dein angebender Grund:</p></div>";
                ret += "<br><div class='modal_button_conatiner'>" + grund + "</div><br><br>";
                ret +=  "<div class='modal_button_conatiner'><button onclick='modal.style.display = \"none\";' class='button modal_button button_gray'>schlissen</button></div>";

                document.getElementById("modal-content").innerHTML = ret;
            }else {
                document.getElementById("feedback_hub").innerHTML = response;
                document.getElementById("feedback_hub").style.display = "block";
            }
        }
    });
}
function Mede_kommentar(){
    var form_data = new FormData();
    var grund = edtior_melden_kommentar.getData();

    form_data.append("bid", LastKommentarMelde);
    form_data.append("grund", grund);

    $.ajax({
        type: 'POST',
        url: 'pages/projekt/modules/forum/assets/Kommentar_Melden.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub_kommentar").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else {
                document.getElementById("feedback_hub_kommentar").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
            }


            if(response == "Beitrag gemeldet"){
                let ret = "<p class='modal_headline'>Vielen Dank</p>";
                ret += "<div class='modal_button_conatiner'><p>Du hast diesen kommentar erfolgreich gemeldet. Es wird sich in kürze jemand für dieses Forum Verantwortlich um diesen Vorfall kümmern. Dein angebender Grund:</p></div>";
                ret += "<br><div class='modal_button_conatiner'>" + grund + "</div><br><br>";
                ret +=  "<div class='modal_button_conatiner'><button onclick='Modal_kommentar.style.display = \"none\";' class='button modal_button button_gray'>schlissen</button></div>";

                document.getElementById("modal-content_kommentar").innerHTML = ret;
            }else {
                document.getElementById("feedback_hub_kommentar").innerHTML = response;
                document.getElementById("feedback_hub_kommentar").style.display = "block";
            }
        }
    });
}
createEditor();