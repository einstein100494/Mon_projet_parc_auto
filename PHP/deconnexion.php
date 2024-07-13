<?php

session_start() ;

$_SESSION = [] ;

session_destroy() ;

header('location: ./../accueil/login.php') ;

?>