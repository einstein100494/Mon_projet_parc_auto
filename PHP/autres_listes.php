<?php 
require('./class/Autre.php') ;

$autres = $_GET['autre'] ;
$nom = $_GET['nom'] ;

$autre = new Autre() ;
$autre->add($nom,$autres) ;

?>