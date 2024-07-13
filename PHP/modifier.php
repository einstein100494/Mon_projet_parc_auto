<?php

    require('connexion.php') ;

    $id_vehicule = $_GET['id'] ;
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
    $date = date("Y-m-d") ;
    $heure = date("H:i:s") ;
    
    $heure_actuel = new DateTime($heure) ;
    $heure_actuel->modify("+1 hours")  ;

    $date_actuel = $date .' '. $heure_actuel->format("H:i:s") ;

    $modifierVehicule = $bdd->prepare('UPDATE gestion_vehicule SET immatriculation = ? , marque = ? , type = ? , nombre_de_place = ? ,date_de_circulation = ? , combustion = ? , lieu = ? , sercice = ? , nom_utilisateur = ? ,couleur = ? , update_at = ?  WHERE id = ?') ;
    $modifierVehicule->execute([$immatriculation,$marque,$type,$nbr_place,$date_de_circulation,$combustion,$Lieu,$Service,$utilisateur,$couleur, $date_actuel,$id_vehicule]) ;

    if($modifierVehicule)
    {
        $cookie_name = "success";
        $cookie_value = "Le vehicule a ete modifier !!!";
        setcookie($cookie_name , $cookie_value , time() + 1 , "/");
    }else{
        $cookie_name = "error";
        $cookie_value = "Le vehicule n'a pas ete modifier !!!";
        setcookie($cookie_name , $cookie_value , time() + 1 , "/");
    }

    header('location: ./../accueil/modifier.php?id=' . $id_vehicule . '') ;

?>