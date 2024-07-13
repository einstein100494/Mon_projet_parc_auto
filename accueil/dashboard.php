<?php
session_start();
require('./../PHP/connexion.php');
if ($_SESSION['auth'] ==  false) {
  header('location: login.php');
}

$obtenierLesVoitures = $bdd->query('SELECT * FROM gestion_vehicule')->fetchAll() ;
$tableDate = [] ;
foreach ($obtenierLesVoitures as $voiture) {
  array_push($tableDate , date_format(date_create($voiture['created_at']),"Y-m-d")) ;
}
$dates = array_unique($tableDate) ;

$nombreDesVoitures = [] ;

foreach ($dates as $date) {
    $i = 0 ;
    foreach ($obtenierLesVoitures as $voiture) {
        if($date == date_format(date_create($voiture['created_at']),"Y-m-d")){
          $i = $i + 1 ;
        }
    }

    array_push($nombreDesVoitures , $i ) ;
}

var_dump($dates) ;

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
      <div class="d-flex justify-content-between">
        <canvas id="goodCanvas1" width="400" height="100" aria-label="Hello ARIA World" role="img"></canvas>
      </div>
  </div>

  <script src="./../node_modules/chart.js/dist/chart.umd.js"></script>
  <script>
    Chart.defaults.font.size = 16;
let chart = new Chart(document.getElementById('goodCanvas1'), {
  type: 'bar',
  data: {
    datasets: [{
      data: [
        <?php
          foreach ($nombreDesVoitures as $date) {
            echo "$date," ;
          }
        ?>
      ],
      backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)'
    ]
    }],
    labels: [
      <?php
          foreach ($dates as $date) {
            echo $date . ',' ;
          }
        ?>]
  }
});
  </script>
</body>

</html>