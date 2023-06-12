<script>
    /***  Déclaration des variables js */

    let erreurIdentifiantJs = false;
</script>





<?php
    include('Database/config.php');
    session_start();

 ?>

<?php 

    if(isset($_POST['login'])){
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
        $password = sha1($password);
    
        $requetteLogin = $connexionDB -> prepare('SELECT id FROM membres WHERE pseudo = :pseu AND motdepasse = :pass');
        $requetteLogin -> execute(array(
            'pseu' => $pseudo,
            'pass' => $password
        ));
    
        $resultatRequetteLogin = $requetteLogin -> fetch();
    
        if($resultatRequetteLogin){
           
            $_SESSION['id'] = $resultatRequetteLogin['id'];
            $_SESSION['pseudo'] = $pseudo ;

            header("location:home.php");
            exit;

            //echo $_SESSION['id'] . " " . $_SESSION['pseudo'];

    
        }
        else{
            $erreurIdentifiant = "Pseudo ou mot de passe incorrecte";
           // echo $erreurIdentifiant ; ?>

           <script>
                erreurIdentifiantJs = true ;
           </script>
        <?php 
            }
    }



   
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/pc/index.css">
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
                    
                </p>
            </div>


            <h1>CHAT & YAMO</h1>
            <span class="icon-user">
                <i class="fa-solid fa-circle-user">

                </i>
            </span>

            <form action="index.php" method="POST">

                <div class="pseudo">
                    <span><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="pseudo" autofocus id="pseudo" autocomplete="OFF" placeholder="Pseudo" required><br>
                </div>

                <div class="password">
                    <span><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" id="password" placeholder="Mot de passe" required><br>
                    <span class="iconPwd" onclick="afficherMasquerMotDePasse()">
                        <i id="showPwd" class="fa-solid fa-eye"></i>
                        <i id="hidePwd" class="fa-solid fa-eye-slash"></i>
                    </span>

                </div>

                <div class="sub">
                    <input type="submit" name="login" value="CONNEXION">
                </div>

                
            </form>

            <a href="">Mot de passe oublié ?</a>
            <a class="new-compte" href="register.php">
                <p>CREER UN COMPTE</p>
            </a>
            

        </div>
    </div>

   
    <script src="js/afficherMasquerMotDePasse.js"></script>
    <script src="js/afficherBarreNotification.js"></script>
    <script src="js/masquerBarreNotification.js"></script>


    <script>
        if(erreurIdentifiantJs){
            afficherBarreNotification();
            document.getElementById("notif").style.backgroundColor = "red";
            document.getElementById("textNotif").innerHTML = "Pseudo ou mot de passe incorrect ";
            masquerBarreNotification();
            

        }
    </script>
</body>
</html>