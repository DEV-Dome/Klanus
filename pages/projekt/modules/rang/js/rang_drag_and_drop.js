function allowDrop(ev) {
    ev.preventDefault();
    //
    /*if(ev.target.classList.contains("dragtaget")){
        ev.target.classList.add("color-green");

        setTimeout(function() {
            ev.target.classList.remove("color-green");
        }, 500);
    }else {
        ev.target.classList.add("bg-red");

        setTimeout(function() {
            ev.target.classList.remove("bg-red");
        }, 500);
    }*/
}


function drop(ev) {
    //zeihe element: dragElement
    //ziel: ev.target

    if(ev.target.classList.contains("dragtaget")){
        idTarget = ev.target.id;
        iDBase = dragElement.id;

        var form_data = new FormData();

        form_data.append('baseID', iDBase);
        form_data.append('targetID', idTarget);

        $.ajax({
            type: 'POST',
            url: 'pages/projekt/modules/rang/assets/changePrioritat.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                if(response == "rang getauscht"){
                    loadProjektPage("rang");
                }
            }
        });
    }

}

function dragstart(ev){
    dragElement = ev.target;
}