
let contentChat = document.getElementById("contentChat");
let contentProfile = document.getElementById("contentProfile");

function afficherProfile(){
    contentChat.style.display = "none";
    contentProfile.style.display = "block";
}


/********Masquer le menu  ******** */


function masquerMenu(){
    contentChat.style.display = "block";
    contentProfile.style.display = "none";

}