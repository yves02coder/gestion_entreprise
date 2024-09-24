<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/emploiController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg = 5;
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}
$lemplois = getElementByID('ligne_emploi', 'id_ligne_emploi', $_GET['id']);
foreach ($lemplois as $lemploi) {
    $annee= $lemploi['annee'];
    $emploi_id = $lemploi['emploi_id'];
    $service_id = $lemploi['service_id'];
    $montant = $lemploi['montant_le'];
    $ressource_id=$lemploi['ressource_id'];
}
?>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
    <div class="wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php
        include_once('../partials/body_header.php');
        include_once('../partials/menu.php');
        ?>
        <!-- partial -->

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Emploi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Paramètre</a></li>
                                <li class="breadcrumb-item active">Emploi</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Mise à jour ligne emploi</h3>
                                    <?php echo $annee ?>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="annee" class="col-sm-4 col-form-label">Année*</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="annee" id="annee" onchange="afficherressource(this.id,'ressource')" required>

                                                    <?php
                                                    echo '<option value="' . gmdate('Y') . '" ';
                                                    if ($annee == gmdate('Y')) {
                                                        echo 'selected';
                                                    }
                                                    echo '>' . gmdate('Y') . ' </option>';
                                                    echo '<option value="' . gmdate('Y', strtotime('+1year')) . '"';
                                                    if ($annee == gmdate('Y', strtotime('+1year'))) {
                                                        echo 'selected';
                                                    }
                                                    echo '>' . gmdate('Y', strtotime('+1year')) . ' </option>';
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">

                                            <label for="emploi" class="col-sm-4 col-form-label">Emploi*</label>
                                            <div class="col-sm-8">
                                                <select class="form-control " id="emploi" name="emploi" required>

                                                    <?php

                                                    $emplois = getTable('emplois');
                                                    foreach ($emplois as $emploi) {
                                                        echo '<option value="' . $emploi['id_emploi'] . '"';
                                                        if ($emploi_id == $emploi['id_emploi']) {
                                                            echo 'selected';
                                                        }
                                                        echo '>' . $emploi['compte_emploi'] . ':' . $emploi['libelle_emploi'] . '</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="service" class="col-sm-4 col-form-label">Service*</label>
                                            <div class="col-sm-8">
                                                <select class="form-control " id="service" name="service" required>

                                                    <?php

                                                    $services = getTable('services');
                                                    foreach ($services as $service) {
                                                        echo '<option value="' . $service['id_service'] . '"';
                                                        if ($service_id == $service['id_service']) {
                                                            echo 'selected';
                                                        }
                                                        echo '>' . $service['nom_service'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="montant" class="col-sm-4 col-form-label">Montant*</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" min="0" id="montant" name="montant" required value="<?=$montant ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">

                                            <label for="ressource" class="col-sm-4 col-form-label">Ressource*</label>
                                            <div class="col-sm-8">
                                                <select class="form-control " id="ressource" name="ressource" required>

                                                    <?php

                                                    $ressources = liste_ressource_annee($annee);
                                                    foreach ($ressources as $ressource) {
                                                        echo '<option value="' . $ressource['id_ligne_ressource'] . '"';
                                                        if ($ressource_id == $ressource['id_ligne_ressource']) {
                                                            echo 'selected';
                                                        }
                                                        echo '>' . $ressource['compte_sressource'] . ':' . $ressource['libelle_sressource'] . '</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-success mr-2" name="maj_ligne_emploi" id="maj_ligne_emploi">Mise à jour</button>
                                        </div>


                                </form>
                            </div>

                        </div>
                    </div>
            </section>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        <?php
        include_once('../partials/body_footer.php');
        ?>
        <!-- partial -->
        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2();
            });


            msg = <?php echo json_encode($msg); ?>;

            if (msg == 0) {
                $(function() {
                    toastr.error('Erreur sql.')
                });
            }
            if (msg == 1) {
                $(function() {
                    toastr.error('Ce code existe déjà.')
                });
            }

            function afficherressource(annee,zone) {  
                     
                         annee = $('#annee option:selected').val();
               
                       $.ajax({
                        type: 'POST',
                        url: "ajax.php",
                        data: {annee:annee},
                        success: function(resultat){
                                $('#'+zone).html(resultat);
                                
                            }
                        });   
                }
        </script>
    </div>
    <!-- End custom js for this page -->
</body>

</html>