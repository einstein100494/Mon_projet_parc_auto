<?php

class Connexion{
    protected $bdd ;
    private $host;
    private $user;
    private $pass;
    private $base;

    public function __construct($dbhost="localhost",$dbname="automobile",$dbuser="root",$dbpass="")
    {
        $this->base = $dbname;
        $this->host = $dbhost;
        $this->user = $dbuser;
        $this->pass = $dbpass;
        try{
            $this->bdd = new PDO("mysql:host=$this->host;dbname=$this->base" , $this->user , $this->pass) ;
        }catch(PDOException $erreur){
            die('une erreure :' . $erreur->getMessage()) ;
        }    
    }

    //$thi->bdd = new PDO('mysql:host=localhost;dbname=parc_auto' , 'root' , '')

    public function prepareOne(string $table , string $where , $value)
    {
        $prepare = $this->bdd->prepare("SELECT * FROM $table WHERE $where = ?") ;
        $prepare->execute([$value]) ;

        return $prepare->fetch()  ;
    }

    public function prepareAny(string $table , string $where , $value)
    {
        $prepare = $this->bdd->prepare("SELECT * FROM $table WHERE $where = ?") ;
        $prepare->execute([$value]) ;

        return $prepare->fetchAll(PDO::FETCH_OBJ)  ;
    }

    public function query(string $table)
    {
        $query = $this->bdd->query("SELECT * FROM $table") ;

        return $query->fetchAll(PDO::FETCH_OBJ)  ;
    }

    public function daleteOne(string $table , string $where , $value)
    {
        $delete = $this->bdd->prepare("DELETE FROM $table WHERE $where = ?") ;
        $delete->execute([$value]) ;
    }

}

?>