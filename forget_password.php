<?php
//require_once('configuration/connexionController.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SILOTEC</title>

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

      <?php

      if (isset($_GET['msg']) && ($_GET['msg'] == 0)) {
        echo '<div class="alert alert-danger  fade show text-center" role="alert">
                 Erreur d\'envoi de requête.
              </div>';
         }
      else if (isset($_GET['msg']) && ($_GET['msg'] == 1)) {
        echo '<div class="alert alert-danger  fade show text-center" role="alert">
                 Email ou Mot de passe incorrect
              </div>';
         }
      else if (isset($_GET['msg']) && ($_GET['msg'] == 2)) {
        echo '<div class="alert alert-success  fade show text-center" role="alert">
                 Votre mot de passe a été bien réinitialisé.
              </div>';
      }
      ?>

      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>SILOTEC</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Vous avez oublié votre mot de passe ? Ici,
          vous pouvez facilement récupérer un nouveau mot de passe.
        </p>

        <form method="post">

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="email" class="form-control" placeholder="Email" name="email" id="email">

          </div>
          <div class="row">
            <div class="col-12">
            <button type="submit" name="forget_password" id="forget_password" class="btn btn btn-block" style="background-color: #D6710C">Demande de nouveau mot de passe</button>
          </div>
          </div>
          <!-- /.col -->
      </div>
      </form>


      <!-- /.social-auth-links -->
      <div class="form-group ">
        <p class="text-center mb-3"><a href="index.php" style="color:#009E60 ">Se connecter</a></p>
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


</body>

</html>
