<?php
session_start();
require('./../PHP/connexion.php');
if ($_SESSION['auth'] ==  false) {
    header('location: login.php');
}

$obtenirNotifications = $bdd->prepare('SELECT * FROM notification WHERE vues IS NULL') ;
$obtenirNotifications->execute() ;

$notification = $obtenirNotifications->fetchAll(PDO::FETCH_OBJ) ;

$obtenirAutres = $bdd->prepare('SELECT * FROM autres WHERE autre = ?');
$obtenirAutres->execute([$_GET['autre']]);
$autres = $obtenirAutres->fetchAll();

$obtenierAutre = $bdd->prepare('SELECT * FROM caractere WHERE id = ?') ;
$obtenierAutre->execute([$_GET['autre']]) ;
$autre = $obtenierAutre->fetch() ;

?>

    <?php require('./navigation.php') ;?>
    <div class="container mt-5 d-flex justify-content-between col-7">

        <form action="./../PHP/autres_listes.php" method="GET" class="col-6 border p-4" id="form" style="background-color: #F4F6F6; ">

            <h4 class="text-center mb-3">Ajout <?php echo $autre['caracteres'] ; ?></h4>

            <div class="p-0">
                <input type="text" name="nom" class="form-control">
                <input type="hidden" name="autre" value="<?php echo $_GET['autre'] ; ?>">
            </div>

            <div class="mt-3 p-0">
                <button class="btn btn-outline-primary" type="submit" id="valider">Valider</button>
                <input type="reset" value="Reset" class="btn btn-outline-dark">
            </div>
            <!-- 
            <div class="d-flex justify-content-center mt-4">
                <img src="./../voiture.jpg" alt="" style="width: 300px ;">
            </div> -->

        </form>

        <div class="col-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center"><?php echo $autre['caracteres'] ; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($autres as $value) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $value['nom'] ; ?></td>
                                </tr>
                            <?php
                        }

                    ?>
                </tbody>
            </table>
        </div>

    </div>
    <script src="index.js"></script>

</body>

</html>