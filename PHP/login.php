<?php
require('connexion.php') ;
if(isset($_GET['connexion']))
{
    
    $email = $_GET['email'] ;
    $motDePasse = $_GET['mdp']  ;

    $verifierSiUtilisateurExiste = $bdd->prepare('SELECT email FROM utilisateurs WHERE email = ?') ;
    $verifierSiUtilisateurExiste->execute([$email]) ;

    $utilisateur = $verifierSiUtilisateurExiste->fetch() ;

    if($utilisateur == true)
    {

        $enregister = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ?') ;
        $enregister->execute([$email]) ;

        $utilisateurFetch = $enregister->fetch() ;

        if(password_verify( $motDePasse ,$utilisateurFetch['mot_de_passe'])){

            session_start() ;
            $_SESSION['auth'] = true ;
            $_SESSION['id'] = $utilisateurFetch['id'] ;
            $_SESSION['nom'] = $utilisateurFetch['nom'] ;
            $_SESSION['email'] = $utilisateurFetch['email'] ;

            header('location: acceuil.php') ;

        }else{
            $message = 'Email ou mot de passe incorrect ' ;
        }

    }else{
        $message = 'Utilisateur n\' existe pas' ;
    }

}



?>