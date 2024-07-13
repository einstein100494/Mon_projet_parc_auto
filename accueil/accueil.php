<?php
session_start() ;
require('./../PHP/class/Connexion.php');
require('./../PHP/connexion.php') ;
if ($_SESSION['auth'] ==  false) {
  header('location: login.php');
}

$obtenirNotifications = $bdd->prepare('SELECT * FROM notification WHERE vues IS NULL') ;
$obtenirNotifications->execute() ;

$notification = $obtenirNotifications->fetchAll(PDO::FETCH_OBJ) ;

$connexion = new Connexion() ;

$marques = $connexion->prepareAny('autres' , 'autre' , 1);

$types = $connexion->prepareAny('autres' , 'autre' , 2);

$services = $connexion->prepareAny('autres' , 'autre' , 3);

$lieux = $connexion->prepareAny('autres' , 'autre' , 4);

// var_dump($_SERVER["REQUEST_URI"]);
// var_dump(explode('/' , $_SERVER["REQUEST_URI"]));

// echo $uri;
// die();

?>

  <?php require('./navigation.php') ; ?>

  <h6 class="text-start ms-4 text-secondary mt-3">gestion des vehicules</h6>

  <div class="container">

    <form action="./../PHP/ajout_vehicule.php" method="GET" class="container-fluid mb-5 row border bg-body-tertiary p-4 justify-content-between rounded-3 d-flex" id="form">
      <table style="width: 100%;">

        <tr class="py-2">
          <td class="py-2 pe-4">Immatriculation<span class="text-danger h5 ms-2">*</span></td>
          <td class="py-2"><input type="text" name="immatriculation" class="form-control" required></td>
          <td class="py-2 pe-4 ps-3">Nombre de place<span class="text-danger h5 ms-2">*</span></td>
          <td class="py-2"><input type="number" name="nbr_place" class="col-5 form-control" min="3" max="45" required></td>
        </tr>

        <tr class="py-2">
          <td class="py-2">Marque</td>
          <td>
            <select name="marque" class="form-select">
              <?php
              foreach ($marques as $marque) {
              ?><option value="<?php echo $marque->nom; ?>"><?php echo $marque->nom; ?></option><?php
              }?>
              <!-- <option value="citroen">Citroen</option>
              <option value="Duster">Duster</option>
              <option value="JMC">JMC</option>
              <option value="hyundai ix35">Hyundai ix35</option>
              <option value="hyundai i20">Hyundai i20</option>
              <option value="hyundai santafee">Hyundai santafee</option>
              <option value="suzuki alto">Suzuki alto</option>
              <option value="peugeot landtrek">Peugeot landtrek</option>
              <option value="mitsubishi L200">Mitsubishi L200</option> -->
            </select>
          </td>
          <td class="py-2  ps-3">Date de circulation<span class="text-danger h5 ms-2">*</span></td>
          <td>
            <input type="date" name="date_de_circulation" id="" class="form-control" required>
          </td>
        </tr>

        <tr>
          <td class="py-2">type</td>
          <td class="py-2">
            <select name="type" class="form-select">
              <?php
              foreach ($types as $type) {
              ?><option value="<?php echo $type->nom; ?>"><?php echo $type->nom; ?></option><?php
                                                                                              }
                                                                                                ?>
              <!-- <option value="VP">VP</option>
              <option value="4*4">4*4</option>
              <option value="mini bus">Mini Bus</option>
              <option value="camion plateau">Camion plateau</option> -->
            </select>
          </td>
          <td class="py-2  ps-3">Lieu</td>
          <td class="py-2">
            <select name="Lieu" class="form-select">
              <?php
              foreach ($lieux as $lieu) {
              ?><option value="<?php echo $lieu->nom; ?>"><?php echo $lieu->nom; ?></option><?php
                                                                                              }
                                                                                                ?>
              <!-- <option value="majunga">Majunga</option>
              <option value="moramanga">Moramanga</option>
              <option value="antsiranana">Antsiranana</option>
              <option value="morondava">Morondava</option>
              <option value="ambatondrazaka">Ambatondrazaka</option>
              <option value="mahanoro">Mahanoro</option>
              <option value="tulear">Tulear</option> -->
            </select>
          </td>
        </tr>

        <tr>
          <td class="py-2">Service</td>
          <td class="py-2">
            <select name="Service" class="form-select">
              <?php
              foreach ($services as $service) {
              ?><option value="<?php echo $service->nom; ?>"><?php echo $service->nom; ?></option><?php
                                                                                                    }
                                                                                                      ?>
              <!--
              <option value="DCPP">DCPP</option>
              <option value="ANIMATION">Animation</option>
              <option value="DIRSIOP">DIRSIOP</option>
              <option value="COMMUNICATION">COMMUNICATION</option>
              <option value="ODIT">ODIT</option>
              <option value="SICU">SICU</option>
              <option value="PARC_AUTO">PARC AUTO</option> -->
            </select>
          </td>

          <td class="py-2  ps-3">Couleur</td>
          <td class="py-2">
            <select name="couleur" class="form-select">
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
          <td class="py-2"><input type="text" name="utilisateur" class="form-control"></td>

          <td colspan="2"><span class="text-danger  ps-3">Les champs avec (*) sont obligatoire</span></td>
        </tr>

        <tr>
          <td class="py-2">Combustion<span class="text-danger h5 ms-2">*</span></td>
          <td class="py-2">
            <span class="me-2">Essence</span><input class="me-3 form-check-input" type="radio" name="combustion" value="essence" checked>
            <span class="me-2">Gasoil</span><input class="me-3 form-check-input" type="radio" name="combustion" value="gasoil">
          </td>
        </tr>


      </table>

      <div class="mt-3 p-0">
        <br><br><button class="btn btn-outline-primary px-4" type="submit" id="valider" name="valider">Valider</button>
        <!-- <input type="submit" name="valider" value="Enregistrer" class="btn btn-outline-success"> -->
        <input type="reset" value="Reset" class="btn btn-outline-dark px-4">
      </div>
      <!-- 
      <div class="d-flex justify-content-center mt-4">
        <img src="./../voiture.jpg" alt="" style="width: 300px ;">
      </div> -->

    </form>

  </div>
  <script src="index.js"></script>

</body>

</html>