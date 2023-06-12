<script>
    /******* ******* */

    let erreurComparaisonMotDePasseJs = false ;
    let erreurPseudoJs = false ;
</script>





<?php

    include 'Database/config.php'; // Connexion à la base de données

    /******  Déclaration des variables    ***** */

    $erreurComparaisonMotDePasse = ""; // Variable pour compararer les mots de passe
    $erreurConfirmationMotDePasse = ""; // Variable pour confirmer les 2 mots de passe
    $erreurMotDePasse = ""; // Variable pour vérifier le mot de passe
    $erreurMail =""; // Variable pour vérifier l'adresse email
    $erreurPseudo = ""; // Variable pour vérifier le pseudo

    $cheminPhotoTemporaire = ""; // Chemin temporaire de la photo
    $nomFichier = "iconDefault.png";  // Photo par defaut
    $dossierSauvegardePhoto = 'pictures/'; // Dossier pour sauvegarder les images sur le serveur
    $cheminDefinitifPhoto = ""; // Chemin definiif pour sauvegarder la photo sur le serveur
    $cheminDefinitifPhoto = $dossierSauvegardePhoto . $nomFichier ;
    /*******  Récupération des données entrées par l'utilisateur ***** */

    //$_FILES['userPicture'];
    $pseudoFormulaire;
    $emailFormulaire;
    $motDePasseFormulaire;
    $confirmationMotDePasseFormulaire;


    if(isset($_POST['inscription'])){

        $pseudoFormulaire = htmlspecialchars($_POST['pseudo']); // On récupère le pseudo du formulaire
        $emailFormulaire = htmlspecialchars($_POST['mail']);  // On récupère l'email du formulaire
        $motDePasseFormulaire = htmlspecialchars($_POST['password']); // On récupère le mot de passe du formulaire
        $confirmationMotDePasseFormulaire = htmlspecialchars($_POST['passwordConfirmation']);

        if(isset($pseudoFormulaire)){
            if(isset($emailFormulaire)){
                if(isset($motDePasseFormulaire)){
                    if(isset($confirmationMotDePasseFormulaire)){
                        if($motDePasseFormulaire == $confirmationMotDePasseFormulaire){
                            $confirmationMotDePasseFormulaire = sha1($confirmationMotDePasseFormulaire); // On crypte le mot de passe entrée par l'utilisateur

                            /**** Gestion de la photo de profil ****** */

                            
                            if(isset($_FILES['userPicture'])){
                                if($_FILES['userPicture']['error'] == 0){

                                    // Vérification de l'extension du fichier
                                    $infoFichier = pathinfo($_FILES['userPicture']['name']);
                                    $extension_upload = $infoFichier['extension'] ; // On récupère l'extension du fichier envoyé par l'utilisateur

                                    /* La fonction pathinfo renvoie un array contenant entre autres l'extension du fichier dans
                                        $infosfichier['extension']. On stocke ça dans une variable $extension_upload.
                                        Une fois l'extension récupérée, on peut la comparer à un tableau d'extensions autorisées (un array) et vérifier si l'extension
                                        récupérée fait bien partie des extensions autorisées à l'aide de la fonction in_array(). 
                                    */
        
                                    // Ainsi, on crée la liste des extension autorisées
                    
                                    $extension_autorisees = ['jpg','jpeg','png'];

                                    // Vérification des extensions

                                    if(in_array($extension_upload,$extension_autorisees)){
                                        // Nous allons ainsi redéfinir le nom complet du fichier

                                        $cheminPhotoTemporaire = $_FILES['userPicture']['tmp_name']; // Récupération de l'emplacement temporaire du fichier
                                        $dateDuJour = date("d_m_Y_H_i_s"); // Récupération de la date du jour pour définir le nom du fichier
                                        $nomFichier = basename($_FILES['userPicture']['name']); // Récupération du nom d'origine du fichier
                                        $nomFichier = $pseudoFormulaire . $dateDuJour ;

                                    }
                                }

                            }


                            // Le chemin définitif est égale au chemin du repertoire plus le nom du fichier
                            $cheminDefinitifPhoto = $dossierSauvegardePhoto . $nomFichier ; // Chemin complet de la photo qui sera sauvegardé sur le serveur


                            /*********** Vérifions si le pseudo entré par l'utilisateur existe déjà dans la base de données  ******** */

                            $requetteVerificationPseudo = $connexionDB -> prepare('SELECT * FROM membres WHERE pseudo = :pseudo');
                            $requetteVerificationPseudo -> execute(array(
                                'pseudo' => $pseudoFormulaire
                            ));

                            $resultatVerificationPseudo = $requetteVerificationPseudo -> fetch();

                            if($resultatVerificationPseudo){
                                $erreurPseudo = "$pseudoFormulaire est déjà utilisé, veuillez choisir un autre pseudo"; ?>
                                <script>
                                    erreurPseudoJs = true ;
                                </script>

                            <?php }
                            else{

                                /****  INSERTION DES INFORMATIONS DANS LA BASE DE DONNEES  ***** */

                                $requette = $connexionDB -> prepare('INSERT INTO membres(pseudo,photo,email,motdepasse) VALUES (:pseudo, :photo, :email, :motdepasse)');

                                $requette -> execute(array(
                                    'pseudo' => $pseudoFormulaire,
                                    'photo' => $cheminDefinitifPhoto,
                                    'email' => $emailFormulaire,
                                    'motdepasse' => $confirmationMotDePasseFormulaire
                                ));

                                move_uploaded_file($cheminPhotoTemporaire,$cheminDefinitifPhoto); // Sauvegarde de la photo sur le serveur

                                $confirmationInscription = "Compte créé avec succès " ;

                                header("location:registersucces.php");
                                exit;

                            }

                        }
                        else{
                            $erreurComparaisonMotDePasse = "Les mots de passe sont différents" ; 

                            //echo $erreurComparaisonMotDePasse ;?>
                            <script>
                                    erreurComparaisonMotDePasseJs = true;
                            </script>

                       <?php }
                    }
                    else{
                        $erreurConfirmationMotDePasse = "Veuillez confirmer le mot de passe";
                    }
                    
                }
                else{
                    $erreurMotDePasse = "Veuillez entrer le mot de passe";
                }
            }
            else{
                $erreurMail = "Veuillez entrer votre e-mail";
            }
        }
        else{
            $erreurPseudo = "Veuillez entrer votre Pseudo";
        }
    }



