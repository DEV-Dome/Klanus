
function userJoinNewProjeckt(pid){
    var form_data = new FormData();

    form_data.append("pid", pid);


    $.ajax({
        type: 'POST',
        url: 'acp/php/projekt/userJoinProjekt.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            joinProjekt(pid);
        }

    });
}