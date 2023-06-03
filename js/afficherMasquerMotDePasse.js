
/***** Ce petit bout de code nous permet de masquer ou d'afficher le mot de passe du formulaire lors de la connexion ******* */

let showPwd = document.getElementById("showPwd") ; // Affiché par defaut
let hidePwd = document.getElementById("hidePwd") ; // Masqué par defaut
let pwd = document.getElementById("password") ; // On récupère le mot de passe du formulaire
let show = true ;

function afficherMasquerMotDePasse(){
    if(show){
        showPwd.style.display = "none" ;
        hidePwd.style.display = "block";
        pwd.setAttribute("type","text");
        show = false ;

    }else{
        showPwd.style.display = "block" ;
        hidePwd.style.display = "none";
        pwd.setAttribute("type","password");
        show = true ;

    }
    
   
   


}