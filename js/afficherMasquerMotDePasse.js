
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


/*   Confirmation du mot de passe */








let showPwdConfirmation = document.getElementById("showPwdConfirmation") ; // Affiché par defaut
let hidePwdConfirmation = document.getElementById("hidePwdConfirmation") ; // Masqué par defaut
let pwdConfirmation = document.getElementById("passwordConfirmation") ; // On récupère le mot de passe de confiramtion du formulaire
let showConfirmation = true ;

function afficherMasquerMotDePasseConfirmation(){
    if(showConfirmation){
        showPwdConfirmation.style.display = "none" ;
        hidePwdConfirmation.style.display = "block";
        pwdConfirmation.setAttribute("type","text");
        showConfirmation = false ;

    }else{
        showPwdConfirmation.style.display = "block" ;
        hidePwdConfirmation.style.display = "none";
        pwdConfirmation.setAttribute("type","password");
        showConfirmation = true ;

    }
    
   
   


}