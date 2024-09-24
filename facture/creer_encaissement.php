<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/factureController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');


$resultats = facture($_GET['id']);
foreach ($resultats as $donnees) {
    
    $remise = $donnees['remise_facture'];
    $client = $donnees['nom_client'];
}
$montant_paye = montant_facture_payer($_GET['id']);
$montant_facture = intval(montant_facture($_GET['id']) - $remise);
$montant_a_payer = intval($montant_facture - $montant_paye);
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
                            <h1>Règlement</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Vente</a></li>
                                <li class="breadcrumb-item active">Règlement</li>
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
                                    <h3 class="card-title"> Règlement de la facture N<sup>o</sup>FA/ARSN/<?= $_GET['id'] ?> </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <form method="POST">

                                        <div class="row">
                                            <input type="hidden" class="form-control" name="montant_facture" id="montant_facture" value="<?= intval($montant_facture) ?>" />
                                            <input type="hidden" class="form-control" name="montant_paye" id="montant_paye" value="<?= intval($montant_paye) ?>" />

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
                                                    <input type="text" class="form-control" readonly value="FA/ARSN/<?= $_GET['id'] ?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Client*</label>
                                                    <input type="text" class="form-control" readonly value="<?= $client ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Montant facture*</label>
                                                    <input type="text" class="form-control" readonly value="<?= number_format($montant_facture, 0, '.', ' ') ?>" />
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Montant payé*</label>
                                                    <input type="text" class="form-control" readonly value="<?= number_format(intval($montant_paye), 0, '.', ' ') ?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Mode de paiement*</label>
                                                    <select class=" form-control" name="mode_paiement" id="mode_paiement" required>
                                                        <option value="Chèque">Chèque</option>
                                                        <option value="Espèce">Espèce</option>
                                                        <option value="Virement">Virement</option>

                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Montant*</label>
                                                    <input type="text" class="form-control" required name="montant" id="montant" min="0" max="<?= intval($montant_a_payer) ?>" value="<?= $montant_a_payer ?>" />
                                                </div>
                                            </div>

                                  </div>


                                <div class="text-center  py-4">
                                    <button type="submit" class="btn btn-primary mr-2" name="creer_encaissement" id="creer_encaissement">Enregistrer</button>
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

    </div>
    <!-- End custom js for this page -->
</body>

</html>