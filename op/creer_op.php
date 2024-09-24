<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/opController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');


$resultats = bon_facture($_GET['id']);
foreach ($resultats as $donnees) {
    $date_facture = date('d/m/Y', strtotime($donnees['date_facture']));
    $reference = $donnees['reference_facture'];
    $montant = $donnees['montant_facture'];
    $facture = $donnees['facture'];
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
                            <h1>Facture et paiement</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Budget</a></li>
                                <li class="breadcrumb-item active">Facture et paiement</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title"> Ordre de paiement de la Facture référencée <?= $reference ?> </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data">

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Date*</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" readonly value="<?= gmdate('d/m/Y') ?>" />
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Référence facture*</label>
                                                    <input type="text" class="form-control" disabled value="<?= $reference ?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Date facture*</label>
                                                    <input type="text" class="form-control" disabled value="<?= $date_facture ?>" />
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Montant*</label>
                                                    <input type="text" class="form-control" disabled value="<?= number_format($montant, 0, '.', ' ') ?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Bailleur*</label>
                                                    <input type="number" class="form-control" name="bailleur" id="bailleur" min="0" value="0" />
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Retenue*</label>
                                                    <input type="number" class="form-control" name="retenue" id="retenue" min="0" value="0" />
                                                </div>
                                            </div>
                                        </div>


                                        <hr>
                                        <h6 class="mb-4">Détail Facture</h6>
                                        <div class="row ">
                                            <div class="col-12">
                                                <div class="bg-secondary rounded h-100 ">

                                                    <iframe src="../documents/bon_facture/<?= $facture ?>" width="100%" height="800px"></iframe>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="text-center  py-4">
                                            <button type="submit" class="btn btn-primary mr-2" name="creer_op" id="creer_op">Enregistrer</button>
                                            <button type="reset" class="btn btn-dark">Annuler</button>
                                        </div>
                                    </form>
                                </div>

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
        <script type="text/javascript">
            msg = <?php echo json_encode($msg); ?>;

            if (msg == 0) {
                $(function() {
                    toastr.error('Erreur sql.')
                });
            }
            if (msg == 1) {
                $(function() {
                    toastr.error('Erreur téléchargement.')
                });
            }
            if (msg == 2) {
                $(function() {
                    toastr.error('Erreur! Inserer un fichier PDF.')
                });
            }
            if (msg == 3) {
                $(function() {
                    toastr.error('Ce code existe déjà.')
                });
            }

            // let btn_del= document.querySelector
        </script>
    </div>
    <!-- End custom js for this page -->
</body>

</html>