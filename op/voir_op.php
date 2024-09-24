<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/opController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');


$resultats = op($_GET['id']);
foreach ($resultats as $donnees) {
    $date_op = date('d/m/Y', strtotime($donnees['date_op']));
    $reference = $donnees['reference_facture'];
    $montant = $donnees['montant_facture'];
    $facture = $donnees['facture'];
    $retenue = $donnees['retenue'];
    $bailleur = $donnees['bailleur'];
    $valide_op_dg = $donnees['valide_op_dg'];
    $date_op_dg = $donnees['date_op_dg'];
    $valide_op_daf = $donnees['valide_op_daf'];
    $date_op_daf = $donnees['date_op_daf'];
    $valide_op_controle = $donnees['valide_op_controle'];
    $date_op_controle = $donnees['date_op_controle'];
    $annee_s = $donnees['annee_s'];
    $annee_n = $donnees['annee_n'];
    $livraison = $donnees['livraison_id'];
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
                                    <h3 class="card-title"> Ordre de paiement N<sup>o</sup>OP/ARSN/<?php if(!empty($livraison)){echo $annee_n;} else{echo $annee_s;}?>/<?=$_GET['id'] ?> </h3>
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
                                                        <input type="text" class="form-control" readonly value="<?= $date_op?>" />
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
                                                    <input type="text" class="form-control" disabled value="<?= number_format($bailleur, 0, '.', ' ') ?>" />
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Retenue*</label>
                                                    <input type="text" class="form-control" disabled value="<?= number_format($retenue, 0, '.', ' ') ?>" />
                                                </div>
                                            </div>
                                        </div>


                                        <hr>
                                        <h6 class="mb-4">Détail Facture</h6>
                                        <div class="row ">
                                            <div class="col-12">
                                                <div class="bg-secondary rounded h-100 ">

                                                    <iframe src="../documents/bon_facture/<?= $facture ?>" width="100%" height="700px"></iframe>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 text-center">
                                                <?php
                                                if ($valide_op_dg == 1) {
                                                    echo '<p>Signature DG: Signé le ' . $date_op_dg . '</p>';
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <?php
                                                if ($valide_op_daf == 1) {
                                                    echo '<p>Signature DAF: Signé le ' . $date_op_daf . '</p>';
                                                }
                                                ?>

                                            </div>
                                            <div class="col-md-4 text-center">
                                                <?php
                                                if ($valide_op_controle == 1) {
                                                    echo '<p>Signature Contrôlleur ' . $date_op_controle . '</p>';
                                                }
                                                ?>
                                            </div>
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