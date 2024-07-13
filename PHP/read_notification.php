<?php
require('./connexion.php') ;
$update = $bdd->prepare('UPDATE notification SET read_at = ? WHERE id = ?') ;
$update->execute([date('Y-m-d') , $_GET['id']]) ;
header('location: ./../accueil/notifications.php') ;

?>