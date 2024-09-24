<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require_once('../configuration/proformaController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$id = $_GET['id'];

$proformas = encours($id);
foreach ($proformas as $proforma) {
    $num_proforma = $proforma['num_proforma'];
    $date_facture = date('d/m/Y', strtotime($proforma['date_facture']));
    $nom_client = $proforma['nom_client'];
    $adresse = $proforma['adresse'];
    $contact = $proforma['contact'];
    $remise = $proforma['remise'];
}
?>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('../partials/menu.php'); ?>
        <!-- partial -->
        <!-- Content Start -->
        <div class="content">
            <!-- partial:partials/_navbar.html -->
            <?php include_once('../partials/body_header.php'); ?>

            <div class="container-fluid pt-4 px-4">
                <h4 class="mb-4">Proforma</h4>
                <div class="row g-4 ">
                    <div class="col-sm-12 col-xl-12 ">
                        <div class="bg-secondary rounded h-100 p-4">

                            <div class="row d-flex flex-row-reverse px-4">
                                <div class="col-md-3 float-right">
                                    <h5 class="text-center"> FACTURE PROFORMA </h5>

                                    <p class="text-center"><?= $date_facture ?></p>
                                    <hr />
                                    <p class="text-center">N<sup>o</sup><?= $num_proforma ?></p>
                                    <hr />
                                </div>
                            </div>

                            <div class="row px-4">
                                <div class="col-md-12 text-right">
                                    <h6> DESTINATAIRE</h6>
                                    <hr />
                                    <h6> <?= $nom_client ?></h6>

                                </div>
                            </div>
                            <div class="row px-4">
                                <div class="col-md-6 text-right">
                                    <p> <?= $adresse ?> <br /><?= $contact ?></p>
                                </div>
                            </div>
                         
                            <div class="row d-flex flex-row-reverse ">
                                <div class="col-md-4 text-right">
                                    <p> Montant exprimé en Francs CFA</p>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-12">
                                    <div class="bg-secondary rounded h-100 ">

                                        <div class="table-responsive">

                                            <table class="table table-sm table-striped table-bordered ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Référence</th>
                                                        <th scope="col">Désignation </th>
                                                        <th scope="col">Qté </th>
                                                        <th scope="col">Px Unitaire </th>
                                                        <th scope="col">Montant HT</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    foreach ($proformas as $proforma) {


                                                        echo '<tr>  <td>' . $proforma['code_produit'] . '</td>
                                                        <td>' . $proforma['libelle'] . '</td>
                                                        <td>' . $proforma['nombre'] . '</td>
                                                        <td>' . $proforma['prix'] . '</td>
                                                        <td>' . $proforma['total'] . '</td>
                                                        </tr>';
                                                    }
                                                    $montant = montant_proforma($id);
                                                    $net = intval(montant_proforma($id) - $remise);
                                                    echo '<tr> <td colspan="4"><b class="text-right">Sous-total 1</b></td>
                                                    <td colspan="4"><b>' . montant_proforma($id) . '</b></td></tr>
                                                    <tr> <td colspan="4"><b>Remise</b></td>
                                                    <td colspan="4"><b>' . $remise . '</b></td></tr>
                                                    <tr> <td colspan="4"><b>Net à payer</b></td>
                                                    <td colspan="4"><b>' . $net . '</b></td></tr>';
                                                        ?>
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <!-- partial:partials/_footer.html -->
                        <?php include_once('../partials/body_footer.php'); ?>


                        <!-- partial -->
                        <!-- partial:partials/_footer.html -->

                    

                

                </div>
                </div>
                
            </body>
                
</html>