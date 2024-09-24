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
$ressources=getElementByID('ressources','id_ressource',$_GET['id']);
foreach($ressources as $ressource){
    $code=$ressource['code_ressource'];
    $libelle=$ressource['libelle_ressource'];
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
                            <h1>Ressource</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Paramètre</a></li>
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
                        <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Mise à jour ressource</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">

                                        <div class="row mb-3">
                                            <label for="code" class="col-sm-4 col-form-label">Code Ressource*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="code" name="code" required value="<?=$code?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="libelle" class="col-sm-4 col-form-label">Libellé*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="libelle" name="libelle" required value="<?=$libelle?>">
                                            </div>
                                        </div>

                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-success mr-2" name="maj_ressource" id="maj_ressource">Mise à jour</button>
                                          
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
    </div>

    <script>
    
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
    <!-- End custom js for this page -->
</body>

</html>