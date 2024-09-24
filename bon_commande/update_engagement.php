<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/bon_commandeController.php');
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
                            <h1>Bon de commande</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Budget</a></li>
                                <li class="breadcrumb-item active">Bon de commande</li>
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
                                    <h3 class="card-title">Mise à jour Bon d'engagement</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                        <label for="bon" class="col-sm-4 col-form-label">Bon engagement*(.PDF)</label>
                                        <div class="col-sm-8">       
                                                        
                                         <input class="form-control " type="file" id="bon_engagement" name="bon_engagement" accept="application/pdf, application/PDF" required>
                                                       
                                        </div>
                                                
                                        </div>

                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-success mr-2" name="update_engagement" id="update_engagement">Mise à jour</button>
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


          
        </script>
    </div>
    <!-- End custom js for this page -->
</body>

</html>