?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/pc/register.css">
    <link rel="stylesheet" href="icons/css/all.css">
    <title>CHAT</title>
</head>
<body>
    <div class="mainhome">
        <div class="arriereplan">

        </div>
        <div class="mainchat">

            <!--  Barre de notification   -->

            <div class="barre-notification" id="notif">
                <p class="notification" id="textNotif">
                    <?php 
                        if(isset($erreurPseudo)){
                            echo $erreurPseudo ;
                        }
                     ?>
                </p>
            </div>

            <h1>INSCRIPTION</h1>
           <div>
                <div class="icon-user">
                    <img src="pictures/iconDefault.png" alt="">
                </div>
                <label class="camera" for="userPicture">
                    <i class="fa-solid fa-camera" id="iconCamera"></i>
                </label>
           </div>

            <form action="register.php" method="POST" enctype="multipart/form-data">

                <!--  Ici on recupère la photo dans l'ordinateur -->

                <input type="file" name="userPicture" id="userPicture" onchange="pictureSelected()">



                <div class="pseudo">
                    <span><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="pseudo" autofocus id="pseudo" autocomplete="OFF" placeholder="Pseudo" required><br>
                </div>

                <div class="mail">
                    <span><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="mail" autofocus id="mail" autocomplete="OFF" placeholder="E-mail" required><br>
                </div>

                <div class="password">
                    <span><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" id="password" placeholder="Mot de passe" required><br>
                    <span class="iconPwd" onclick="afficherMasquerMotDePasse()">
                        <i id="showPwd" class="fa-solid fa-eye"></i>
                        <i id="hidePwd" class="fa-solid fa-eye-slash"></i>
                    </span>

                </div>

                <div class="password">
                    <span><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="passwordConfirmation" id="passwordConfirmation" placeholder="Confirmez le mot de passe" required><br>
                    <span class="iconPwd" onclick="afficherMasquerMotDePasseConfirmation()">
                        <i id="showPwdConfirmation" class="fa-solid fa-eye"></i>
                        <i id="hidePwdConfirmation" class="fa-solid fa-eye-slash"></i>
                    </span>

                </div>

                <div class="sub">
                    <input type="submit" name="inscription" value="INSCRIPTION">
                </div>

                
            </form>

            <div class="connect">
                <p>Avez-vous déjà un compte ?</p> <a href="index.php"> connectez vous !</a>
            </div>
           
            

        </div>
    </div>

   
    <script src="js/afficherMasquerMotDePasse.js"></script>
    <script src="js/pictureSelected.js"></script>
    <script src="js/afficherBarreNotification.js"></script>
    <script src="js/masquerBarreNotification.js"></script>
   
    <script>
         if(erreurComparaisonMotDePasseJs){
            afficherBarreNotification();
            document.getElementById("notif").style.backgroundColor = "red";
            document.getElementById("textNotif").innerHTML = "Désolé, les mots de passe sont différents";
            masquerBarreNotification();

        }

        if(erreurPseudoJs){
            afficherBarreNotification();
            document.getElementById("notif").style.backgroundColor = "red";
            masquerBarreNotification();

        }
    </script>

</body>
</html>