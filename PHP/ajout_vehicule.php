<?php
session_start() ;
require('./class/Vehicule.php') ;

if(isset($_GET['valider']))
{

    $immatriculation = $_GET["immatriculation"] ;
    $nbr_place = $_GET["nbr_place"] ;
    $marque = $_GET["marque"] ;
    $date_de_circulation = $_GET["date_de_circulation"] ;
    $type = $_GET["type"] ;
    $Lieu = $_GET["Lieu"] ;
    $Service = $_GET["Service"] ;
    $couleur = $_GET["couleur"] ;
    $utilisateur = $_GET["utilisateur"] ;
    $combustion = $_GET["combustion"] ;
    $actif = 1 ;
    $date = date("Y-m-d") ;
    $heure = date("H:i:s") ;
    
    $heure_actuel = new DateTime($heure) ;
    $heure_actuel->modify("+1 hours")  ;

    $date_actuel = $date .' '. $heure_actuel->format("H:i:s") ;

    $vehicule = new Vehicule() ;
    $vehicule->ajout_vehicule($immatriculation,$marque,$type,$nbr_place,$date_de_circulation,$combustion , $Lieu , $Service , $utilisateur , $couleur , $actif , $date_actuel) ;


}

?>