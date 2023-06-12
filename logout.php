<?php

    session_start();


    $_SESSION = array(); // Suppression des variables de session

    session_destroy(); // Suppression de la session

    header("location:index.php");
    exit;

    
    
