<?php

require('./class/Connexion.php') ;

class Autre extends Connexion{

    public function add($nom , $autre)  
    {
        $obtenierAutres = $this->bdd->prepare('SELECT nom FROM autres WHERE nom = ?') ;
        $obtenierAutres->execute([$nom]) ;
        if($obtenierAutres->rowCount() > 0 ){
            setcookie("error" , "Ce nom existe deja" , time() + 1 , "/") ;
            echo 'erreur autre existe deja' ;
            header('location: ./../accueil/autres-lists.php?autre='.$autre) ;
        }else{    
            $insert = $this->bdd->prepare('INSERT INTO autres(nom,autre) VALUES (?,?)') ;
            $insert->execute([$nom,$autre]) ;
            setcookie("success" , "ajouter avec succes" , time() + 1 , "/") ;
            echo 'success' ;
        
            header('location: ./../accueil/autres-lists.php?autre='.$autre) ;
        } 
    }

    public function supprimer($id)
    {
        $this->daleteOne('autres' , 'id' , $id) ;
    }

}


?>