<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/ressourceController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg = 5;
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}
$lressources = getElementByID('ligne_ressource', 'id_ligne_ressource', $_GET['id']);
foreach ($lressources as $lressource) {
    $annee = $lressource['annee'];
    $sressource = $lressource['sressource_id'];
    $montant = $lressource['montant'];
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
                            <h1>S/Ressource</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Paramètre</a></li>
                                <li class="breadcrumb-item active">S/Ressource</li>
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
                                    <h3 class="card-title">Mise à jour ligne ressource</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="annee" class="col-sm-4 col-form-label">Année*</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="annee" id="annee" required>

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
                                        
                                            <label for="sressource" class="col-sm-4 col-form-label">S/Ressource*</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2" id="sressource" name="sressource" required>

                                                    <?php
                                                    
                                                    $sressources = getTable('sous_ressources');
                                                    foreach ($sressources as $sressource) {
                                                        echo '<option value="' . $sressource['id_sous_ressource'] . '"';
                                                        if ($sressource == $sressource['id_sous_ressource']) {
                                                            echo 'selected';
                                                        }
                                                        echo '>' . $sressource['compte_sressource'] . ':' . $sressource['libelle_sressource'] . '</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="montant" class="col-sm-4 col-form-label">Montant*</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="montant" name="montant"  required value="<?=$montant ?>" >
                                            </div>
                                        </div>

                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-success mr-2" name="maj_ligne_ressource" id="maj_ligne_ressource">Mise à jour</button>

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
        </script>
    </div>
    <!-- End custom js for this page -->
</body>

</html>