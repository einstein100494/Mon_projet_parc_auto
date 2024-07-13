<?php
require('./../PHP/connexion.php') ;
$notificationUpdate = $bdd->query('SELECT * FROM notification') ;
$updateNotification = $notificationUpdate->fetchAll(PDO::FETCH_OBJ) ;

foreach ($updateNotification as $value) {
    $update = $bdd->prepare('UPDATE notification SET  vues = ? WHERE id = ?') ;
    $update->execute([date('Y-m-d') , $value->id]) ;
}



$obtenirNotifications = $bdd->query('SELECT * FROM notification') ;
$notificationObtenue = $obtenirNotifications->fetchAll(PDO::FETCH_OBJ) ;

?>