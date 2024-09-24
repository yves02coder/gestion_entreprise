<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/bon_commandeController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');


$resultats = proforma($_GET['id']);
foreach ($resultats as $donnees) {

    $date = date('d/m/Y', strtotime($donnees['date_proforma']));
    $client = $donnees['nom_client'];
    $contact = $donnees['contact'];
    $adresse = $donnees['adresse'];
    $remise = $donnees['remise'];
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
                            <h1>Proforma</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Vente</a></li>
                                <li class="breadcrumb-item active">Proforma</li>
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
                                    <h3 class="card-title"> Proforma N<sup>o</sup>: FP/ARSN/<?= $_GET['id'] ?> </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">


                                    <div class="row d-flex flex-row-reverse px-4">
                                        <div class="col-md-3 float-right">
                                            <h5 class="text-center"> FACTURE PROFORMA </h5>

                                            <p class="text-center"><?= $date ?></p>
                                            <hr />
                                            <p class="text-center">N<sup>o</sup>: FP/ARSN/<?= $_GET['id'] ?></p>
                                            <hr />
                                        </div>

                                    </div>

                                    <div class="row px-2 ">
                                        <div class="col-md-4 text-left">
                                            <h6> DESTINATAIRE</h6>
                                            <hr />
                                            <p><h6> <?= $client ?></h6>
                                             <?= $adresse ?> <br />
                                             <?= $contact ?></p>
                                            

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
                                                $produits = produits_proforma($_GET['id']);
                                                foreach ($produits as $produit) {


                                                    echo '<tr>  
                                                        <td>' . $produit['libelle'] . '</td>
                                                        <td>' . $produit['nombre'] . '</td>
                                                        <td>' . number_format($produit['prix'], 0, ',', ' ') . '</td>
                                                        <td>' . number_format($produit['Total'], 0, ',', ' ') . '</td>
                                                        </tr>';
                                                }


                                                $TTC = montant_proforma($_GET['id']);

                                                $montant_lettre = new NumberFormatter('fr', NumberFormatter::SPELLOUT);

                                                echo '
                                                <tr> <td colspan="3"><b>Montant Total</b></td>
                                                <td colspan="3"><b>' . number_format($TTC, 0, ',', ' ') . ' FCFA</b></td></tr>
                                                <tr> <td colspan="3"><b>Remise</b></td>
                                                <td colspan="3"><b>' . number_format($remise, 0, ',', ' ') . ' FCFA</b></td></tr>
                                                <tr> <td colspan="3"><b>Total </b></td>
                                                <td colspan="3"><b>' . number_format(intval($TTC - $remise), 0, ',', ' ') . ' FCFA</b></td></tr>
                      
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                            <div class="text-right">
                                            <p > <b>' . $montant_lettre->format(($TTC - $remise)) . ' FRANCS CFA</b></p>
                                            </div>';

                                                ?>


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
            // let btn_del= document.querySelector
        </script>
    </div>
    <!-- End custom js for this page -->
</body>

</html>