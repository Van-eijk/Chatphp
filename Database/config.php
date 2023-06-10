<?php

    try{
        $connexionDB = new PDO('mysql:host=localhost;dbname=chatyamo','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e){
        echo (" Erreur : $e -> getMessage() ");
    }