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
            <h1>CHAT & YAMO</h1>
            <span class="icon-user">
                <i class="fa-solid fa-circle-user">

                </i>
            </span>

            <form action="">

                <div class="pseudo">
                    <span><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="pseudo" autofocus id="pseudo" autocomplete="OFF" placeholder="Pseudo"><br>
                </div>

                <div class="password">
                    <span><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" id="password" placeholder="Mot de passe"><br>
                    <span class="iconPwd" onclick="afficherMasquerMotDePasse()">
                        <i id="showPwd" class="fa-solid fa-eye"></i>
                        <i id="hidePwd" class="fa-solid fa-eye-slash"></i>
                    </span>

                </div>

                <div class="sub">
                    <input type="submit" value="CONNEXION">
                </div>

                
            </form>

            <a href="">Mot de passe oublié ?</a>
            <a class="new-compte" href="">
                <p>CREER UN COMPTE</p>
            </a>
            

        </div>
    </div>

   
    <script src="js/afficherMasquerMotDePasse.js"></script>
</body>
</html>