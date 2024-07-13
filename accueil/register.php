<?php
session_start() ;
require('./../PHP/connexion.php') ;

$obtenirNotifications = $bdd->prepare('SELECT * FROM notification WHERE vues IS NULL') ;
$obtenirNotifications->execute() ;

$notification = $obtenirNotifications->fetchAll(PDO::FETCH_OBJ) ;

if($_SESSION['auth'] == false)
{
  header('location:login.php') ;
}else if($_SESSION['auth'] == true AND $_SESSION['email'] != "hartina@gmail.com"){
  header('location: accueil.php') ;
}

?>

  <?php require('./navigation.php') ;?>

<form method="GET" class='container my-5 col-4 border bg-body-tertiary p-4 rounded-3'>
    <h4 class="text-center py-4">Inscription</h4>
    <?php 
        if(isset($success)){
            echo "<p class='alert alert-success py-2'> $success </p>" ;
        }else if(isset($error)){
            echo "<p class='alert alert-danger'> $error </p>" ;
        }
    ?>
  <div class="mb-3">
    <label for="exampleInputRegister" class="form-label">Nom</label>
    <input type="text" class="form-control" name="nom" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="mdp">
  </div>
  <button type="submit" class="btn btn-outline-primary" name="inscription">Submit</button>
</form>
    
</body>
</html>