<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/chequeController.php');
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
    $annee_s = $donnees['annee_s'];
    $annee_n = $donnees['annee_n'];
    $livraison = $donnees['livraison_id'];
    $nom_fournisseur_n = $donnees['nom_fournisseur_n'];
    $nom_fournisseur_s = $donnees['nom_fournisseur_s'];
}
$montant_paye=montant_payer($_GET['id']);
$montant_a_payer=intval($montant-$montant_paye);
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
                                    <h3 class="card-title"> Chèque de l'Ordre de paiement N<sup>o</sup>OP/ARSN/<?php if (!empty($livraison)) {
                                                                                                                    echo $annee_n;
                                                                                                                } else {
                                                                                                                    echo $annee_s;
                                                                                                                } ?>/<?= $_GET['id'] ?> </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data">

                                        <div class="row">
                                        <input type="hidden" class="form-control" name="montant" id="montant" value="<?= intval($montant) ?>" />
                                        <input type="hidden" class="form-control" name="montant_paye" id="montant_paye"  value="<?= intval($montant_paye) ?>" />
                                                   
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
                                                    <label class="col-sm-10 col-form-label">Montant*</label>
                                                    <input type="text" class="form-control" readonly value="<?= number_format($montant, 0, '.', ' ') ?>" />
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Fournisseur*</label>
                                                    <input type="text" class="form-control" readonly value="<?php if (!empty($livraison)) {
                                                                                                                echo $nom_fournisseur_n;
                                                                                                            } else {
                                                                                                                echo $nom_fournisseur_n;
                                                                                                            } ?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Ref OP*</label>
                                                    <input type="text" class="form-control" readonly value=" OP/ARSN/<?php if (!empty($livraison)) {
                                                                                                                            echo $annee_n;
                                                                                                                        } else {
                                                                                                                            echo $annee_s;
                                                                                                                        } ?>/<?= $_GET['id'] ?>" />
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Montant payé*</label>
                                                    <input type="text" class="form-control"  readonly  value="<?= number_format(intval($montant_paye), 0, '.', ' ') ?>" />
                                                </div>
                                            </div>
                                        </div>


                                        <hr>
                                        <h6 class="mb-4">Détail chèque</h6>
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Banque*</label>
                                                    <select class=" form-control" name="banque" id="banque" required>
                                                        <option value="SIB">SIB</option>
                                                        <option value="SGCI">SGCI</option>
                                                        <option value="BICICI">BICICI</option>
                                                        <option value="NSIA">NSIA</option>
                                                        <option value="BACI">BACI</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Numéro chèque*</label>
                                                    <input type="text" class="form-control" required name="numero_cheque" id="numero_cheque" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-10 col-form-label">Montant du chèque*</label>
                                                    <input type="text" class="form-control" required name="montant_cheque" id="montant_cheque" min="0" max="<?=intval($montant_a_payer)?>" value="<?= $montant_a_payer ?>" />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="text-center  py-4">
                                            <button type="submit" class="btn btn-primary mr-2" name="creer_cheque" id="creer_cheque">Enregistrer</button>
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