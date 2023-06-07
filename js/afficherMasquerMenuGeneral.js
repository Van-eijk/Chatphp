let menuGeneral = document.getElementById("menuGeneral");
let iconMenuGeneral = document.getElementById("iconMenuGeneral");

let showMenu = false;

function showHideMenuGeneral(){
    if(!showMenu){
        menuGeneral.style.display = "block";
        iconMenuGeneral.style.backgroundColor = "var(--colorHeaderChat)";
        //iconMenuGeneral.style.borderRadius = 50 + "%";
        showMenu = true ;
    }
    else{
        menuGeneral.style.display = "none";
        iconMenuGeneral.style.backgroundColor = "var(--colorBody)";
        showMenu = false ;

    }

}


/*window.onclick = function(){
    menuGeneral.style.display = "none";

}*/