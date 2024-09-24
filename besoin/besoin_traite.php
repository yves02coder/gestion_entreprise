<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
  header('Location:../index.php');
}
require_once('../configuration/besoinController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');

$output = '<table id="example1" class="table table-sm table-bordered table-striped">
 <thead> 
<tr>
 
  <th>Annee</th>
  <th>Service</th>
  <th>Compte</th>
  <th>Emploi</th>
  <th>Type P</th>
  <th>Objet</th>
 

</tr></thead> <tbody>';


$besoins = liste_besoin_valide();

foreach ($besoins as $besoin) {
  if($besoin['type_procedure']==1){
      $type='Normal';
  }
  else{
      $type='Simplifié';
  }
$output .= '  <tr>
          <td>' .date('d-m-Y', strtotime($besoin['date_saisie_b'])).'</td>
          <td>' .$besoin['nom_service'].'</td>
          <td>' . $besoin['compte_emploi'] . '</td>
          <td>' .$besoin['libelle_emploi'].'</td>
          <td>' .$type.'</td>  
          <td>' . $besoin['objet'] . '</td>
          
           </tr>  ';
 
}
$output .= '</tbody>
 </table>';
// <button class="btn btn-danger  btn-sm" onclick="confirmer(' . $ressource['id_ressource'] . ')"><i class="fa fa-trash"></i></button>
           
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
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Liste des besoins traités</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <div class="table-responsive">
                  <?php echo $output; ?>
                  </div>
                </div>
                <!-- /.card-body -->
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
     $(function () {
    $("#example1").DataTable({
      
      "responsive": true, 
      "lengthChange": false,
       "autoWidth": true,
      "buttons": ["excel", "pdf", "print"],
     
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
     
      });
     
   
    </script>
  <!-- End custom js for this page -->
</body>

</html>



