function saveImage(ele, out, pbReload){
    var form_data = new FormData();
    form_data.append("img", ele.files[0]);

    $.ajax({
        type: 'POST',
        url: 'php/user/changeSettings/NewImage.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            document.getElementById(out).innerHTML = response;
            document.getElementById(out).style.display = "block";

            //Art der meeldung bestimmen [rot; grun];
            if(response == "Du hast dein Profiel Bild geändert."){
                document.getElementById(out).classList.add("alert-success");
                document.getElementById(out).classList.remove("alert-danger");

                loadProfielImage(pbReload);
            }else {
                document.getElementById(out).classList.remove("alert-success");
                document.getElementById(out).classList.add("alert-danger");
            }

            // nach 5 Sekunden nachricht ausblenden
            setTimeout(function() {
                document.getElementById(out).style.display = "none";
            }, 5000);
        }
    });
}