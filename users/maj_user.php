<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/userController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg=5;
if (isset($_GET['msg'])){
  $msg=$_GET['msg'];
}
$users=getElementByID('users','id_user',$_GET['id']);
foreach($users as $user){
    $nom=$user['nom'];
    $prenom=$user['prenom'];
    $email=$user['email'];
    $role=$user['role'];
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
                            <h1>Utilisateur</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Paramètre</a></li>
                                <li class="breadcrumb-item active">Utilisateur</li>
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
                                    <h3 class="card-title">Mise à jour utilisateur</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">

                                    <div class="row mb-3">
                                            <label for="nom" class="col-sm-4 col-form-label">Nom*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nom" name="nom" required value="<?=$nom?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="prenom" class="col-sm-4 col-form-label">Prénoms*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="prenom" name="prenom" required value="<?=$prenom?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-sm-4 col-form-label">Email*</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="email" name="email" required value="<?=$email?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="role" class="col-sm-4 col-form-label">Rôle*</label>
                                            <div class="col-sm-8">
                                                <select class=" form-control   " name="role" id="role" required>

                                                <?php   
                                                echo'<option value="commercial"';if ($role=="commercial" ) {echo 'selected';} echo'>Commercial</option>
                                                    <option value="comptable"';if ($role=="comptable" ) {echo 'selected';} echo'>Comptable</option>
                                                    <option value="superviseur"';if ($role=="superviseur" ) {echo 'selected';} echo'>Superviseur</option>
                                                    <option value="superviseur_v"';if ($role=="superviseur_v" ) {echo 'selected';} echo'>Superviseur_vente</option>
                                                   <option value="controleur"';if ($role=="controleur" ) {echo 'selected';} echo'>Contrôleur</option>
                                                    <option value="daf"';if ($role=="daf" ) {echo 'selected';} echo'>DAF</option>
                                                    <option value="dg"';if ($role=="dg" ) {echo 'selected';} echo'>DG</option>
                                                    <option value="admin"';if ($role=="admin" ) {echo 'selected';} echo'>Admin</option>';
                                          
                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-success mr-2" name="maj_user" id="maj_user">Mise à jour</button>
                                          
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
      toastr.error('Ce user existe déjà.')
    });
     } 
    </script>
    <!-- End custom js for this page -->
</body>

</html>