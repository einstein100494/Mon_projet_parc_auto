<?php

require('connexion.php') ;

$id = $_GET['id'] ;
$actif = false ;

$update = $bdd->prepare('UPDATE gestion_vehicule SET actif = ? WHERE id = ? ') ;
$update->execute([$actif , $id]) ;

// $supprimerVehicule = $bdd->prepare('DELETE FROM gestion_vehicule WHERE id = ?') ;
// $supprimerVehicule->execute([$id]) ;

$cookie_name = "success";
$cookie_value = "Le vehicule a ete envoye dans le corbeille !!!";
setcookie($cookie_name , $cookie_value , time() + 1 , "/");

header('location: ../accueil/list_vehicule.php') ;
?>