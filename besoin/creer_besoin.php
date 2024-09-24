<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/besoinController.php');
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
                            <h1>Besion</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Paramètre</a></li>
                                <li class="breadcrumb-item active">Besion</li>
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
                                    <h3 class="card-title"> Nouveau besoin</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <input type="number" id="counter" name="counter" style="display:none" />
                                    <div class="card-body">
                                        <div id="zone_ligne">
                                            <div class="row" id="ligne_ressource0">

                                            <div class="col-md-3 ">
                                                    <div class="form-group ">
                                                        <label for="service" class="col-sm-6 col-md-6 col-form-label"> Service*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control " name="service0" id="service0" onchange="emploi(this.id)" required>
                                                            <option value="-1"  disabled selected> Selectionner service</option>
                                                            <?php
                                                            $services = getTable('services');
                                                            foreach ($services as $service) {
                                                                echo '<option value="' . $service['id_service'] . '">' . $service['nom_service'] . '</option>';
                                                            }
                                                            ?></select>
                                                        </div>
                                                    </div>
                                                </div>

                        
                                                <div class="col-md-3 ">
                                                    <div class="form-group ">
                                                        <label for="emploi" class="col-sm-6 col-md-6 col-form-label"> Emploi*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="emploi0" id="emploi0" required>
                                                                <option value="-1"  disabled selected> Selectionner emploi</option>
                                                            

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 ">
                                                    <div class="form-group ">
                                                        <label for="type_p" class="col-sm-12 col-md-12 col-form-label"> Type de procédure*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="type0" id="type0" required>
                                                            <option value="1">Normal</option>
                                                            <option value="2">Simplifié</option>
                                                            </select>  
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                
                                                <div class="col-md-2">
                                                    <div class="form-group ">
                                                        <label class="col-sm-12 col-form-label">Objet du besion</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="objet0" id="objet0" required />

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
                                            <button type="submit" class="btn btn-warning mr-2" name="creer_besoin" id="creer_besoin">Enregistrer</button>
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

                <div class="col-md-3 ">
                                                    <div class="form-group ">
                                                        <label for="service" class="col-sm-6 col-md-6 col-form-label"> Service*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="service` + x + `" id="service` + x + `" onchange="emploi(this.id)" required>
                                                            <option value="-1"  disabled selected> Selectionner service</option>
                                                            <?php
                                                            $services = getTable('services');
                                                            foreach ($services as $service) {
                                                                echo '<option value="' . $service['id_service'] . '">' . $service['nom_service'] . '</option>';
                                                            }
                                                            ?></select>
                                                        </div>
                                                    </div>
                                                </div>

                        
                                                <div class="col-md-3 ">
                                                    <div class="form-group ">
                                                        <label for="emploi" class="col-sm-6 col-md-6 col-form-label"> Emploi*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control select2" name="emploi` + x + `" id="emploi` + x + `" required>
                                                                <option value="-1"  disabled selected> Selectionner emploi</option>
                                           
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 ">
                                                    <div class="form-group ">
                                                        <label for="type_p" class="col-sm-12 col-md-12 col-form-label"> Type de procédure*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="type` + x + `" id="type` + x + `" required>
                                                            <option value="1">Normal</option>
                                                            <option value="2">Simplifié</option>
                                                            </select>  
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                
                                                <div class="col-md-2">
                                                    <div class="form-group ">
                                                        <label class="col-sm-12 col-form-label">Objet du besion</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="objet` + x + `" id="objet` + x + `" required />

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

</div> `)

            }
            $(function() {
                $('.select2').select2();
                theme: 'bootstrap4'
            });


                function emploi(id){
                i=id;
                id_service=$('#'+i+' option:selected').val();
                var chiffre=i.substr(7);
                var zone="emploi"+chiffre;
                afficherEmploi(id_service,zone);  
                }

                function afficherEmploi(id_service,zone) {  
                        $.ajax({
                        type: 'POST',
                        url: "ajax.php",
                        data: {id_service:id_service},
                        success: function(resultat){
                                $('#'+zone).html(resultat);
                                
                            }
                        });   
                }
                
                function supprime_ligne(x){   
                 $('#ligne_ressource'+x+'').remove();     
            }
        </script>
    </div>
    <!-- End custom js for this page -->
</body>

</html>