<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/fournisseurController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg = 5;
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
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
                            <h1>Fournisseur</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Budget</a></li>
                                <li class="breadcrumb-item active">Fournisseur</li>
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
                                    <h3 class="card-title">Nouveau fournisseur</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">

                                        <div class="row mb-3">
                                            <label for="code" class="col-sm-4 col-form-label">Numéro du CC*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="code" name="code" required placeholder="10000A">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nom" class="col-sm-4 col-form-label">Nom*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nom" name="nom" required placeholder="Nom">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="contact" class="col-sm-4 col-form-label">Contact*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="contact" name="contact" required placeholder="0000000000">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="adresse" class="col-sm-4 col-form-label">Adresse*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="adresse" name="adresse" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="banque" class="col-sm-4 col-form-label">Domiciliation Bancaire</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="banque" name="banque" placeholder="Banque">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="compte" class="col-sm-4 col-form-label">Numéro de compte</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="compte" name="compte">
                                            </div>
                                        </div>


                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-warning mr-2" name="creer_fournisseur" id="creer_fournisseur">Enregistrer</button>
                                            <button type="reset" class="btn btn-dark">Annuler</button>
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
    </div>

    <script>
        msg = <?php echo json_encode($msg); ?>;

        if (msg == 0) {
            $(function() {
                toastr.error('Erreur sql.')
            });
        }
        if (msg == 1) {
            $(function() {
                toastr.error('Ce fournisseur existe déjà.')
            });
        }
    </script>
    <!-- End custom js for this page -->
</body>

</html>