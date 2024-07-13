<?php

$search = $_GET['search'] ;

require('connexion.php') ;

$recupererLesVehicules = $bdd->query('SELECT * FROM gestion_vehicule WHERE immatriculation  LIKE "%'.$search.'%" ') ;
$vehiculesRecuperer = $recupererLesVehicules->fetchAll(PDO::FETCH_OBJ) ;

?>