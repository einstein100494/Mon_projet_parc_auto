<?php
require('connexion.php') ;
$count = $bdd->prepare('SELECT count(id) as cpt FROM gestion_vehicule WHERE actif = false');
$count->setFetchMode(PDO::FETCH_ASSOC) ;
$count->execute() ; 
$tcount = $count->fetchAll() ;

if(isset($_GET['page'])) $page = $_GET['page'] ;
if(empty($page)) $page = 1 ;
$nbr_par_page = 3 ;
$nbr_de_page = ceil($tcount[0]['cpt'] / $nbr_par_page) ;
$debut = ($page - 1) * $nbr_par_page ;

if($page > $nbr_de_page) header('location: ./list_vehicule.php') ;

$recupererLesVehicules = $bdd->query("SELECT * FROM gestion_vehicule WHERE actif = false LIMIT $debut , $nbr_par_page") ;
$vehiculesRecuperer = $recupererLesVehicules->fetchAll(PDO::FETCH_OBJ) ;
?>