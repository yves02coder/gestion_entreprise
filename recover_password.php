<?php
//require_once('configuration/connexionController.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ARSN</title>

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
    <div class="card card-outline card-warning">

      <?php

      if (isset($_GET['msg']) && ($_GET['msg'] == 0)) {
        echo '<div class="alert alert-danger  fade show text-center" role="alert">
                 Erreur d\'envoi de requête.
              </div>';
      } else if (isset($_GET['msg']) && ($_GET['msg'] == 1)) {
        echo '<div class="alert alert-danger  fade show text-center" role="alert">
                 Email ou Mot de passe incorrect
              </div>';
      } else if (isset($_GET['msg']) && ($_GET['msg'] == 2)) {
        echo '<div class="alert alert-success  fade show text-center" role="alert">
                 Votre mot de passe a été bien réinitialisé.
              </div>';
      }
      ?>

      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>ARSN</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Vous n'êtes qu'à un pas de votre nouveau mot de passe, récupérez votre mot de passe maintenant</p>

        <form method="post">

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input type="password" class="form-control" placeholder="Password" name="Npassword" id="Npassword">
            <button class="btn btn-sm btn-primary input-group-text" id="afficher_pwd"> <i class="fa fa-eye"></i></button>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input type="password" class="form-control" placeholder=" Confirmer Password" name="Cpassword" id="Cpassword">
            <button class="btn btn-sm btn-primary input-group-text" id="afficher_pwd1"> <i class="fa fa-eye"></i></button>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" name="connexion" id="connexion" class="btn btn-warning btn-block">Changer Mot de Passe</button>
            </div>
          </div>
      </div>
      </form>


      <!-- /.social-auth-links -->
      <div class="form-group ">
        <p class="text-center mb-3"><a href="index.php">Se connecter</a></p>
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
    pwd = password = document.getElementById('Npassword');
    btn1 = document.getElementById('afficher_pwd1');
    pwd1 = password = document.getElementById('Cpassword');
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
  </script>
</body>

</html>
