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
            <h1>INSCRIPTION</h1>
           <div>
                <div class="icon-user">
                    <img src="pictures/iconDefault.png" alt="">
                </div>
                <label class="camera" for="userPicture">
                    <i class="fa-solid fa-camera"></i>
                </label>
           </div>

            <form action="">

                <!--  Ici on recupère la photo dans l'ordinateur -->

                <input type="file" name="userPicture" id="userPicture">



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
                    <input type="submit" value="INSCRIPTION">
                </div>

                
            </form>

            <div class="connect">
                <p>Avez-vous déjà un compte ?</p> <a href="index.php"> connectez vous !</a>
            </div>
           
            

        </div>
    </div>

   
    <script src="js/afficherMasquerMotDePasse.js"></script>
</body>
</html>