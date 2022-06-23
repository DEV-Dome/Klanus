function loadbar(idProjekt){
    var form_data = new FormData();

    form_data.append("projekt", idProjekt);

    $.ajax({
        type: 'POST',
        url: 'php/user/Elements/MenuBar.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            document.getElementById("LeisteLinks").innerHTML = response;
        }
    });
}


function ShowDropDown(){
    if(!(!!document.getElementById("DropdownUserMenu"))) return;

    document.getElementById("DropdownUserMenu").style.display = "Block";
}
function DiesableDropDown(){//DropdownUserMenu, LeisteOben
    if(!(!!document.getElementById("DropdownUserMenu"))) return;

    document.getElementById("DropdownUserMenu").style.display = "none";
}
function openbar(safemode = false){
    let element = document.getElementById("LeisteLinks");
    let main = document.getElementById("MainSek_container");

    if(!(!!element) || !(!!main)){
        return;
    }
    if(element.classList.contains("LeisteLinkSehenJa")){
        element.classList.add("LeisteLinkSehenNein");
        element.classList.remove("LeisteLinkSehenJa");

        main.style.display = "block";
    }else {
        element.classList.add("LeisteLinkSehenJa");
        element.classList.remove("LeisteLinkSehenNein");

        main.style.display = "none";
    }
}
function addScript(src) {
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.src = src;
    document.getElementsByTagName('head')[0].appendChild(s);
    return s;  // to remove it later
}
