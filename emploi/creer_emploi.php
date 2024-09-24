<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/emploiController.php');
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
                            <h1>Emploi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Paramètre</a></li>
                                <li class="breadcrumb-item active">Emploi</li>
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
                                    <h3 class="card-title"> Nouvel emploi</h3>
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
                                                        <label for="nature" class="col-sm-6 col-md-6 col-form-label"> Nature éco*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="nature0" id="nature0" required>

                                                                <?php
                                                              $natures = getTable('natures');
                                                              foreach ($natures as $nature) {
                                                                  echo '<option value="' . $nature['id_nature'] . '">' . $nature['code_nature'] . ':' . $nature['libelle_nature'] . '</option>';
                                                              }   ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Activite*</label>

                                                        <select class="form-control " id="activite0" name="activite0" required>
                                                           
                                                            <?php
                                                            $activites = getTable('activites');
                                                            foreach ($activites as $activite) {
                                                                echo '<option value="' . $activite['id_activite'] . '">' . $activite['code_activite'] . ':' . $activite['libelle_activite'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Compte</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" min="0" name="compte0" id="compte0" required />

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Libellé </label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control"  name="libelle0" id="libelle0" required />

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">

                                                    <label class="col-sm-6 col-form-label py-3"></label>
                                                    <div class="py-1 ">
                                                        <button class="btn btn-success btn-sm btnaddligne" name="btnaddligne" id="btnaddligne" onclick="ajout(this.id)"><i class="fa fa-plus"></i></button>
                                                        <button class="btn btn-danger btn-sm " name="btndelligne` + x + `" id="btndelligne` + x + `" onclick="del(this.id)"><i class="fa fa-minus"></i></button>
                                                      
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-warning mr-2" name="creer_emploi" id="creer_emploi">Enregistrer</button>
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
                console.log(x)
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
                    
                                           
                    <div class="row" id="ligne_ressource` +x+ `">
                                                <div class="col-md-3 ">
                                                    <div class="form-group ">
                                                        <label for="nature" class="col-sm-6 col-md-6 col-form-label"> Nature éco*</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="nature` +x+ `" id="nature` +x+ `" required>

                                                                <?php
                                                              $natures = getTable('natures');
                                                              foreach ($natures as $nature) {
                                                                  echo '<option value="' . $nature['id_nature'] . '">' . $nature['code_nature'] . ':' . $nature['libelle_nature'] . '</option>';
                                                              }   ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Activite*</label>

                                                        <select class="form-control " id="activite` +x+ `" name="activite` +x+ `" required>
                                                           
                                                            <?php
                                                            $activites = getTable('activites');
                                                            foreach ($activites as $activite) {
                                                                echo '<option value="' . $activite['id_activite'] . '">' . $activite['code_activite'] . ':' . $activite['libelle_activite'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Compte</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" min="0" name="compte` +x+ `" id="compte` +x+ `" required />

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Libellé </label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control"  name="libelle` +x+ `" id="libelle` +x+ `" required />

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">

                                                    <label class="col-sm-6 col-form-label py-3"></label>
                                                    <div class="py-1 ">
                                                        <button class="btn btn-success btn-sm btnaddligne" name="btnaddligne" id="btnaddligne" onclick="ajout(this.id)"><i class="fa fa-plus"></i></button>
                                                        <button class="btn btn-danger btn-sm " name="btndelligne` + x + `" id="btndelligne` + x + `" onclick="del(this.id)"><i class="fa fa-minus"></i></button>
                                                      
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