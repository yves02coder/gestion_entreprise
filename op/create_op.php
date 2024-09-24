<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require_once('../configuration/opController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');


$resultats = bon_facture($_GET['id']);
foreach ($resultats as $donnees) {

    $date_facture = date('d/m/Y', strtotime($donnees['date_facture']));
    $reference = $donnees['reference_facture'];
    $montant = $donnees['montant_facture'];
    $facture = $donnees['facture'];
    $nom_fournisseur = $donnees['nom_fournisseur'];
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

                <?php
                if (isset($_GET['msg']) && ($_GET['msg'] == 1)) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      Erreur téléchargement fichier
      </div>';
                } else if (isset($_GET['msg']) && ($_GET['msg'] == 2)) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      Inserer un pdf
      </div>';
                } else if (isset($_GET['msg']) && ($_GET['msg'] == 3)) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       Type non supporté
        </div>';
                }
                ?>
                <h4 class="mb-4">Ordre de paiement</h4>
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Ordre de paiement de la Facture <?= $reference ?> du <?= $date_facture ?></h6>

                            <form method="POST" enctype="multipart/form-data">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-sm-10 col-form-label">Date*</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" readonly value="<?= gmdate('d/m/Y') ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-sm-10 col-form-label">Fournisseur*</label>
                                            <input type="text" class="form-control" disabled value="<?= $nom_fournisseur ?>" />
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="col-sm-10 col-form-label">Référence facture*</label>
                                            <input type="text" class="form-control" disabled value="<?= $reference ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="col-sm-10 col-form-label">Montant*</label>
                                            <input type="text" class="form-control" disabled value="<?= number_format($montant, 0, '.', ' ') ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="col-sm-10 col-form-label">Retenue*</label>
                                            <input type="number" class="form-control" name="retenue" id="retenue" min="0"  />
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h6 class="mb-4">Détail Facture</h6>
                                <div class="row ">
                                    <div class="col-12">
                                        <div class="bg-secondary rounded h-100 ">

                                            <iframe src="../documents/facture/<?= $facture ?>" width="100%" height="800px"> test</iframe>

                                        </div>
                                    </div>
                                </div>


                                <div class="text-center  py-4">
                                    <button type="submit" class="btn btn-primary mr-2" name="creer_op" id="creer_op">Enregistrer</button>
                                    <button type="reset" class="btn btn-dark">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- partial:partials/_footer.html -->
            <?php include_once('../partials/body_footer.php'); ?>


            <!-- partial -->
        </div>

    </div>

</body>

</html>