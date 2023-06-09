<script>
        var positionMessageJS ;
</script>






<?php
    session_start();
    include('Database/config.php');

    if(isset($_SESSION['id']) && isset($_SESSION['pseudo'])){

        // On charge la page si les variables de session ont été créé

   
 ?>






    <?php 
        // On récupère la photo de profil de l'utilisateur

        $requettePhotoProfil = $connexionDB -> prepare('SELECT photo FROM membres WHERE id = :idUser');
        $requettePhotoProfil -> execute(array(
            'idUser' => $_SESSION['id']
        ));

        $resultatRequettePhotoProfil = $requettePhotoProfil -> fetch();
        if($resultatRequettePhotoProfil){
            $_SESSION['photoProfil'] = $resultatRequettePhotoProfil['photo'];
        }

        
    ?>






    <?php
        // script pour envoyer un message dans la base de donnéees

        if(isset($_POST['sendMessage'])){

            if(isset($_POST['messages'])){
                $messageUser = $_POST['messages'];
                /****  INSERTION DES INFORMATIONS DANS LA BASE DE DONNEES  ***** */

                $requetteEnvoieMessage = $connexionDB -> prepare('INSERT INTO discussion(pseudomembre,photomembre,messagemembre) VALUES (:pseudoM, :photoM, :messageM)');

                $requetteEnvoieMessage -> execute(array(
                    'pseudoM' => $_SESSION['pseudo'],
                    'photoM' => $_SESSION['photoProfil'],
                    'messageM' => $messageUser
                ));
            }
        }
    ?>



    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style/pc/home.css">
        <link rel="stylesheet" href="icons/css/all.css">
        <title>CHAT</title>
    </head>
    <body>
        <div class="mainhome">
            <div class="arriereplan">

            </div>
            <div class="mainchat">
                <div class="leftSide">
                    <div class="header-leftSide">
                        <div class="user-info">
                            <span class="photo-profil">
                                <img src="<?php echo $_SESSION['photoProfil']; ?>" alt="">

                            </span>

                            <p> <?php 
                                        echo(ucfirst(strtolower($_SESSION['pseudo']))) ; // On converti d'abord la chaine de caractère en minuscule, ensuite, on converti uniquement la première lettre en majuscule
                            ?></p>

                        </div>
                        <span class="icon-menu-general" id="iconMenuGeneral" onclick="showHideMenuGeneral()">
                            <svg viewBox="0 0 24 24" width="24" height="24" class=""><path fill="currentColor" d="M12 7a2 2 0 1 0-.001-4.001A2 2 0 0 0 12 7zm0 2a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 9zm0 6a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 15z"></path></svg>
                        </span>      

                    </div>

                    <div class="menu-content">
                        <div class="menu-general" id="menuGeneral">
                            <div class="item-menu" id="profile" onclick="afficherProfile()" style="display: none;">
                                <p>Profile</p>
                            </div>
                            <div class="item-menu" id="logOut">
                                <a href="logout.php"> Déconnexion</a>
                            </div>
                                
                        </div>
                        
                    </div>
                
                        
                    <div class="search-bar">
                        <form action="" class="form-search">
                            <input type="text" name="" id="search" placeholder="Search...">
                            <button type="reset" id="btnReset">
                                <i class="fa-sharp fa-solid fa-xmark"></i>
                            </button>
                            <button type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>

                    </div>
                    <div class="members-resultSearch">
                        <div class="members">


                            <?php 
                                // Récupération de la liste des membres depuis la base de données

                                $requetteListeMembres = $connexionDB -> query('SELECT pseudo, photo FROM membres ORDER BY pseudo');

                                while($resultatRequetteListeMembres = $requetteListeMembres -> fetch()){ ?>

                                <div class="item-chat">
                                    <span class="item-photo">
                                        <img src="<?php if(isset($resultatRequetteListeMembres['photo'])){
                                            echo($resultatRequetteListeMembres['photo']);
                                        }
                                        else{
                                            echo("pictures/iconDefault.png");
                                        } ?>" alt="user photo">
                                    </span>
                                    <div class="user">
                                        <p>
                                                <?php if(isset($resultatRequetteListeMembres['pseudo'])){
                                                echo(ucfirst(strtolower($resultatRequetteListeMembres['pseudo'])));
                                            }
                                            else{
                                                echo("Username");
                                            } ?>
                                        </p>
                                    </div>
                                </div>

                              
                            <?php
                                }
                                $requetteListeMembres -> closeCursor();
                            ?>
                            


                        </div>

                    </div>

                </div>

                <div class="rightSide">
                    <div class="content-chat" id="contentChat">
                        
                        <div class="header-chat">
                            <div class="info-destinataire">
                                <span class="photo-destinataire">
                                    <img src="pictures/iconDefault.png" alt="">

                                </span>
                                <p>Chat & Yamo</p>

                            </div>
                            <span class="menu-destinataire">
                                <svg viewBox="0 0 24 24" width="24" height="24" class=""><path fill="currentColor" d="M12 7a2 2 0 1 0-.001-4.001A2 2 0 0 0 12 7zm0 2a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 9zm0 6a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 15z"></path></svg>

                            </span>

                        </div>

                        <div class="discussion">
                            <!-- Messages entre l'émetteur et le recepteur -->


                            <?php 
                                
                                // Script pour récupérer les messages depuis la base de données

                                $requetteRecuperationMessage = $connexionDB -> query('SELECT * FROM discussion LIMIT 20');

                                while($resultatrequetteRecuperationMessage = $requetteRecuperationMessage -> fetch()){

                                    ?>

                                    
                                        <div class="mainMsg photo-message-left ">
                                            <div class="photo-left">
                        
                                                <img src="<?php echo($resultatrequetteRecuperationMessage['photomembre']); ?>" alt="">

                                            </div>
                                            <div class="message-left">
                                                <p class="message-left-name">
                                                    <?php echo($resultatrequetteRecuperationMessage['pseudomembre']); ?>
                                                </p>
                                                <p class="main-message"><?php echo($resultatrequetteRecuperationMessage['messagemembre']); ?></p>
                                                <p class="message-date"><?php echo($resultatrequetteRecuperationMessage['datemessage']); ?></p>
                                            </div>

                                        </div>

                                        
                                        


                               
                               
                               <?php
                                     }
                                

                            ?>

                            

                                <article class="photo-message-left" style=" display : none ;">
                                    <div class="photo-left">
                
                                        <img src="pictures/iconDefault.png" alt="">

                                    </div>
                                    <div class="message-left">
                                        <p class="message-left-name">
                                            Username
                                        </p>
                                        <p class="main-message">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis dolore possimus at earum! Voluptatum ipsum aut vero vel enim nostrum quisquam libero, facere amet numquam quos veritatis maiores ex nesciunt!</p>
                                        <p class="message-date">jeudi 01 juin 2023 à 22:24</p>
                                    </div>

                                </article>
                            



                            <div class="photo-message-right" style=" display : none ;">
                                <div class="photo-right">
                                    <img src="pictures/iconDefault.png" alt="">
                                </div>
                                <div class="message-right">
                                    <p class="main-message">Lorem ipsum, dolor sit </p>
                                    <p class="message-date">jeudi 01 juin 2023 à 22:24</p>

                                </div>

                            </div>






                            





                        </div>
                        

                        <form action="home.php" method="POST" enctype="multipart/form-data" class="footer-chat">

                            <button class="menu-file">
                                <i class="fa-solid fa-paperclip"></i>
                                
                            </button>
                            <textarea name="messages" id="msg" class="message" placeholder="Send message..." required autofocus></textarea>

                            <button type="submit" class="send-message" name="sendMessage">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>

                        </form>

                    </div>
                    

                    <div class="content-profile" id="contentProfile">
                    
                        <div class="content-profile-header">
                            <span >
                                <i class="fa-solid fa-arrow-left"></i>
                            </span>
                        
                            <div class="header-title">
                                <p>PROFILE</p>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

        <script src="js/scrollTextarea.js"></script>
        <script src="js/searchBar.js"></script>
        <script src="js/afficherMasquerMenuGeneral.js"></script>
        <script src="js/afficherProfile.js"></script>

        <script>
           /* var userJs = "<?php echo($_SESSION['pseudo']) ; ?>"
            var messageJs = document.getElementsByClassName(userJs);
            var attribut ;
            

           if(positionMessageJS){
                let i = 0;
                for(i=0 ; i< messageJs.length ; i++){
                   attribut = messageJs[i].getAttribute("title");
                   if(attribut == userJs ){
                        messageJs[i].classList.replace("photo-message-left","photo-message-right");
                   }

                   messageJs[i].style.backgroundColor= "red";
                }
            }
            
           // alert(userJs);

            //document.getElementById(userJs).style.backgroundColor = "red";

            */

            
        </script>
        
    </body>
    </html>







<?php 
    }
?>