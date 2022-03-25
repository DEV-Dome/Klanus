
function newProjeckt(name, kurzel, beschreibung, type){
    var form_data = new FormData();

    form_data.append("name", name);
    form_data.append("kurzel", kurzel);
    form_data.append("beschreibung", beschreibung);
    form_data.append("type", type);

    $.ajax({
        type: 'POST',
        url: 'acp/php/projekt/newProjekt.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            let str = response.split(";;;");

            if(response.startsWith("<erro>")){
                document.getElementById("feedback_hub").style.backgroundColor = "rgba(229, 51, 51, 0.25)";
            }else if(response == ""){
                return;
            }else {

                document.getElementById("feedback_hub").style.backgroundColor = "rgba(69, 255, 88, 0.25)";
                joinProjekt(str[1]);
            }

            document.getElementById("feedback_hub").innerHTML = str[0];
            document.getElementById("feedback_hub").style.display = "block";
        }
    });
}