<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/chequeController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');

$msg = 5;
if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
}

$resultats = cheque($_GET['id']);
foreach ($resultats as $donnees) {

    $banque = $donnees['banque'];
    $numero_cheque = $donnees['numero_cheque'];
}
$montant_paye = montant_payer($_GET['id']);
$montant_a_payer = intval($montant - $montant_paye);
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
                                    <h3 class="card-title"> Retrait de Chèque N<sup>o</sup><?= $numero_cheque ?> </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data">

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Date*</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" readonly value="<?= gmdate('d/m/Y') ?>" />
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Banque*</label>
                                                    <input type="text" class="form-control" disabled value="<?= $banque ?>" />
                                                </div>
                                            </div>

                                            

                                        </div>
                                        <div class="row">

                                        <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Numéro du chèque*</label>
                                                    <input type="text" class="form-control" readonly value="<?= $numero_cheque ?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Chèque*</label>
                                                    <input class="form-control " type="file" id="cheque" name="cheque" accept="application/pdf, application/PDF" required>
                                                </div>
                                            </div>

                               

                                        </div>


                                        <div class="text-center  py-4">
                                            <button type="submit" class="btn btn-primary mr-2" name="creer_retrait_cheque" id="creer_retrait_cheque">Enregistrer</button>
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


            // let btn_del= document.querySelector
        </script>
    </div>
    <!-- End custom js for this page -->
</body>

</html>