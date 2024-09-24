<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/produitController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg=5;
if (isset($_GET['msg'])){
  $msg=$_GET['msg'];
}
$produits=getElementByID('produits','id_produit',$_GET['id']);
foreach($produits as $produit){
    
  $code= $produit['code_produit'];
    $libelle=$produit['libelle'];
   $prix= $produit['prix'];
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
                            <h1>Produit</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Paramètre</a></li>
                                <li class="breadcrumb-item active">Produit</li>
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
                                    <h3 class="card-title">Mise à jour produit</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">

                                       
                                        <div class="row mb-3">
                                            <label for="code" class="col-sm-4 col-form-label">Code produit*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="code" name="code" required readonly value="<?=$code?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="libelle" class="col-sm-4 col-form-label">Libellé*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="libelle" name="libelle" required value="<?=$libelle?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="prix" class="col-sm-4 col-form-label">Prix*</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="prix" name="prix" required value="<?=$prix?>">
                                            </div>
                                        </div>
                                       
                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-success mr-2" name="maj_produit" id="maj_produit">Mise à jour</button>
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
      toastr.error('Ce produit existe déjà.')
    });
     } 
    </script>
    <!-- End custom js for this page -->
</body>

</html>