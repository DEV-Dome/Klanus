function chanceVerfiziert(pid){
    var form_data = new FormData();

    form_data.append("pid", pid);

    $.ajax({
        type: 'POST',
        url: 'php/projekt/chanceVerifiziert.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            console.log(response)
            loadMainPage("projekt/projekt.php");
        }
    });
}