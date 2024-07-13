<?php  
session_start() ;
require('./../PHP/login.php') ;

if(isset($_SESSION['auth']) AND $_SESSION['auth'] == true)
{
    header('location: accueil.php') ;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../bootstrap-5.3.2-dist/css/bootstrap.min.css">
</head>
<body class="position-relative">

    <!-- <img src="./../Desert.jpg" class="position-absolute z-n1 image" style="width: 100% ; height: 119.9% ;"> -->

<nav class="navbar navbar-expand-lg p-4 bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./register.php">Register</a>
        </li>
      </ul> -->
    </div>
  </div>
</nav>

<form method="GET" class='container my-5 col-4 border bg-body-tertiary p-4 rounded-3'>
    <h4 class="text-center py-4">Connexion</h4>
    <?php 
        if(isset($message)){
            echo "<p class='alert alert-danger'> $message </p> " ;
        }
    ?>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" value="<?php if(isset($_GET['email'])){ echo $_GET['email'] ;} ?>" class="form-control" name="email" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="mdp" required>
  </div>
  <button type="submit" class="btn btn-outline-primary" name="connexion">Connexion</button>
</form>
    
</body>
</html>