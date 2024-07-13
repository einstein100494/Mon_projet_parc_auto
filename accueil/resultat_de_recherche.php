s<?php
session_start();
require('./../PHP/resultat_de_recherche.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./../bootstrap-5.3.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./boxicons-2.1.4/css/boxicons.min.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><h5><b>Parc Auto</b></h5></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-conthols="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
            <a class="nav-link active" aria-current="page" href="./accueil.php">home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./../PHP/deconnexion.php">Deconnexion</a>
          </li>
        </ul>
        <form class="d-flex col-3" role="search">
          <input type="search" name="search" class="form-control rounded-0 me-1" value="<?php echo $search  ;?>" placeholder="Barre de recherche">
          <input type="submit" value="Search" class="btn btn-primary rounded-0">
        </form>
      </div>
    </div>
  </nav>

  <div class="px-2 mt-4">
    <h4 class="text-center text-primary pb-3"><i>search of Result</i></h4>
        <table id="example" class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th><input class="form-check-input" type="checkbox" onClick="toggle(this)"></th>
                    <th>id</th>
                    <th>Immatriculation</th>
                    <th>Marque</th>
                    <th>Type</th>
                    <th>Nombre de place</th>
                    <th>Date de circulation</th>
                    <th>Combustion</th>
                    <th>Lieu</th>
                    <th>Sercice</th>
                    <th>Nom d'utilisateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <form action="./../PHP/delete_multiple.php" method="GET" id="formSubmit">
                  <?php
                  foreach ($vehiculesRecuperer as $vehicule) {
                  ?>
                            <tr>
                                <td><input type="checkbox" class="form-check-input" name="checked[]" id="checked" value="<?php echo $vehicule->id ?>"></td>
                                <td><?= $vehicule->id; ?></td>
                                <td><?= $vehicule->immatriculation; ?></td>
                                <td><?= $vehicule->marque; ?></td>
                                <td><?= $vehicule->type; ?></td>
                                <td><?= $vehicule->nombre_de_place; ?></td>
                                <td><?= $vehicule->date_de_circulation; ?></td>
                                <td><?= $vehicule->combustion; ?></td>
                                <td><?= $vehicule->lieu; ?></td>
                                <td><?= $vehicule->sercice; ?></td>
                                <td><?= $vehicule->nom_utilisateur; ?></td>
                                <td>
                                    <a href="./modifier.php?id=<?php echo $vehicule->id; ?>"><i class='bx bx-edit-alt text-primary' ></i></a>
                                    <span>/</span>
                                    <a id="supprimer" href="./../PHP/supprimer_vehicule.php?id=<?php echo $vehicule->id; ?>"  data-bs-toggle="modal" data-bs-target="#myModal" class="text-danger"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        <?php
                      }
                        ?>
                  <input type="submit" value="Delete selected" class="btn btn-danger mb-2" id="submitDeleteMultiple" data-bs-toggle="modal" data-bs-target="#myModal01"> 
                  <?php
                  if (isset($_COOKIE["success"])) {
                    echo "<p class='alert alert-success py-1 my-3 text-center'>" . $_COOKIE["success"] . '</p>';
                  }
                  ?>
              </form>


            </tbody>
        </table>

  </div>

  


  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Supprimer</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          Voulez vous supprimer !?
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
          <a id="envoyeSupprimer" href="" class="btn btn-danger">Supprimer</a>
        </div>

      </div>
    </div>
  </div>

  <div class="modal" id="myModal01">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Supprimer</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          Voulez vous supprimer tous les cases cocher !?
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
          <input type="submit" value="Supprimer" class="btn btn-danger " id="envoyeDeleteSelected">
        </div>

      </div>
    </div>
  </div>

  <script src="./../bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
  <script>
    var supprimer = document.querySelectorAll("#supprimer");
    for (let i = 0; i < supprimer.length; i++) {
      supprimer[i].addEventListener("click", function(event) {
        event.preventDefault();
        let envoyeSupprimer = document.getElementById('envoyeSupprimer');
        envoyeSupprimer.href = supprimer[i].getAttribute('href');
      });
    }

    var formSubmit = document.getElementById('formSubmit');
    var submitDeleteMultiple = document.getElementById('submitDeleteMultiple');
    var checked = document.querySelectorAll("#checked");
    var envoyeDeleteSelected = document.getElementById('envoyeDeleteSelected');

    submitDeleteMultiple.addEventListener('click', function(event) {
      event.preventDefault();
      for (let i = 0; i < checked.length; i++) {
        if (checked[i].checked == true) {

        }
      }
    })

    envoyeDeleteSelected.addEventListener('click', function(e) {
      document.forms["formSubmit"].submit();
    })

    function toggle(source) {
      let checkboxes = document.querySelectorAll('#checked');
      for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
      }
    }
  </script>
</body>

</html>