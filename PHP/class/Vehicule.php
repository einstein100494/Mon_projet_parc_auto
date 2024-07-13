<?php
class Vehicule
{

    public $bdd ;

    public function __construct()
    {
        try{
            $this->bdd = new PDO('mysql:host=localhost;dbname=automobile' , 'root' , '') ;
        }catch(PDOException $erreur){
            die('une erreure :' . $erreur->getMessage()) ;
        }
    }

    public function ajout_vehicule($immatriculation,$marque,$type,$nbr_place,$date_de_circulation,$combustion , $Lieu , $Service , $utilisateur , $couleur , $actif , $date_actuel)
    {

        if ((!empty($immatriculation) and !empty($marque) and !empty($type) and !empty($nbr_place) and !empty($date_de_circulation)) and !empty($combustion) and !empty($Lieu) and !empty($Service) and !empty($utilisateur) and !empty($couleur)) {
            $inserer_vehicule = $this->bdd->prepare('INSERT INTO gestion_vehicule(immatriculation,marque,type,nombre_de_place,date_de_circulation,combustion,lieu,sercice,nom_utilisateur,couleur,actif,created_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
            $inserer_vehicule->execute([
                $immatriculation, $marque, $type, $nbr_place, $date_de_circulation, $combustion, $Lieu, $Service, $utilisateur, $couleur, $actif, $date_actuel
            ]);

            if ($inserer_vehicule == true) { // $session = $_SESSION["id"]
                // $motif = "Ajouter une vehicule"
                
                $insertNotification = $this->bdd->prepare('INSERT INTO notification(username,motif) VALUES(?,?)');
                $insertNotification->execute([$_SESSION['nom'], "Ajouter une vehicule"]);
                $cookie_name = "success";
                $cookie_value = "Vehicule enregistrer";
                setcookie($cookie_name, $cookie_value, time() + 1, "/");
                header('location: ./../accueil/accueil.php');
            } else {
                $cookie_name = "error";
                $cookie_value = "Vehicule non enregistrer";
                setcookie($cookie_name, $cookie_value, time() + 1, "/");
                header('location: ./../../accueil/accueil.php');
            }
        }
    }
}
