<?php

include '../Database/config.php'; // Connexion à la base de données

/******  Déclaration des variables    ***** */

$erreurComparaisonMotDePasse = ""; // Variable pour compararer les mots de passe
$erreurConfirmationMotDePasse = ""; // Variable pour confirmer les 2 mots de passe
$erreurMotDePasse = ""; // Variable pour vérifier le mot de passe
$erreurMail =""; // Variable pour vérifier l'adresse email
$erreurPseudo = ""; // Variable pour vérifier le pseudo

$cheminPhotoTemporaire = ""; // Chemin temporaire de la photo
$nomFichier = "iconDefault.png";  // Photo par defaut
$dossierSauvegardePhoto = '../pictures/'; // Dossier pour sauvegarder les images sur le serveur
$cheminDefinitifPhoto = ""; // Chemin definiif pour sauvegarder la photo sur le serveur
$cheminDefinitifPhoto = $dossierSauvegardePhoto . $nomFichier ;
/*******  Récupération des données entrées par l'utilisateur ***** */

//$_FILES['userPicture'];

$pseudoFormulaire = htmlspecialchars($_POST['pseudo']); // On récupère le pseudo du formulaire
$emailFormulaire = htmlspecialchars($_POST['mail']);  // On récupère l'email du formulaire
$motDePasseFormulaire = htmlspecialchars($_POST['password']); // On récupère le mot de passe du formulaire
$confirmationMotDePasseFormulaire = htmlspecialchars($_POST['passwordConfirmation']);


if(isset($_POST['inscription'])){
    if(isset($pseudoFormulaire)){
        if(isset($emailFormulaire)){
            if(isset($motDePasseFormulaire)){
                if(isset($confirmationMotDePasseFormulaire)){
                    if($motDePasseFormulaire == $confirmationMotDePasseFormulaire){
                        $confirmationMotDePasseFormulaire = sha1($confirmationMotDePasseFormulaire);

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
                            $erreurPseudo = "$pseudoFormulaire déjà utilisé, veuillez choisir un autre";

                        }
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

                        }

                    }
                    else{
                        $erreurComparaisonMotDePasse = "Les mots de passe sont différents" ;
                        //echo $erreurComparaisonMotDePasse ;
                    }
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