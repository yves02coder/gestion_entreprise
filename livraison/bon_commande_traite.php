<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
  header('Location:../index.php');
}
require_once('../configuration/bon_commandeController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg = 5;
if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
}
$output = '<table id="example1" class="table table-sm table-bordered table-striped">
 <thead> 
<tr>
 
  <th>Date BC</th>
  <th>N<sup>o</sup>BE</th> 
  <th>Fournisseur</th>
  <th>Montant</th>
  <th>Bon d\'engagement</th>
  <th>Validation DAF</th>
  <th>Validation DG</th>
  <th>Transférer</th>
  <th>Actions</th> 
</tr></thead> <tbody>';


$bons = bon_commande_traite();

foreach ($bons as $bon) {
  $output .= '  <tr>
            
            <td>' . date('d/m/Y', strtotime($bon['date_commande'])) . '</td>
            <td>' . $bon['annee'] . '/' . $bon['id_engagement'] . '</td>
            <td>' . $bon['nom_fournisseur'] . '</td>
            <td>' . number_format($bon['montant_fp'], 0, '.', ' ') . '</td>
            <td><a href="../documents/bon_engagement/'. $bon['engagement'] . '" target="_blank">' . $bon['engagement'] . '</a></td>';
  if ($bon['signature_daf'] == 1) {
    $output .= ' <td>Signé</td>';
  } else {
    $output .= ' <td>Non signé</td>';
  }
  if ($bon['signature_dg'] == 1) {
    $output .= ' <td>Signé</td>';
  } else {
    $output .= ' <td>Non signé</td>';
  }
  if ($bon['date_transfert'] == NULL) {
    $output .= ' <td>Non transmis</td>';
  } else {
    $output .= ' <td>' . date('d-m-Y', strtotime($bon['date_transfert'])) . '</td>';
  }
  $output .= ' <td class="">
           <a href="commande.php?id=' . $bon['id_bon_commande'] . '"><button class="btn btn-primary  btn-sm")"><i class=" fa fa-eye "></i></button></a>
           <a href="maj_bon_commande.php?id=' . $bon['id_bon_commande'] . '"><button class="btn btn-success  btn-sm"><i class=" fa fa-edit "></i></button></a>
           </td></tr>  ';
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
              <h1>Bon de commamde</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Budget</a></li>
                <li class="breadcrumb-item active">Bon de commande</li>
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
                  <h3 class="card-title">Liste des bons de commande validés</h3>
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
        toastr.success('Bon de commande signé avec succès.')
      });
    }
    if (msg == 2) {
      $(function() {
        toastr.success('Bon de commande mis à jour avec succès.')
      });
    }
    if (msg == 3) {
      $(function() {
        toastr.success('Bon de commande transféré au fournisseur.')
      });
    }


    function confirmer(id) {
      var rep = confirm("Confirmer la signature");
      if (rep) {

        window.location = 'signature_bon_commande.php?id=' + id;

      } else {
        document.reload();
      }
    }

    function confirmer1(id) {
      var rep = confirm("Confirmer le transfert au fournisseur ");
      if (rep) {

        window.location = 'transfert.php?id=' + id;

      } else {
        document.reload();
      }
    }
  </script>
  <!-- End custom js for this page -->
</body>

</html>