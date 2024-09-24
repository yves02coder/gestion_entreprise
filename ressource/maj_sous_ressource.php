<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/ressourceController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg=5;
if (isset($_GET['msg'])){
  $msg=$_GET['msg'];
}
$sressources=getElementByID('sous_ressources','id_sous_ressource',$_GET['id']);
foreach($sressources as $sressource){
    $compte=$sressource['compte_sressource'];
    $libelle=$sressource['libelle_sressource'];
    $ressource=$sressource['ressource_id'];
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
                            <h1>S/Ressource</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Paramètre</a></li>
                                <li class="breadcrumb-item active">S/Ressource</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Mise à jour S/Ressource</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">


                                        <div class="row mb-3">
                                            <label for="compte" class="col-sm-4 col-form-label">N<sup>o</sup> Compte*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="compte" name="compte" min="0" required value="<?=$compte?>" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="libelle" class="col-sm-4 col-form-label">Libellé*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="libelle" name="libelle" required value="<?=$libelle?>" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="ressource" class="col-sm-4 col-form-label">Ressource associée*</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2" id="ressource" name="ressource" required>
                                                  <?php
                                                  $ressources=getTable('ressources');
                                                  foreach($ressources as $ressource){
                                                    echo'<option value="'.$ressource['id_ressource'].'"';
                                                    if($ressource['id_ressource']==$ressource){echo'selected';}echo'>'
                                                    .$ressource['code_ressource'].':'.$ressource['libelle_ressource'].
                                                    '</option>';
                                                  }
                                                  ?> 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-success mr-2" name="maj_sressource" id="maj_sressource">Mise à jour</button>
                                            
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
        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2();
            });

            
                msg= <?php echo json_encode($msg); ?>;

            if(msg==0){$(function() {
            toastr.error('Erreur sql.')
            });
            }
            if(msg==1){$(function() {
            toastr.error('Ce code existe déjà.')
            });
            }

            </script>
    </div>
    <!-- End custom js for this page -->
</body>

</html>