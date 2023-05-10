/* Ce bout de code permet de gérer le dynamisme de la balise textarea qui permet d'envoyer le message*/

let mess= document.getElementById("msg");

mess.addEventListener('keyup', e =>{
    mess.style.height = "25px";
    let ecHeight = e.target.scrollHeight;
    mess.style.height = `${ecHeight}px`;

}) ;