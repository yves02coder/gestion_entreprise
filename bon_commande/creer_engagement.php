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

$resultats = fproforma_select($_GET['id']);
foreach ($resultats as $donnees) {
    $service = $donnees['nom_service'];
    $date = date('d/m/Y', strtotime($donnees['date_saisie_b']));
    $fournisseur = $donnees['nom_fournisseur'];
    $id_fproforma = $donnees['id_fproforma'];
    $emploi = $donnees['libelle_emploi'];
    $montant = number_format($donnees['montant_fp'], 0, '.', ' ');
    $objet = $donnees['objet'];
    $proforma = $donnees['proforma'];
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
                                    <h3 class="card-title"> Nouveau Bon d'engagement</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <input type="number" id="counter" name="counter" style="display:none" />
                                    <input type="text" id="id_fproforma" name="id_fproforma" value="<?=$id_fproforma?>" style="display:none" />
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-3 ">
                                                <div class="form-group ">
                                                    <label for="service" class="col-sm-6 col-form-label"> Service*</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" name="service" id="service" value="<?=$service?>" readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="form-group ">
                                                    <label for="emploi" class="col-sm-6 col-form-label"> Ligne emploi*</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control " name="emploi" id="emploi" value="<?=$emploi?>" readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="form-group ">
                                                    <label for="date" class="col-sm-6 col-form-label"> Date besion*</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control " readonly name="date" id="date" value="<?=$date?>" required>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="form-group ">
                                                    <label for="objet" class="col-sm-6 col-form-label"> Objet*</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control " readonly name="objet" id="objet" value="<?=$objet?>" required>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 ">
                                                <div class="form-group ">
                                                    <label for="proforma" class="col-sm-6 col-form-label"> Fournisseur*</label>
                                                    <div class="col-sm-12">

                                                        <input type="text" class="form-control " readonly name="fournisseur" id="fournisseur" value="<?=$fournisseur?>" required>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 ">
                                                <div class="form-group ">
                                                    <label for="date_f" class="col-sm-12 col-form-label"> Date proforma*</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control " readonly name="date_f" id="date_f" value="<?=$date_f?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 ">
                                                <div class="form-group ">
                                                    <label for="date" class="col-sm-12 col-form-label"> Montant*</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control " readonly name="montant" id="date" value="<?=$montant?>" required>


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 ">
                                                <div class="form-group ">
                                                    <label for="type_engagement" class="col-sm-12 col-form-label"> Type*</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control " name="type_engagement" id="type_engagement" required>
                                                            <option value="EXONORE">EXONORE</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 ">
                                                <div class="form-group ">
                                                    <label for="proforma" class="col-sm-12 col-form-label"> Proforma*</label>
                                                    <div class="col-sm-12">
                                                        <a href="../documents/fproforma/<?= $proforma ?>" target="_blank"><?=$proforma?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h6 class="mb-4">Détail commande</h6>
                                        <div id="zone_produit">
                                            <div class="row" id="ligne_ressource0">

                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label class="col-sm-3 col-form-label">Produit*</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="produit0" id="produit0" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Quantité*</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" min="0" name="quantite0" id="quantite0" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Prix uintaire</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" min="0" name="prix0" id="prix0" required />

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">

                                                    <label class="col-sm-6 col-form-label py-3"></label>
                                                    <div class="py-1 ">
                                                        <button class="btn btn-success btn-sm btnaddligne" name="btnaddligne" id="btnaddligne" onclick="ajout(this.id)"><i class="fa fa-plus"></i></button>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-warning mr-2" name="creer_engagement" id="creer_engagement">Enregistrer</button>
                                            <button type="reset" class="btn btn-dark">Annuler</button>
                                        </div>


                                        
                                    <div></form>
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


            x = 0;

            // Action du bouton ajout ligne
            // $('.btnaddligne').click(function(e) {
            function ajout() {
                x++;
                //  e.preventDefault();
                $('#counter').val(x);
                ajoutligne(x);
            };
            function supprime_ligne(x){   
                 $('#ligne_ressource'+x+'').remove();     
            }


            function ajoutligne(x) {
                $('#zone_produit').append(`
                   
                
                <div class="row" id="ligne_ressource` + x + `">

                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label class="col-sm-3 col-form-label">Produit*</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="produit` + x + `" id="produit` + x + `" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Quantité*</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" min="0" name="quantite` + x + `" id="quantite` + x + `" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Prix uintaire</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" min="0" name="prix` + x + `" id="prix` + x + `" required />

                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-1">

                                                    <label class="col-sm-6 col-form-label py-3"></label>
                                                    <div class="py-1 ">
                                                        <button class="btn btn-success btn-sm btnaddligne" name="btnaddligne" id="btnaddligne" onclick="ajout(this.id)"><i class="fa fa-plus"></i></button>
                                                        <button class="btn btn-danger btn-sm btnaddligne" name="btndelligne` + x + `" id="btndelligne` + x + `" onclick="supprime_ligne(` + x + `)"><i class="fa fa-trash"></i></button>
                                                      
                                                    </div>
                                                </div>

</div> `)

            }

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
        </script>
    </div>
    <!-- End custom js for this page -->
</body>

</html>