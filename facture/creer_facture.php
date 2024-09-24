<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/factureController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');



global $tab_idproduit;
global $tab_codeproduit;
global $tab_libelle;
$tab_idproduit = array();
$tab_codeproduit = array();
$tab_libelle = array();
$resultats = produit_valide();
foreach ($resultats as $donnees) {
    $tab_idproduit[] = $donnees['id_produit'];
    $tab_codeproduit[] = $donnees['code_produit'];
    $tab_libelle[] = $donnees['libelle'];
}

$resultats = commande($_GET['id']);
foreach ($resultats as $resultat) {
    $client = $resultat['nom_client'];
    $date_facture = date('d/m/Y', strtotime($resultat['date_commande']));
    $commande = $resultat['commande'];
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
                            <h1>Facture</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Vente</a></li>
                                <li class="breadcrumb-item active">Facture</li>
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
                                    <h3 class="card-title"> Facture de la commande N<sup>o</sup>BC/ARSN/<?= $_GET['id'] ?> du <?= $date_facture ?></h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <input type="number" id="counter" name="counter" style="display:none" />
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-3 col-form-label">Date*</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" readonly value="<?= gmdate('d/m/Y') ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-6 col-form-label">Client*</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" readonly value="<?= $client ?>" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="col-sm-6 col-form-label">Remise*</label>
                                                    <div class="col-sm-12">
                                                        <input type="number" class="form-control" required min="0" name="remise" id="remise" value="<?= 0 ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-12">

                                                <iframe src="../documents/commande/<?= $commande ?>" width="100%" height="500px"> </iframe>

                                            </div>

                                        </div>
                                        <hr>
                                        <h6 class="mb-4">Détail commande</h6>
                                        <div id="zone_produit">
                                            <div class="row" id="ligne_produit0">

                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label class="col-sm-3 col-form-label">Produit*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="produit0" id="produit0" required onchange="prix(this.id)">
                                                                <option selected disabled value="-1">-------Selectionner Produit------</option>
                                                                <?php
                                                                $produits = produit_valide();
                                                                foreach ($produits as $produit) {
                                                                    echo '<option value="' . $produit['id_produit'] . '">' . $produit['code_produit'] . ':' . $produit['libelle'] . ' </option>';
                                                                }

                                                                ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
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
                                            <button type="submit" class="btn btn-warning mr-2" name="creer_facture" id="creer_facture">Enregistrer</button>
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
        <script type="text/javascript">
            // let btn_del= document.querySelector

            x = 0;
            tableau = <?php echo json_encode($tab_idproduit); ?>;
            tableau1 = <?php echo json_encode($tab_codeproduit); ?>;
            tableau2 = <?php echo json_encode($tab_libelle); ?>;
            // Action du bouton ajout produit 
            function ajout() {
                x++;
                //  e.preventDefault();
                $('#counter').val(x);
                ajoutproduit(x);

            };
            /* $('#btnaddligne').click(function(e){
                 x++;
                 e.preventDefault();
                 $('#counter').val(x);   
                 ajoutproduit(x);
                 
             })*/
            function ajoutproduit(x) {

                // var produit ='#produit'+(x-1);

                //var valeur1=$(machine+' option:selected').val();
                /* var valeur=$('#produit'+(x-1)+' option:selected').val();
                var indice= tableau.indexOf(valeur);
                
                tableau.splice(indice,1);
                tableau1.splice(indice,1);
                tableau2.splice(indice,1)*/


                $('#zone_produit').append(`


<div class="row" id="ligne_produit` + x + `">
                   <div class="col-md-4 id="ligne` + x + `">
                     <div class="form-group ">
                       <label class="col-sm-4 col-form-label">Produit` + x + `*</label>
                       <div class="col-sm-12">
                       <select class="form-control" name="produit` + x + `" id="produit` + x + `" required onchange="prix(this.id)" >
                         <option value="-1">-------Selectionner Produit------</option>
                        
                       </select>
                       </div>
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group ">
                       <label class="col-sm-6 col-form-label">Quantité` + x + `*</label>
                       <div class="col-sm-12">
                         <input type="number" class="form-control" min="0" name="quantite` + x + `" id="quantite` + x + `" required />
                       </div>
                     </div>
                   </div>
                   <div class="col-md-3">
                     <div class="form-group ">
                       <label class="col-sm-6 col-form-label">Prix uintaire` + x + `</label>
                       <div class="col-sm-12">
                       <input type="number" class="form-control" min="0" name="prix` + x + `" id="prix` + x + `" required/>
                       </div>
                     </div>
                   </div>
                  
                     <div class="col-md-1">
                     <label class="col-sm-6 col-form-label py-3"></label>                           
                         <div class="py-1 ">
                            <button class="btn btn-success btn-sm btnaddligne" name="btnaddligne" id="btnaddligne" onclick="ajout(this.id)" ><i class="fa fa-plus"></i></button>
                            <button class="btn btn-danger btn-sm btnaddligne" name="btndelligne` + x + `" id="btndelligne` + x + `" onclick="supprime_ligne(` + x + `)"><i class="fa fa-trash"></i></button>
                                                
                            </div>
                     </div>
                    
                 </div>

   `)
                $.ajax({
                    type: 'POST',
                    url: "ajax.php",
                    data: {
                        click: 'click',
                        tableau: tableau,
                        tableau1: tableau1,
                        tableau2: tableau2
                    },
                    success: function(resultat) {

                        $('#produit' + x).html(resultat);
                    }
                });

            }
            function supprime_ligne(x){   
                 $('#ligne_produit'+x+'').remove();     
            }

            function prix(id) {

                i = id;
                id_produit = $('#' + i + ' option:selected').val();
                var numero = i.substr(-1);
                var zone = "prix" + numero;
                afficherprix(id_produit, zone);
            }

            function afficherprix(id_produit, zone) {
                $.ajax({
                    type: 'POST',
                    url: "ajax.php",
                    data: {
                        id_produit: id_produit
                    },
                    success: function(resultat) {
                        $('#' + zone).val(resultat);

                    }
                });
            }

            $(function() {
                $('.select2').select2();
                theme: 'bootstrap4'
            });
        </script>
    </div>
    <!-- End custom js for this page -->
</body>

</html>