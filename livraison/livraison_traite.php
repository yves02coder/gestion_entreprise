<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
  header('Location:../index.php');
}
require_once('../configuration/livraisonController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg = 5;
if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
}
$output = '<table id="example1" class="table table-sm table-bordered table-striped">
 <thead> 
<tr>
<th>Service</th>
 <th>Objet du besion</th>
 <th>N<sup>o</sup> commande</th>
  <th>Date Commande</th> 
  <th>Date livraison</th>
  <th>Pièce justificative</th>
  
</tr></thead> <tbody>';


$livraisons =livraison_traite();

foreach ($livraisons as $livraison) {
  $output .= '  <tr>
            <td>' . $livraison['nom_service'] . '</td>
            <td>' . $livraison['objet'] . '</td>
            <td>' . $livraison['annee'] . '/'.$livraison['id_bon_commande'].'/'. $livraison['nom_fournisseur'] .'</td>
            <td>' . date('d/m/Y', strtotime($livraison['date_commande'])) . '</td>
 
            <td>' . date('d/m/Y', strtotime($livraison['date_livraison'])) . '</td>
            <td><a href="../documents/livraison/' . $livraison['piece'] . '" target="_blank">' . $livraison['piece'] . '</a></td>
           </tr>
            ';
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
            <h1>Facture et paiement</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Budget</a></li>
              <li class="breadcrumb-item active">Facture et paiement</li>
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
                  <h3 class="card-title">Liste des livraisons traitées</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <?php echo $output; ?>
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
    $(function() {
      $("#example1").DataTable({

        "responsive": true,
        "lengthChange": false,
        "autoWidth": true,
        "buttons": ["excel", "pdf", "print"],

      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
    msg = <?php echo json_encode($msg); ?>;

    if (msg == 0) {
                $(function() {
                    toastr.error('Erreur sql.')
                });
            }
           

    if (msg == 1) {
      $(function() {
        toastr.success('Livraison enregistrée avec succès.')
      });
    }
    if (msg == 2) {
      $(function() {
        toastr.success('livraison mis à jour avec succès.')
      });
    }
    


    function confirmer(id) {
      var rep = confirm("Confirmer la signature");
      if (rep) {

        window.location = 'signature_livraison_commande.php?id=' + id;

      } else {
        document.reload();
      }
    }

    
  </script>
  <!-- End custom js for this page -->
</body>

</html>