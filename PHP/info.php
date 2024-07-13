<?php
require('./../PHP/class/Connexion.php') ;

if(isset($_GET['id'])){
    $id = $_GET['id'] ;
    $connexion = new Connexion() ;

    $voiture = $connexion->prepareOne("gestion_vehicule" , "id" , $id) ;
}

?>