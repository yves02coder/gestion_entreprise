<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/bon_commandeController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');


$resultats = bon_commande($_GET['id']);
foreach ($resultats as $donnees) {
    $service = $donnees['nom_service'];
    $date = date('d/m/Y', strtotime($donnees['date_saisie_b']));
    $date_commande = date('d/m/Y', strtotime($donnees['date_commande']));
    $annee = $donnees['annee']; 
    $nature=$donnees['libelle_nature'];
    $fournisseur = $donnees['nom_fournisseur'];  
    $emploi = $donnees['libelle_emploi'];  
    $id_ligne_emploi=$donnees['id_ligne_emploi'];
    $compte_emploi=$donnees['compte_emploi'];
    $montant = number_format($donnees['montant_fp'], 0, '.', ' ');
    $objet = $donnees['objet'];
    $proforma = $donnees['proforma'];
    $id_engagement=$donnees['id_engagement'];
    $engagement = $donnees['engagement'];
    $date_f = date('d/m/Y', strtotime($donnees['date_fproforma']));
    $type = $donnees['type_engagement'];
    $signature_daf = $donnees['signature_daf'];
    $signature_dg= $donnees['signature_dg'];
    $date_signature_daf = date('d/m/Y', strtotime($donnees['date_signature_daf']));
    $date_signature_dg = date('d/m/Y', strtotime($donnees["date_signature_dg"]));
    $transfert=$donnees['transfert'];
    $date_transfert = date('d/m/Y', strtotime($donnees['date_transfert']));
    
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
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title"> Bon de commande N<sup>o</sup>:BC/<?= $_GET['id'] ?>/<?=$fournisseur ?> </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-3 ">
                                            <div class="form-group ">
                                                <label for="service" class="col-sm-6 col-form-label"> Service*</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="service" id="service" value="<?= $service ?>" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group ">
                                                <label for="emploi" class="col-sm-6 col-form-label"> Ligne emploi*</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control " name="emploi" id="emploi" value="<?= $emploi ?>" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group ">
                                                <label for="date" class="col-sm-6 col-form-label"> Date besion*</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control " readonly name="date" id="date" value="<?= $date ?>" required>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group ">
                                                <label for="objet" class="col-sm-6 col-form-label"> Objet*</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control " readonly name="objet" id="objet" value="<?= $objet ?>" required>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-2 ">
                                            <div class="form-group ">
                                                <label for="date_f" class="col-sm-12 col-form-label"> Date proforma*</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control " readonly name="date_f" id="date_f" value="<?= $date_f ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 ">
                                            <div class="form-group ">
                                                <label for="date" class="col-sm-12 col-form-label"> Montant*</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control " readonly name="montant" id="date" value="<?= $montant ?>" required>


                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 ">
                                            <div class="form-group ">
                                                <label for="type_engagement" class="col-sm-12 col-form-label"> Type*</label>
                                                <div class="col-sm-12">

                                                    <input type="text" class="form-control " readonly name="montant" id="date" value="<?= $type ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 ">
                                            <div class="form-group ">
                                                <label for="proforma" class="col-sm-12 col-form-label"> Proforma*</label>
                                                <div class="col-sm-12">
                                                    <a href="../documents/fproforma/<?=$proforma ?>" target="_blank"><?= $proforma ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 ">
                                            <div class="form-group ">
                                                <label for="proforma" class="col-sm-12 col-form-label"> Bon d'engagement*</label>
                                                <div class="col-sm-12">
                                                    <a href="../documents/engagemnt/<?= $engagement ?>" target="_blank"><?= $engagement ?></a>
                                                </div>
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

                                                
                                                $TTC=montant_commande($id_engagement);
                                                
                                                $montant_lettre= new NumberFormatter('fr',NumberFormatter::SPELLOUT);
 
                                                 echo '
                                                <tr> <td colspan="3"><b>Total</b></td>
                                                <td colspan="3"><b>' . number_format($TTC, 0, ',', ' ') . ' FCFA</b></td></tr>
                      
                                        </tr>
                                    </tbody>
                                   </table>
                                </div>
                                   <div class="text-right">
                                   <p > <b>'.ucfirst($montant_lettre->format($TTC)).' FRANCS CFA</b></p>
                                </div>';
                                  
                                                ?>
                                                <hr>
                        <div class="row">
                            <div class="col-md-4 text-center">
                            <?php
                           if ($signature_daf==1){
                            echo'<p>Signature DAF: Signé le '.$date_signature_daf.'</p>';
                           } 
                           ?>
                            </div>
                            <div class="col-md-4 text-center">
                            <?php
                           if ($signature_dg==1){
                            echo'<p>Signature DG: Signé le '.$date_signature_dg.'</p>';
                           } 
                           ?>

                            </div>
                            <div class="col-md-4 text-center">
                           <?php
                           if ($transfert==1){
                            echo'<p>Tranferé au fournisseur le '.$date_transfert.'</p>';
                           } 
                           ?>
                            </div>
                        </div>
                                 
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