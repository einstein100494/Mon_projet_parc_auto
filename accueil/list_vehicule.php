<?php
session_start();
require('./../PHP/liste_vehicules.php');
require('./../PHP/connexion.php');


$obtenirNotifications = $bdd->prepare('SELECT * FROM notification WHERE vues IS NULL') ;
$obtenirNotifications->execute() ;

$notification = $obtenirNotifications->fetchAll(PDO::FETCH_OBJ) ;
?>

  <?php require('./navigation.php') ;?>

  <h6 class="text-start ms-4 text-secondary mt-3">list of car</h6>

  <div class="px-2 mt-4">
    <table id="dataTable" class="table table-striped">
      <thead class="table-primary">
        <tr>
          <th class="position-relative ">
            <div class="position-absolute container-fluid z-3 bg-white" style="top : 1px ; left : 0 ; height: 97% ;">
              <input class="form-check-input" type="checkbox" onClick="toggle(this)">
            </div>
          </th>
          <th>id</th>
          <th>Registration</th>
          <th>Brand</th>
          <th>Kind</th>
          <th>Service</th>
          <th>username</th>
          <th class="text-start">Creat</th>
          <th>Update</th>
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
              <td class="text-center"><?= $vehicule->id; ?></td>
              <td><?= $vehicule->immatriculation; ?></td>
              <td><?= $vehicule->marque; ?></td>
              <td><?= $vehicule->type; ?></td>
              <td><?= $vehicule->sercice; ?></td>
              <td><?= $vehicule->nom_utilisateur; ?></td>
              <td class="text-start"><?= $vehicule->created_at; ?></td>
              <td><?= $vehicule->update_at; ?></td>
              <td>
                <a href="./modifier.php?id=<?php echo $vehicule->id; ?>"><i class='bx bx-edit-alt text-primary'></i></a>
                <span>/</span>
                <a id="supprimer" href="./../PHP/supprimer_vehicule.php?id=<?php echo $vehicule->id; ?>" data-bs-toggle="modal" data-bs-target="#myModal" class="text-danger"><i class='bx bx-trash'></i></a>
              </td>
            </tr>
          <?php
          }
          ?>
          <input type="submit" value="Delete selected" class="btn btn-danger mb-2" id="submitDeleteMultiple" data-bs-toggle="modal" data-bs-target="#myModal01">

        </form>


      </tbody>
    </table>

    <!-- <div class="container-fluid d-flex">
      <?php

      if ($page != 1) {
      ?>
        <a href="?page=<?php echo $page - 1 ?>&filtre=<?php echo $filtre; ?>" id="boutton_next" class="btn btn-success rounded-0 me-1">prev</a>
      <?php
      }

      ?>
      <?php
      for ($i = 1; $i < $nbr_de_page + 1; $i++) {
        if ($i != $page) {
      ?>
          <a href="?page=<?php echo $i; ?>&filtre=<?php echo $filtre; ?>" id="lien_page" class="btn me-1 rounded-0"><?php echo $i; ?></a>
        <?php
        } else {
        ?>
          <a href="?page=<?php echo $i; ?>&filtre=<?php echo $filtre; ?>" id="lien_page" name='select' class="btn btn-primary me-1 rounded-0"><?php echo $i; ?></a>
      <?php
        }
      }
      ?>
      <?php

      if ($page != $nbr_de_page) {
      ?>
        <a href="?page=<?php echo $page + 1 ?>&filtre=<?php echo $filtre; ?>" id="boutton_next" class="btn btn-success rounded-0">next</a>
      <?php
      }

      ?>
    </div> -->

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
  <script src="./DataTables/jquery-3.7.1.js"></script>
  <script src="./DataTables/bootstrap.bundle.min.js"></script>
  <script src="./DataTables/dataTables01.js"></script>
  <script src="./DataTables/dataTables.bootstrap5.js"></script>
  <script>
    var supprimer = document.querySelectorAll("#supprimer");
    for (let i = 0; i < supprimer.length; i++) {
      supprimer[i].addEventListener("click", function(event) {
        event.preventDefault();
        let envoyeSupprimer = document.getElementById('envoyeSupprimer');
        envoyeSupprimer.href = supprimer[i].getAttribute('href');
      });
    }

    var submitDeleteMultiple = document.getElementById('submitDeleteMultiple');
    var checked = document.querySelectorAll("#checked");
    var envoyeDeleteSelected = document.getElementById('envoyeDeleteSelected');
    var tableau = [] ;

    envoyeDeleteSelected.addEventListener('click', function(e) {
      // document.getElementById("formSubmit").submit();

      for (let i = 0; i < checked.length; i++) {
        if(checked[i].checked == true){
          tableau.push(checked[i].value)
        }
      }

      if(tableau.length > 0){
        window.location = './../PHP/delete_multiple.php?id=' + tableau ;
      }

    })

    function toggle(source) {
      let checkboxes = document.querySelectorAll('#checked');
      for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
      }
    }

    new DataTable('#dataTable');


  </script>


</body>

</html>