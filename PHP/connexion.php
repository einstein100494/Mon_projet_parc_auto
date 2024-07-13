<?php
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=automobile' , 'root' , '') ;
    }catch(PDOException $erreur){
        die('une erreure :' . $erreur->getMessage()) ;
    }
?>