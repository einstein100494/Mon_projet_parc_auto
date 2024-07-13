<?php

class BDD{
    private $host;
    private $user;
    private $pass;
    private $base;
    protected $bdd;

    public function __construct($dbhost="localhost",$dbname="parc_auto",$dbuser="root",$dbpass="" ) {
        $this->base = $dbname;
        $this->host = $dbhost;
        $this->user = $dbuser;
        $this->pass = $dbpass;
    }

    
    public function connexion()
    {
        try{
            $this->bdd = new PDO('mysql:host='.$this->host.';dbname='.$this->base, $this->user ,$this->pass) ;
                echo"connexion reusit";
        }catch(PDOException $erreur){
            die('une erreure :' . $erreur->getMessage()) ;
        }    
    }
}

$bdd = new BDD() ;
$bdd->connexion() ;
    
?>