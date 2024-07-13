<?php

require('connexion.php') ;

$id = $_GET['id'] ;
$actif = true ;

$update = $bdd->prepare('UPDATE gestion_vehicule SET actif = ? WHERE id = ? ') ;
$update->execute([$actif , $id]) ;

header('location: ../accueil/corbeille.php') ;
?>