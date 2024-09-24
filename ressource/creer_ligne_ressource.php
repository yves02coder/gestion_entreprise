<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/ressourceController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');

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
                            <h1>Ressource</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">

                                <li class="breadcrumb-item active">Ressource</li>
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
                                    <h3 class="card-title"> Ligne ressource</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <input type="number" id="counter" name="counter" style="display:none" />
                                    <div class="card-body">
                                        <div id="zone_ligne">
                                            <div class="row" id="ligne_ressource">
                                                <div class="col-md-2 ">
                                                    <div class="form-group ">
                                                        <label for="annee" class="col-sm-6 col-form-label"> Année*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="annee0" id="annee0" required>

                                                                <?php
                                                                echo '<option value="' . gmdate('Y') . '">' . gmdate('Y') . ' </option>';
                                                                echo '<option value="' . gmdate('Y', strtotime('+1year')) . '">' . gmdate('Y', strtotime('+1year')) . ' </option>';
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">S/Ressource*</label>

                                                        <select class="form-control select2" id="sressource0" name="sressource0" required>

                                                            <?php
                                                            $sressources = getTable('sous_ressources');
                                                            foreach ($sressources as $sressource) {
                                                                echo '<option value="' . $sressource['id_sous_ressource'] . '">' . $sressource['compte_sressource'] . ':' . $sressource['libelle_sressource'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Montant</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" min="0" name="montant0" id="montant0" required />

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">

                                                    <label class="col-sm-6 col-form-label py-3"></label>
                                                    <div class="py-1 ">
                                                        <button class="btn btn-success btn-sm btnaddligne" name="btnaddligne" id="btnaddligne" onclick="ajout(this.id)"><i class="fa fa-plus"></i></button>
       
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-warning mr-2" name="creer_ligne_ressource" id="creer_ligne_ressource">Enregistrer</button>
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

            function supprime_ligne(x){   
                 $('#ligne_ressource'+x+'').remove();     
            }

            /* function del(){
             
             
            //  $('#btndelligne'+i).click(function(e){
              //    e.preventDefault(); 
                  $("ligne_ressource1").remove(); 
              
              */
            /*    function supprimeligne(x){

                    $("#p1").remove()
                }
                */
            function ajoutligne(x) {
                $('#zone_ligne').append(`
                    <div class="row" id="ligne_ressource` + x + `">
                                           
                                                <div class="col-md-2 " >
                                                    <div class="form-group ">
                                                        <label for="annee" class="col-sm-6 col-form-label"> Année*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="annee` + x + `" id="annee` + x + `" required>
                                                               <?php
                                                                echo '<option value="' . gmdate('Y') . '">' . gmdate('Y') . ' </option>';
                                                                echo '<option value="' . gmdate('Y', strtotime('+1year')) . '">' . gmdate('Y', strtotime('+1year')) . ' </option>';
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">S/Ressource*</label>
                                                        
                                                            <select class="form-control select2" id="sressource` + x + `" name="sressource` + x + `" required>
                                                            <?php
                                                            $sressources = getTable('sous_ressources');
                                                            foreach ($sressources as $sressource) {
                                                                echo '<option value="' . $sressource['id_sous_ressource'] . '">' . $sressource['compte_sressource'] . ':' . $sressource['libelle_sressource'] . '</option>';
                                                            }
                                                            ?> 
                                                            </select>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Montant</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" min="0" name="montant` + x + `" id="montant` + x + `" required />

                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-2">
                                                    
                                                     <label class="col-sm-6 col-form-label py-3"></label>
                                                        <div class="py-1 ">
                                                        <button class="btn btn-success btn-sm btnaddligne" name="btnaddligne" id="btnaddligne" onclick="ajout(this.id)"><i class="fa fa-plus"></i></button>
                                                         <button class="btn btn-danger btn-sm btnaddligne" name="btndelligne` + x + `" id="btndelligne` + x + `" onclick="supprime_ligne(` + x + `)"><i class="fa fa-trash"></i></button>
                                                        
                                                        
                                                         </div>
                                                </div>
                                                          
                    </div> 
                 `)

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