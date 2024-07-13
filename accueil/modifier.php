<?php
session_start();
require('./../PHP/info.php');
if ($_SESSION['auth'] ==  false) {
  header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style.css">
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
      <a class="navbar-brand" href="#"><h5><b>Parc Auto</b></h5></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php
          if ($_SESSION['email'] == "hartina@gmail.com") {
          ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./register.php">Register</a>
            </li>
          <?php
          }

          ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./list_vehicule.php">car list</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./../PHP/deconnexion.php">Deconnexion</a>
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

  <div class="container mt-5">

    <form method="GET" action="./../PHP/modifier.php" class="container-fluid my-5 row border bg-body-tertiary p-4 justify-content-between rounded-3 d-flex" id="form">

      <h4 class="text-center mb-3">car modify</h4>

      <table style="width: 100%;">

        <tr class="py-2">
          <td class="py-2 pe-4">Immatriculation<span class="text-danger h5 ms-2">*</span></td>
          <td class="py-2"><input type="text" name="immatriculation" class="form-control" required value="<?= $voiture['immatriculation']; ?>"></td>
          <td class="py-2 pe-4 ps-3">Nombre de place<span class="text-danger h5 ms-2">*</span></td>
          <td class="py-2"><input value="<?= $voiture['nombre_de_place']; ?>" type="number" name="nbr_place" class="col-5 form-control" min="3" max="45" required></td>
        </tr>

        <tr class="py-2">
          <td class="py-2">Marque</td>
          <td>
            <select name="marque" value="<?= $voiture['marque']; ?>" class="form-control">
              <option value="mazda">Mazda</option>
              <option value="nissan">Nissan</option>
              <option value="toyta rush">Toyota Rush</option>
              <option value="toyota RAV4">Toyota RAV4</option>
              <option value="citroen">Citroen</option>
              <option value="Duster">Duster</option>
              <option value="JMC">JMC</option>
              <option value="hyundai ix35">Hyundai ix35</option>
              <option value="hyundai i20">Hyundai i20</option>
              <option value="hyundai santafee">Hyundai santafee</option>
              <option value="suzuki alto">Suzuki alto</option>
              <option value="peugeot landtrek">Peugeot landtrek</option>
              <option value="mitsubishi L200">Mitsubishi L200</option>
            </select>
          </td>
          <td class="py-2  ps-3">Date de circulation<span class="text-danger h5 ms-2">*</span></td>
          <td>
            <input type="date" value="<?= $voiture['date_de_circulation']; ?>" name="date_de_circulation" id="" class="form-control" required>
          </td>
        </tr>

        <tr>
          <td class="py-2">type</td>
          <td class="py-2">
            <select name="type" class="form-control">
              <option value="cammionnette">Cammionnette</option>
              <option value="bus">Bus</option>
              <option value="VP">VP</option>
              <option value="4*4">4*4</option>
              <option value="mini bus">Mini Bus</option>
              <option value="camion plateau">Camion plateau</option>
            </select>
          </td>
          <td class="py-2  ps-3">Lieu</td>
          <td class="py-2">
            <select name="Lieu" class="form-control">
              <option value="antananarivo">Antananarivo</option>
              <option value="tamatave">Tamatave</option>
              <option value="fianarantsoa">Fianarantsoa</option>
              <option value="antsirabe">Antsirabe</option>
              <option value="majunga">Majunga</option>
              <option value="moramanga">Moramanga</option>
              <option value="antsiranana">Antsiranana</option>
              <option value="morondava">Morondava</option>
              <option value="ambatondrazaka">Ambatondrazaka</option>
              <option value="mahanoro">Mahanoro</option>
              <option value="tulear">Tulear</option>
            </select>
          </td>
        </tr>

        <tr>
          <td class="py-2">Service</td>
          <td class="py-2">
            <select name="Service" class="form-control">
              <option value="comptabilité">Comptabilité</option>
              <option value="DRE">DRE</option>
              <option value="logistique">Logistique</option>
              <option value="PME">PME</option>
              <option value="CES">CES</option>
              <option value="HUM">HUM</option>
              <option value="DCPP">DCPP</option>
              <option value="comptabilité">Animation</option>
              <option value="DIRSIOP">DIRSIOP</option>
              <option value="COMMUNICATION">COMMUNICATION</option>
              <option value="ODIT">ODIT</option>
              <option value="SICU">SICU</option>
              <option value="PARC_AUTO">PARC AUTO</option>
            </select>
          </td>

          <td class="py-2  ps-3">Couleur</td>
          <td class="py-2">
            <select name="couleur" class="form-control">
              <option value="blanc">Blanc</option>
              <option value="noir">Noir</option>
              <option value="rouge">Rouge</option>
              <option value="bleu">Bleu</option>
              <option value="vert">Vert</option>
              <option value="marron">Marron</option>
            </select>
          </td>
        </tr>

        <tr>
          <td class="py-2">Utilisateur</td>
          <td class="py-2"><input type="text" name="utilisateur" class="form-control" value="<?= $voiture['nom_utilisateur']; ?>"></td>

          <td colspan="2"><span class="text-danger  ps-3">Les champs avec (*) sont obligatoire</span></td>
        </tr>

        <tr>
          <td class="py-2">Combustion<span class="text-danger h5 ms-2">*</span></td>
          <td class="py-2">
            <span class="me-2">Essence</span><input class="me-3 form-check-input" type="radio" name="combustion" value="essence" checked>
            <span class="me-2">Gasoil</span><input class="me-3 form-check-input" type="radio" name="combustion" value="gasoil">
            <input type="hidden" name="id" value="<?= $voiture['id']; ?>">
          </td>
        </tr>


      </table>

      <div class="mt-3 p-0">
        <br><br><button class="btn btn-outline-primary" type="submit" id="valider" name="valider">Valider</button>
        <!-- <input type="submit" name="valider" value="Enregistrer" class="btn btn-outline-success"> -->
        <input type="reset" value="Reset" class="btn btn-outline-dark">
      </div>

      <!-- <div class="d-flex justify-content-center mt-4">
        <img src="./../voiture.jpg" alt="" style="width: 300px ;">
      </div> -->

    </form>

  </div>
  <script src="index.js"></script>

</body>

</html>