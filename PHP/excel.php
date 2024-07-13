<?php 
require('./connexion.php') ;

$obtenirTousLesVehicules = $bdd->query('SELECT * FROM gestion_vehicule') ;
$vehiculesObtenues = $obtenirTousLesVehicules->fetchAll(PDO::FETCH_OBJ) ;
if(file_exists('Fichier') == false){
    mkdir('Fichier') ;
}
$fichier = 'Fichier/excel-' . date('hsi') . '.csv' ;

if(file_exists($fichier) == false)
{
    fopen($fichier , 'w+') ;
    $fopen = fopen($fichier , 'w') ;
    $i = 0 ;
    foreach($vehiculesObtenues as $vehicule)
    {
        $i = $i + 1 ;
        if($i == 1){
            fwrite($fopen , "id;immatriculation;marque;type;nombre_de_place;date_de_circulation;combustion;lieu;service;nom_utilisateur;couleur \n") ;
        }else{
            fwrite($fopen , $vehicule->id . ";" . $vehicule->immatriculation . ";" . $vehicule->marque . ";" . $vehicule->type . ";" . $vehicule->nombre_de_place . ";" . $vehicule->date_de_circulation . $vehicule->combustion . ";" . $vehicule->lieu . ";" . $vehicule->sercice . ";" . $vehicule->nom_utilisateur . ";" . $vehicule->couleur . "\n") ;
        }
    }

    header('location: '.$fichier) ;
}


 

?>