<?php
require_once('configuration/connexionController.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SILITEC</title>
    <link rel="shortcut icon" href="./dist/img/control.jpg" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-success">

      

      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>SILOTEC</b></a>
      </div>
      <?php

      if (isset($_GET['msg']) && ($_GET['msg'] == 0)) {
        echo ' <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 Erreur d\'envoi de requête.
              </div>';
      } else if (isset($_GET['msg']) && ($_GET['msg'] == 1)) {
        echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 Email ou Mot de passe incorrect
              </div>';
      } 
      ?>
      <div class="card-body">
        <p class="login-box-msg">Connectez-vous pour démarrer votre session</p>

        <form method="post">

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="email" class="form-control" placeholder="Email" required name="email" id="email">

          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input type="password" class="form-control" placeholder="Password" required name="password" id="password">
            <button class="btn btn-sm btn-primary input-group-text" id="afficher_pwd"> <i class="fa fa-eye"></i></button>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" name="connexion" id="connexion" class="btn btn-success btn-block">Connexion</button>
            </div>
          </div>
      </div>
      </form>


      <!-- /.social-auth-links -->
      <div class="form-group ">
        <p class="text-center mb-3" ><a href="forget_password.php" style="color: #f60606">Mot de passe oublié?</a></p>
      </div>


    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <!-- Template Javascript -->

  <script>
    btn = document.getElementById('afficher_pwd');
    pwd = password = document.getElementById('password');
    btn.onclick = function(e) {
      e.preventDefault();
      if (pwd.type == "password") {
        pwd.type = "text";
      } else {
        pwd.type = "password";
      }
    }
  </script>
</body>

</html>
