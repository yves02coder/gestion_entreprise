<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/commandeController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg=5;
if (isset($_GET['msg'])){
  $msg=$_GET['msg'];
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
                            <h1>Commande</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Vente</a></li>
                                <li class="breadcrumb-item active">Commande</li>
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
                                    <h3 class="card-title">Nouvelle commande</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="card-body">

                                        <div class="row mb-3">
                                            <label for="date" class="col-sm-4 col-form-label">Date*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" readonly value="<?= gmdate("d/m/Y") ?>" placeholder="Nom du service">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="proforma" class="col-sm-4 col-form-label">Proforma*</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2" name="proforma" id="proforma" required onchange="afficher_client()">
                                                    <option value="-1" selected disabled>-------Selectionner Proforma------</option>
                                                    <?php
                                                    $proformas = proforma_valide();
                                                    foreach ($proformas as $proforma) {
                                                        echo '<option value="' . $proforma['num_proforma'] . '">' . date('d/m/Y', strtotime($proforma['date_proforma'])) . ': ' . $proforma['nom_client'] . '</option>';
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="client" class="col-sm-4 col-form-label">Client*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="client" name="client" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="montant" class="col-sm-4 col-form-label">Montant*</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="montant" name="montant" required min="0">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="commande" class="col-sm-4 col-form-label">Bon de commande*</label>
                                            <div class="col-sm-8">
                                                <input class="form-control " type="file" id="commande" name="commande" accept="application/pdf, application/PDF" required>
                                            </div>
                                        </div>


                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-warning mr-2" name="creer_commande" id="creer_commande">Enregistrer</button>
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
         $(function() {
                $('.select2').select2();
                theme: 'bootstrap4'
            });
        msg = <?php echo json_encode($msg); ?>;

        if (msg == 1) {
            $(function() {
                toastr.error('Erreur téléchargement fichier.')
            });
        }
        if (msg == 2) {
            $(function() {
                toastr.error('Inserer un pdf.')
            });
        }

        if (msg == 3) {
            $(function() {
                toastr.error('Type non supporté.')
            });
        }

        function afficher_client() {
            proforma_id = $('#proforma option:selected').val();
            $.ajax({
                type: 'POST',
                url: "ajax.php",
                data: {
                    proforma_id: proforma_id
                },
                success: function(resultat) {
                    $('#client').val(resultat);
                }
            });

        }
    </script>
    <!-- End custom js for this page -->
</body>

</html>