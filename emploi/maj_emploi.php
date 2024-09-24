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
$emplois = getElementByID('emplois', 'id_emploi', $_GET['id']);
foreach ($emplois as $emploi) {
    $nature_id = $emploi['nature_id'];
    $activite_id = $emploi['activite_id'];
    $compte = $emploi['compte_emploi'];
    $libelle = $emploi['libelle_emploi'];
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
                                    <h3 class="card-title">Mise à jour emploi</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="nature" class="col-sm-4 col-form-label">Nature*</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="nature" id="nature" required>

                                                    <?php
                                                  $natures = getTable('natures');
                                                  foreach ($natures as $nature) {
                                                      echo '<option value="' . $nature['id_nature'] . '"';
                                                      if ($nature_id == $nature['id_nature']) {
                                                          echo 'selected';
                                                      }
                                                      echo '>' . $nature['code_nature'] . ':' . $nature['libelle_nature'] . '</option>';
                                                  }?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                        
                                            <label for="activite" class="col-sm-4 col-form-label">Activité*</label>
                                            <div class="col-sm-8">
                                                <select class="form-control " id="activite" name="activite" required>

                                                    <?php
                                                    
                                                    $activites = getTable('activites');
                                                    foreach ($activites as $activite) {
                                                        echo '<option value="' . $activite['id_activite'] . '"';
                                                        if ($activite_id == $activite['id_activite']) {
                                                            echo 'selected';
                                                        }
                                                        echo '>' . $activite['code_activite'] . ':' . $activite['libelle_activite'] . '</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="compte" class="col-sm-4 col-form-label">Compte*</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="compte" name="compte"  required value="<?=$compte ?>" >
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="libelle" class="col-sm-4 col-form-label">Libellé*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="libelle" name="libelle"  required value="<?=$libelle ?>" >
                                            </div>
                                        </div>

                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-success mr-2" name="maj_emploi" id="maj_emploi">Mise à jour</button>
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