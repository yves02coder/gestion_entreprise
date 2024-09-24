<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/userController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg = 8;
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
                            <h1>Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Paramètre</a></li>
                                <li class="breadcrumb-item active">User</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="../dist/img/user.jpg" alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center"><?= $_SESSION['nom'] ?> <?= $_SESSION['prenom'] ?></h3>

                                    <p class="text-muted text-center"><?= $_SESSION['role'] ?></p>


                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->


                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Informations</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#maj" data-toggle="tab">Mise à jour infos</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Changer mot de passe</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="info">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Nom</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" readonly value="<?= $_SESSION['nom'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Prénoms</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" readonly value="<?= $_SESSION['prenom'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" readonly value="<?= $_SESSION['email'] ?>">
                                                    </div>
                                                </div>
                                               
                                            </form>
                                            <!-- /.post -->
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="maj">
                                            <form class="form-horizontal" method="POST">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Nom</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="nom" name="nom" required value="<?= $_SESSION['nom'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Prénoms</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="prenom" name="prenom" required value="<?= $_SESSION['prenom'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="email" name="email" required value="<?= $_SESSION['email'] ?>">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <div class=" col-sm-10 text-center  py-2">
                                                        <button type="submit" class="btn btn-success" id="maj_info" name="maj_info">Mise à jour</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="password">
                                            <form class="form-horizontal" method="POST">
                                                <div class="input-group mb-3">
                                                    <label class="col-sm-4 col-form-label">Ancien mot de passe</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                    </div>
                                                    <input type="password" class="form-control" placeholder="Ancien mot de passe" name="Apassword" id="Apassword">
                                                    <button class="btn btn-sm btn-primary input-group-text" id="afficher_pwd"> <i class="fa fa-eye"></i></button>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <label class="col-sm-4 col-form-label">Nouveau mot de passe</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                    </div>
                                                    <input type="password" class="form-control" placeholder="Nouveau mot de passe" name="Npassword" id="Npassword">
                                                    <button class="btn btn-sm btn-primary input-group-text" id="afficher_pwd1"> <i class="fa fa-eye"></i></button>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <label class="col-sm-4 col-form-label">Confirmer mot de passe</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                    </div>
                                                    <input type="password" class="form-control" placeholder=" Confirmer mot de passe" name="Cpassword" id="Cpassword">
                                                    <button class="btn btn-sm btn-primary input-group-text" id="afficher_pwd2"> <i class="fa fa-eye"></i></button>
                                                </div>
                                                <div class="form-group row">
                                                    <div class=" col-sm-10 text-center  py-2">
                                                        <button type="submit" class="btn btn-success" id="maj_pass" name="maj_pass">valider</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
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
        msg = <?php echo json_encode($msg); ?>;

        if (msg == 0) {
            $(function() {
                toastr.error('Erreur sql.')
            });
        }
        if (msg == 2) {
            $(function() {
                toastr.success('Informations misent à jour .')
            });
        }
        if (msg == 3) {
            $(function() {
                toastr.error('Ce email existe déjà.')
            });
        }
        if (msg == 4) {
            $(function() {
                toastr.success('Mot de passe bien modifié')
            });
        }
        if (msg == 5) {
            $(function() {
                toastr.error('Mot de passe incorrect')
            });
        }
        if (msg == 6) {
            $(function() {
                toastr.error('Les deux mots de passe sont différents.')
            });
        }

        
    btn = document.getElementById('afficher_pwd');
    pwd = password = document.getElementById('Apassword');
    btn1 = document.getElementById('afficher_pwd1');
    pwd1 = password = document.getElementById('Npassword');
    btn2 = document.getElementById('afficher_pwd2');
    pwd2 = password = document.getElementById('Cpassword');
    btn.onclick = function(e) {
      e.preventDefault();
      if (pwd.type == "password") {
        pwd.type = "text";
      } else {
        pwd.type = "password";
      }
    }
    btn1.onclick = function(e) {
      e.preventDefault();
      if (pwd1.type == "password") {
        pwd1.type = "text";
      } else {
        pwd1.type = "password";
      }
    }

    btn2.onclick = function(e) {
      e.preventDefault();
      if (pwd2.type == "password") {
        pwd2.type = "text";
      } else {
        pwd2.type = "password";
      }
    }
  
    </script>
    <!-- End custom js for this page -->
</body>

</html>