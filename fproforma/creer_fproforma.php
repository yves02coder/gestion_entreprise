<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/fproformaController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');

$msg = 5;
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
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
                            <h1>Proforma/Fournisseur</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Budget</a></li>
                                <li class="breadcrumb-item active">Proforma/Fournisseur</li>
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
                                    <h3 class="card-title"> Nouvelle Proforma/Fournisseur</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" enctype="multipart/form-data">
                                    <input type="number" id="counter" name="counter" style="display:none" />
                                    <div class="card-body">
                                        <div id="zone_ligne">
                                            <div class="row">
                                                <div class="col-md-4 ">
                                                    <div class="form-group ">
                                                        <label for="service" class="col-sm-6 col-form-label"> Service*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control select2" name="service" id="service"  onchange="ajoutbesoin()" required>
                                                                <option value="-1" disabled selected>---------Selectionner service--------</option>

                                                                <?php
                                                                $services = Alltable('services', 'id_service');
                                                                foreach ($services as $service) {
                                                                    echo '<option value="' . $service['id_service'] . '">' . $service['nom_service'] . ' </option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="form-group ">
                                                        <label for="besoin" class="col-sm-6 col-form-label"> Besoin*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control select2" name="besoin" id="besoin" required>
                                                                <option value="-1" disabled selected>---------------Selectionner besoin-------------</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="ligne_ressource0">

                                                <div class="col-md-2 ">
                                                    <div class="form-group ">
                                                        <label for="annee" class="col-sm-12 col-form-label"> Fournisseur*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control select2" name="fournisseur0" id="fournisseur0" required>
                                                                
                                                                <?php
                                                                $fournisseurs= fournisseur_valide();
                                                                foreach($fournisseurs as $fournisseur){
                                                                echo'<option value="'.$fournisseur['id_fournisseur'].'">'.$fournisseur['nom_fournisseur'].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 ">
                                                    <div class="form-group ">
                                                        <label for="date" class="col-sm-6 col-md-6 col-form-label"> Date*</label>
                                                        <div class="col-sm-12">
                                                            <input type="date" class="form-control" name="date_fproforma0" id="date_fproforma0" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 ">
                                                    <div class="form-group ">
                                                        <label for="service" class="col-sm-8  col-form-label"> Référence*</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="reference0" id="reference0" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group ">
                                                        <label class="col-sm-8 col-form-label">Montant*</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" min="0" name="montant0" id="montant0" required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label class="col-sm-8 col-form-label">Proforma* (.PDF)</label>
                                                        <div class="col-sm-12">
                                                            <input class="form-control " type="file" id="proforma0" name="proforma0" accept="application/pdf, application/PDF" required>
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
                                            <button type="submit" class="btn btn-warning mr-2" name="creer_fproforma" id="creer_fproforma">Enregistrer</button>
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

            // Action du bouton ajout ligne
            // $('.btnaddligne').click(function(e) {
            function ajout() {
                x++;
                //  e.preventDefault();
                $('#counter').val(x);
                ajoutligne(x);

            };

            
            function ajoutligne(x) {
                $('#zone_ligne').append(`
                   
                
                <div class="row" id="ligne_ressource` + x + `">

                <div class="col-md-2 ">
                                                    <div class="form-group ">
                                                        <label for="annee" class="col-sm-12 col-form-label"> Fournisseur*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="fournisseur` + x + `" id="fournisseur` + x + `" required>
                                                                
                                                                <?php
                                                                $fournisseurs= fournisseur_valide();
                                                                foreach($fournisseurs as $fournisseur){
                                                                echo'<option value="'.$fournisseur['id_fournisseur'].'">'.$fournisseur['nom_fournisseur'].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 ">
                                                    <div class="form-group ">
                                                        <label for="emploi" class="col-sm-6 col-md-6 col-form-label"> Date*</label>
                                                        <div class="col-sm-12">
                                                            <input type="date" class="form-control" name="date_fproforma` + x + `" id="date_fproforma` + x + `" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 ">
                                                    <div class="form-group ">
                                                        <label for="service" class="col-sm-8  col-form-label"> Référence*</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="reference` + x + `" id="reference` + x + `" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group ">
                                                        <label class="col-sm-8 col-form-label">Montant*</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" min="0" name="montant` + x + `" id="montant` + x + `" required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label class="col-sm-8 col-form-label">Proforma*</label>
                                                        <div class="col-sm-12">
                                                            <input class="form-control " type="file" id="proforma` + x + `" name="proforma` + x + `" accept="application/pdf, application/PDF" required>
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


                    function ajoutbesoin() {  
                            id_service=$('#service option:selected').val();
                        $.ajax({
                        type: 'POST',
                        url: "ajax.php",
                        data: {id_service:id_service},
                        success: function(resultat){
                                $('#besoin').html(resultat);
                                
                            }
                        }); }

            function supprime_ligne(x){   
                 $('#ligne_ressource'+x+'').remove();     
            }

                        
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