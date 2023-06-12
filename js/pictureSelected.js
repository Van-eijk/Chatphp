
/******** Fonction pour gérer la selection de l'image ******* */

let iconCamera = document.getElementById("iconCamera");
let barreNotification = document.getElementById("notif");
let textNotif = document.getElementById("textNotif");

function pictureSelected(){
    barreNotification.style.display = "block";
    barreNotification.style.backgroundColor = "greenyellow";
    textNotif.innerHTML = "Photo sélectionnée";
    iconCamera.style.color = "greenyellow";

    setTimeout(function(){
        barreNotification.style.display = "none";
    }, 2000);
}