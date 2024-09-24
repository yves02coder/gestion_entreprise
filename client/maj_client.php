<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/clientController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg = 5;
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}
$clients=getElementByID('clients','id_client',$_GET['id']);
foreach($clients as $client){
    
    $nom_client=$client['nom_client'];
    $adresse_client=$client['adresse'];
    $contact_client=$client['contact'];
    $email=$client['email'];
    $interlocuteur=$client['interlocuteur'];
    $domaine=$client['domaine'];
       
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
                            <h1>Client</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Vente</a></li>
                                <li class="breadcrumb-item active">Client</li>
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
                                    <h3 class="card-title">mise à jour client</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">

                                    <div class="row mb-3">
                                    <label for="nom" class="col-sm-4 col-form-label">Nom*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nom" name="nom" required value="<?=$nom_client?>">
                                    </div>
                            </div>

                            <div class="row mb-3">
                                    <label for="contact" class="col-sm-4 col-form-label">Contact*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="contact" name="contact" required value="<?=$contact_client?>">
                                    </div>
                            </div>
                            <div class="row mb-3">
                                    <label for="adresse" class="col-sm-4 col-form-label">Adresse*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="adresse" name="adresse" required value="<?=$adresse_client?>">
                                    </div>
                            </div>
                            <div class="row mb-3">
                                    <label for="email" class="col-sm-4 col-form-label">Email*</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="email" name="email" required value="<?=$email?>">
                                    </div>
                            </div>
                            <div class="row mb-3">
                                    <label for="interlocuteur" class="col-sm-4 col-form-label">Interlocuteur*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="interlocuteur" name="interlocuteur" required value="<?=$interlocuteur?>">
                                    </div>
                            </div>

                            <div class="row mb-3">
                                    <label for="domaine" class="col-sm-4 col-form-label">Domaine d'activité*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="domaine" name="domaine" required value="<?=$domaine?>">
                                    </div>
                            </div>


                                        <div class="text-center  py-2">
                                        <button type="submit" class="btn btn-success mr-2" name="maj_client" id="maj_client">Mise à jour</button>
                                          
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
        msg = <?php echo json_encode($msg); ?>;

        if (msg == 0) {
            $(function() {
                toastr.error('Erreur sql.')
            });
        }
       
    </script>
    <!-- End custom js for this page -->
</body>

</html>