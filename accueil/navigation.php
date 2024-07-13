<?php $uri = explode('/' , $_SERVER["REQUEST_URI"])[count(explode('/' , $_SERVER["REQUEST_URI"]))-1]; ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css">
  <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
  <script src="./../bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./boxicons-2.1.4/css/boxicons.min.css">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="test.css">
</head>

<body class="position-relative">

  <style>
    .monAnnimation {
      position: absolute;
      width: 50%;
      animation: annimation 7s;
      top: -100px;
      left: 24%;
      text-align: center;
      z-index: 10;
    }

    @keyframes annimation {
      0% {
        top: -100px;
      }

      5% {
        top: 20px;
      }

      100% {
        top: -100px;
      }
    }
  </style>

  <?php

  if (isset($_COOKIE["success"])) {

  ?>
    <div class="monAnnimation">
      <p class="alert alert-success"> <?= $_COOKIE["success"]; ?></p>
    </div>
  <?php

  }


  ?>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <h5><b>Parc Auto</b></h5>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><i class='bx bx-list-plus bx-sm'></i></a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./autres-lists.php?autre=1">Marque</a></li>
              <li><a  style="border-top : 1px solid gray ;" class="dropdown-item" href="./autres-lists.php?autre=2">Type</a></li>
              <li><a style="border-top : 1px solid gray ;" class="dropdown-item" href="./autres-lists.php?autre=4">Service</a></li>
              <li><a style="border-top : 1px solid gray ;" class="dropdown-item" href="./autres-lists.php?autre=3">Lieu</a></li>
            </ul>
          </li>
          <?php
          if ($_SESSION['email'] == "hartina@gmail.com") {
          ?>
            <li class="nav-item">
              <?php
if($uri == 'accueil.php'){
  ?><a class="nav-link text-primary" aria-current="page" href="./register.php">Register</a><?php
}else{
  ?><a class="nav-link" aria-current="page" href="./register.php">Register</a><?php
}
              ?>
            </li>
          <?php
          }

          ?>
          <li class="nav-item">
            <a  style="border-left : 1px solid black ;" class="nav-link active" aria-current="page" href="./accueil.php">Home</a>
          </li>
          <li class="nav-item">
            <a  style="border-left : 1px solid black ;" class="nav-link active" aria-current="page" href="./list_vehicule.php">car List</a>
          </li>
          <li class="nav-item">
            <a  style="border-left : 1px solid black ;" class="nav-link active" aria-current="page" href="./corbeille.php">Basket</a>
          </li>
          <li class="nav-item">
            <a  style="border-left : 1px solid black ;" class="nav-link active" aria-current="page" href="./../PHP/deconnexion.php">Deconnexion</a>
          </li>
          <li class="nav-item">
            <a href="./notifications.php" class="position-relative nav-link">
              <i class="fa fa-bell"></i>
              <span class="position-absolute top-2 start-100 translate-middle badge rounded-pill bg-danger">
                <?= count($notification) ; ?>
                <span class="visually-hidden">unread messages</span>
              </span>
            </a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <span class="text-primary">
            <?= $_SESSION['nom']; ?>
          </span>
        </form>
      </div>
    </div>
  </nav>
