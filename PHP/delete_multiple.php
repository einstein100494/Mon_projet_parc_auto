<?php
require('connexion.php') ;

if(isset($_GET['id']) AND !empty($_GET['id'])){

    $explode = explode(',' , $_GET['id']) ;

    for ($i=0; $i < count($explode); $i++) { 
        $delete = $bdd->prepare("DELETE FROM gestion_vehicule WHERE id = ?") ;
        $delete->execute([$explode[$i]]) ;
    }

    $cookie_name = "success";
    $cookie_value = "Tous les cages cocher sont tous supprimer !!!";
    setcookie($cookie_name , $cookie_value , time() + 1 , "/");

    header('location: ./../accueil/list_vehicule.php') ;

}else{
    header('location: ./../accueil/list_vehicule.php') ;
}


?>