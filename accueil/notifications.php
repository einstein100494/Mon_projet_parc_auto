<?php
session_start();
require('./../PHP/notification.php');
require('./../PHP/connexion.php') ;

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
          <th>Name</th>
          <th>Motif</th>
          <th>Read at</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
          <?php
            foreach ($notificationObtenue as $value) {
                ?>
                <tr>
                    <td class="position-relative ">
                        <input class="form-check-input" type="checkbox">
                    </td>
                    <td><?= $value->username ;?></td>
                    <td><?= $value->motif ;?></td>
                    <td><?php
                        if($value->read_at == null){
                            ?> <a href="./../PHP/read_notification.php?id=<?= $value->id ;?>">Not read</a> <?php
                        }else{
                            ?> <a href="#" class="text-secondary" disabled>Read</a> <?php
                        }
                     ?></td>
                    <td>
                        <a href="#" class="text-danger">Delete</a>
                    </td> 
                </tr>
                <?php
            }
        ?>

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