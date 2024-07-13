<?php
require('./class/Connexion.php') ;

$id = $_GET['id'] ;

$connexion = new Connexion() ;
$connexion->daleteOne("gestion_vehicule" , "id" , $id) ;


$cookie_name = "success";
$cookie_value = "Le vehicule a ete supprimer definitivement !!!";
setcookie($cookie_name , $cookie_value , time() + 1 , "/");

header('location: ../accueil/corbeille.php') ;

?>