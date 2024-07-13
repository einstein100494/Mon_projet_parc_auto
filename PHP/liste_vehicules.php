<?php
require('./../PHP/class/Connexion.php') ;
$connexion = new Connexion() ;
$table = "gestion_vehicule" ;
$vehiculesRecuperer = $connexion->prepareAny($table , "actif" , 1) ;
?>