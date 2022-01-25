
function ShowDropDown(){
    document.getElementById("DropdownUserMenu").style.display = "Block";
}
function DiesableDropDown(){//DropdownUserMenu, LeisteOben
    document.getElementById("DropdownUserMenu").style.display = "none";
}
function openbar(safemode = false){
    let element = document.getElementById("LeisteLinks");
    let main = document.getElementById("MainSek_container");


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