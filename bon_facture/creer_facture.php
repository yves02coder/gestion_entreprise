<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/bon_factureController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg = 5;
if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
}

$resultats = livraison($_GET['id']);
foreach ($resultats as $donnees) {  
    $date_commande = date('d/m/Y', strtotime($donnees['date_commande']));
    $annee=$donnees['annee'];
    $id_commmande=$donnees['id_bon_commande'];
    $service=$donnees['nom_service'];
  // $livraison=$donnees['piece'];
    $fournisseur = $donnees['nom_fournisseur'];
    $montant = $donnees['montant_fp'];
    $objet = $donnees['objet'];
    
   
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
                                    <h3 class="card-title"> Facture de la commande <?= $objet ?> du <?= $date_commande ?> </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                <h6 class="mb-4">Info sur commande</h6>
                                <hr/>
                                <div class="row">
                                
                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label class="col-sm-10 col-form-label">Service*</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" readonly value=" <?= $service ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label class="col-sm-10 col-form-label">Objet du besoin*</label>
                                            <input type="text" class="form-control" disabled value="<?= $objet ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label class="col-sm-10 col-form-label">N<sup>o</sup>Commande*</label>
                                            <input type="text" class="form-control" disabled value="<?= $annee ?>/<?= $id_commmande ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label class="col-sm-10 col-form-label">N<sup>o</sup>Montant commande*</label>
                                            <input type="text" class="form-control" disabled value="<?= number_format($montant, 0, '.', ' ') ?>" />
                                        </div>
                                    </div>

                                    

                                </div>
                                <h6 class="mb-4">Info sur la facture</h6>
                                        <hr>
                                        
                                        <div class="row">
                                
                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label class="col-sm-10 col-form-label">Fournisseur*</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" readonly value=" <?= $fournisseur ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label for="reference" class="col-sm-10 col-form-label">Référence facture*</label>
                                            <input type="text" class="form-control" name="reference" id="reference"  />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label class="col-sm-10 col-form-label">Montant facture*</label>
                                            <input type="number"  min="0" class="form-control" name="montant" id="montant" value="<?= intval($montant) ?>" />
                                        </div>
                                    </div>

                    

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="facture" class="col-sm-10 col-form-label">Facture*</label>
                                            <input class="form-control " type="file" id="facture" name="facture" accept="application/pdf, application/PDF" required>
                                        </div>
                                    </div>

                                </div>
                                        
                                <div class="text-center  py-4">
                                    <button type="submit" class="btn btn-primary mr-2" name="creer_facture" id="creer_facture">Enregistrer</button>
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