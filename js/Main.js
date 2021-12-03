
function ShowDropDown(){
    document.getElementById("DropdownUserMenu").style.display = "Block";
}
function DiesableDropDown(){//DropdownUserMenu, LeisteOben
    document.getElementById("DropdownUserMenu").style.display = "none";
}
function openbar(safemode = false){
    let element = document.getElementById("LeisteLinks");
    let main = document.getElementById("MainSek_container");

    alert(element.style.fff);

    if(element.style.display == "none"){
        element.style.display = "block";
        main.style.display = "none";
    }else {
        element.style.display = "none";
        main.style.display = "block";
    }
}