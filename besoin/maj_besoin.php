<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require('../configuration/besoinController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg = 5;
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}
$besoins = getElementByID('besoins', 'id_besoin', $_GET['id']);
foreach ($besoins as $besoin) {
    $service_id = $besoin['service_id'];
    $emploi_id = $besoin['emploi_id'];
    $type = $besoin['type_procedure'];
    $objet = $besoin['objet'];
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
                            <h1>Besoin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Paramètre</a></li>
                                <li class="breadcrumb-item active">Besoin</li>
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
                                    <h3 class="card-title">Mise à jour Besoin</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="sevice" class="col-sm-4 col-form-label">Service*</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="service" id="service" onchange="afficherEmploi(this.id,'emploi')" required>

                                                    <?php
                                                    $services = getTable('services');
                                                    foreach ($services as $service) {
                                                        echo '<option value="' . $service['id_service'] . '"';
                                                        if ($service_id == $service['id_service']) {
                                                            echo 'selected';
                                                        }
                                                        echo '>' . $service['nom_service'] .  '</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">

                                            <label for="emploi" class="col-sm-4 col-form-label">Emploi*</label>
                                            <div class="col-sm-8">
                                                <select class="form-control " id="emploi" name="emploi" required>

                                                    <?php

                                                    $emplois = liste_emploi_service($service_id);
                                                    foreach ($emplois as $emploi) {
                                                        echo '<option value="' . $emploi['id_emploi'] . '"';
                                                        if ($emploi_id == $emploi['id_emploi']) {
                                                            echo 'selected';
                                                        }
                                                        echo '>' . $emploi['compte_emploi'] . ':' . $emploi['libelle_emploi'] . '</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="type" class="col-sm-4 col-form-label">Type de procédure*</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="type" id="type" required>
                                                <?php   
                                                echo'<option value="1"';
                                                     if ($type==1 ) {
                                                            echo 'selected';
                                                           } echo'>Normal</option>
                                                    <option value="2"';
                                                    if ($type==2 ) {echo 'selected';}echo'>Simplifié</option>';
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="objet" class="col-sm-4 col-form-label">Objet*</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="objet" name="objet" required value="<?= $objet ?>">
                                            </div>
                                        </div>

                                        <div class="text-center  py-2">
                                            <button type="submit" class="btn btn-success mr-2" name="maj_besoin" id="maj_besoin">Mise à jour</button>
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


            msg = <?php echo json_encode($msg); ?>;

            if (msg == 0) {
                $(function() {
                    toastr.error('Erreur sql.')
                });
            }
            if (msg == 1) {
                $(function() {
                    toastr.error('Ce code existe déjà.')
                });
            }


            function afficherEmploi(id, zone) {
                i = id;
                id_service = $('#' + i + ' option:selected').val();
                $.ajax({
                    type: 'POST',
                    url: "ajax.php",
                    data: {
                        id_service: id_service
                    },
                    success: function(resultat) {
                        $('#' + zone).html(resultat);

                    }
                });
            }

            function confirmer(id){
         var rep= confirm("Confirmer la validation");
         if(rep)
            {

             window.location='valide.php?id='+id;
           
             }
           else  {
              document.reload();
  }
}  
        </script>
    </div>
    <!-- End custom js for this page -->
</body>

</html>