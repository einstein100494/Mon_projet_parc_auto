<?php
session_start();
require('./../PHP/corbeille.php');
require('./../PHP/connexion.php') ;


$obtenirNotifications = $bdd->prepare('SELECT * FROM notification WHERE vues IS NULL') ;
$obtenirNotifications->execute() ;

$notification = $obtenirNotifications->fetchAll(PDO::FETCH_OBJ) ;
?>

  <?php require('./navigation.php') ;?>

  <div class="px-2 mt-4">
    <h4 class="text-center pb-3 text-primary">barket</h4>
    <table id="example" class="table table-striped">
      <thead>
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
                <a href="./../PHP/enlever_du_corbeille.php?id=<?php echo $vehicule->id; ?>"><i class='bx bx-edit-alt text-primary'></i></a>
                <span>/</span>
                <a id="supprimer" href="./../PHP/supprimer_definitivement.php?id=<?php echo $vehicule->id; ?>" data-bs-toggle="modal" data-bs-target="#myModal" class="text-danger"><i class='bx bx-trash'></i></a>
              </td>
            </tr>
          <?php
          }
          ?>
          <input type="submit" value="Delete selected" class="btn btn-danger mb-2" id="submitDeleteMultiple" data-bs-toggle="modal" data-bs-target="#myModal01">
        </form>


      </tbody>
    </table>

    <div class="container-fluid d-flex">
      <?php

      if ($page != 1) {
      ?>
        <a href="?page=<?php echo $page - 1 ?>" id="boutton_next" class="btn btn-success rounded-0 me-1">prev</a>
      <?php
      }

      ?>
      <?php
      for ($i = 1; $i < $nbr_de_page + 1; $i++) {
        if ($i != $page) {
      ?>
          <a href="?page=<?php echo $i; ?>" id="lien_page" class="btn me-1 rounded-0"><?php echo $i; ?></a>
        <?php
        } else {
        ?>
          <a href="?page=<?php echo $i; ?>" id="lien_page" name='select' class="btn btn-primary me-1 rounded-0"><?php echo $i; ?></a>
      <?php
        }
      }
      ?>
      <?php

      if ($page != $nbr_de_page) {
      ?>
        <a href="?page=<?php echo $page + 1 ?>" id="boutton_next" class="btn btn-success rounded-0">next</a>
      <?php
      }

      ?>
    </div>

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
          Ce vehicule sera supprimer definitivement
          <br> Voulez vous supprimer !?
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

  <script>
    // var lien_page = document.querySelectorAll('#lien_page') ;
    // console.log(lien_page[0].href) ;
    // var boutton_next = document.getElementById('boutton_next') ;

    // boutton_next.addEventListener('click' , function(next){
    //   next.preventDefault() ;
    // })
  </script>
</body>

</html>