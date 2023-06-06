
/******** Fonction pour gérer la selection de l'image ******* */

let iconCamera = document.getElementById("iconCamera");
let barreNotification = document.getElementById("notif");

function pictureSelected(){
    barreNotification.style.display = "block";
    iconCamera.style.color = "greenyellow";
    setTimeout(function(){
        barreNotification.style.display = "none";
    }, 2000);
}