<?php
session_start();
if((!isset($_SESSION['connexion'])) || ($_SESSION['connexion']!='ok')){
    header('Location:../index.php');
}
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
            <h1>Acueil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <!--  <li class="breadcrumb-item"><a href="#">Accueil</a></li>
             <li class="breadcrumb-item active">General Form</li>-->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <!--- debut--->
          <style>


              .ctn {
                  position: relative; /* Adicionando position: relative para alinhar o texto em relação a isso */
              }

              .text-pop-up-top {
                  margin-top: 100px;
                  margin-left: -10%;
                  
                  color: #fff;
                  position: absolute;
                  font: normal 120pt Arial; /* Aumentando o tamanho do texto */
                  width: 100%;
                  text-align: center;
                  animation: text-pop-up-top 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) both,
                  tracking-in-expand 3s cubic-bezier(0.215, 0.61, 0.355, 1) both;
              }

              @-webkit-keyframes text-pop-up-top {
                  0% {
                      -webkit-transform: translateY(0);
                      transform: translateY(0);
                      -webkit-transform-origin: 50% 50%;
                      transform-origin: 50% 50%;
                      text-shadow: none;
                  }
                  100% {
                      -webkit-transform: translateY(-50px);
                      transform: translateY(-50px);
                      -webkit-transform-origin: 50% 50%;
                      transform-origin: 50% 50%;
                      text-shadow: 0 1px 0 #aaa4a4, 0 2px 0 #aaa4a4, 0 3px 0 #aaa4a4,
                      0 4px 0 #cccccc, 0 5px 0 #cccccc, 0 6px 0 #cccccc, 0 7px 0 #cccccc,
                      0 8px 0 #cccccc, 0 9px 0 #cccccc, 0 50px 30px rgba(0, 0, 0, 0.3);
                  }
              }
              @keyframes text-pop-up-top {
                  0% {
                      -webkit-transform: translateY(0);
                      transform: translateY(0);
                      -webkit-transform-origin: 50% 50%;
                      transform-origin: 50% 50%;
                      text-shadow: none;
                  }
                  100% {
                      -webkit-transform: translateY(-50px);
                      transform: translateY(-50px);
                      -webkit-transform-origin: 50% 50%;
                      transform-origin: 50% 50%;
                      text-shadow: 0 1px 0 #cccccc, 0 2px 0 #cccccc, 0 3px 0 #cccccc,
                      0 4px 0 #cccccc, 0 5px 0 #cccccc, 0 6px 0 #cccccc, 0 7px 0 #cccccc,
                      0 8px 0 #cccccc, 0 9px 0 #cccccc, 0 50px 30px rgba(0, 0, 0, 0.3);
                  }
              }
              @-webkit-keyframes tracking-in-expand {
                  0% {
                      letter-spacing: -0.5em;
                      opacity: 0;
                  }
                  40% {
                      opacity: 0.6;
                  }
                  100% {
                      opacity: 1;
                  }
              }
              @keyframes tracking-in-expand {
                  0% {
                      letter-spacing: -0.5em;
                      opacity: 0;
                  }
                  40% {
                      opacity: 0.6;
                  }
                  100% {
                      opacity: 1;
                  }
              }



              @media screen and (max-width: 992px) {
                .text-pop-up-top {
    word-wrap: break-word;
    font-size: 100px;
    display: flex;
    justify-content: center;
   text-align: justify;
  }
}

@media screen and (max-width: 600px) {
.text-pop-up-top {
    word-wrap: break-word;
    font-size: 40px;
    display: flex;
    justify-content: center;
   text-align: justify;
  }
}
              

          </style>
          <body>
          <div class='text-pop-up-top'><b style="color: #F77F00">SILO</b><b style="color: #FFF">TEC</b><b style="color: #009E60">- CI</b></div>
          </body>


          <!--fin--->
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
    <!-- End custom js for this page -->
  </body>
</html>
