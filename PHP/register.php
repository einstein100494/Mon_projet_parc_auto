<?php
require('connexion.php') ;
if(isset($_GET['inscription']))
{
    
    $nom = $_GET['nom'] ;
    $email = $_GET['email'] ;
    $motDePasse = password_hash($_GET['mdp'] , PASSWORD_DEFAULT)  ;

    $verifierSiUtilisateurExiste = $bdd->prepare('SELECT email FROM utilisateurs WHERE email = ?') ;
    $verifierSiUtilisateurExiste->execute([$email]) ;

    $utilisateur = $verifierSiUtilisateurExiste->fetch() ;

    if($utilisateur == false)
    {

        $enregister = $bdd->prepare('INSERT INTO utilisateurs(nom,email,mot_de_passe) VALUES(?,?,?)') ;
        $enregister->execute([$nom , $email , $motDePasse]) ;

        $success = "utlisateur enregiste" ;

    }else{
        $error = 'Utilisateur existe , veuiller choisir une autre email' ;
    }

}



?>