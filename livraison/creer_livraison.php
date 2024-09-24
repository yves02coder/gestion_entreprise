<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/livraisonController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');


$resultats = bon_commande($_GET['id']);
foreach ($resultats as $donnees) {
    
    $date_commande = date('d/m/Y', strtotime($donnees['date_commande']));
    $id_engagement=$donnees['id_engagement'];
    $proforma = $donnees['proforma'];
    $fournisseur = $donnees['nom_fournisseur'];
    $montant = number_format($donnees['montant_fp'], 0, '.', ' ');
    $objet = $donnees['objet'];
    $date_f = date('d/m/Y', strtotime($donnees['date_fproforma']));
   
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
                                    <h3 class="card-title"> Livraison de <?= $objet ?> du <?= $date_commande ?> </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label class="col-sm-10 col-form-label">Date de la livraison*</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" readonly value="<?= gmdate('d/m/Y') ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="col-sm-10 col-form-label">Fournisseur*</label>
                                            <input type="text" class="form-control" disabled value="<?= $fournisseur ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-5">

                                        <div class="form-group">
                                            <label for="piece" class="col-sm-10 col-form-label">Pièce justificative*</label>
                                            <input class="form-control " type="file" id="piece" name="piece" accept="application/pdf, application/PDF" required>
                                        </div>
                                    </div>
                                </div>
                                      
                                        <hr>
                                        <h6 class="mb-4">Info sur commande</h6>
                                        <div id="zone_produit">
                                            <table class="table table-sm table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Désignation</th>
                                                        <th>Quantité</th>
                                                        <th>Prix Unitaire (FCFA)</th>
                                                        <th>Prix Total (FCFA)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $produits = produit_commande($id_engagement);
                                                    foreach ($produits as $produit) {


                                                        echo '<tr>  
                                                        <td>' . $produit['libelle_produit'] . '</td>
                                                        <td>' . $produit['quantite'] . '</td>
                                                        <td>' . number_format($produit['prix'], 0, ',', ' ') . '</td>
                                                        <td>' . number_format($produit['total'], 0, ',', ' ') . '</td>
                                                        </tr>';
                                                    }

                                                    $TTC = montant_commande($id_engagement);

                                                    $montant_lettre = new NumberFormatter('fr', NumberFormatter::SPELLOUT);

                                                        echo '
                                                    <tr> <td colspan="3"><b>Total</b></td>
                                                    <td colspan="3"><b>' . number_format($TTC, 0, ',', ' ') . ' FCFA</b></td></tr>
                                            
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                        </div>
                                                    <div class="text-right">
                                                    <p > <b>' . $montant_lettre->format($TTC) . ' FRANCS CFA</b></p>
                                                    </div>';

                                                    ?>
                                <div class="text-center  py-4">
                                    <button type="submit" class="btn btn-primary mr-2" name="creer_livraison" id="creer_livraison">Enregistrer</button>
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