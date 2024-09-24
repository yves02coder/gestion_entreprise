<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
  header('Location:../index.php');
}
require_once('../configuration/factureController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg = 5;
if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
}
$output = '<table id="example1" class="table table-sm table-bordered table-striped">
 <thead> 
<tr>
 <th>Réf facture</th> 
 <th>Client</th> 
 <th>Date règlement</th>
 <th>Mode de paiement</th>
 <th>Montant</th>
 
  <th>Actions</th> 
</tr></thead> <tbody>';


$encaissements =liste_encaissement();

foreach ($encaissements as $encaissement) {
  
  $output .= ' 
          <tr><td>FA/ARSN/'.$encaissement['id_encaissement'].'</td> 
          <td>' . $encaissement['nom_client'] . '</td>
            <td>' . date('d/m/Y', strtotime($encaissement['date_encaissement'])) . '</td> 
            <td>' . $encaissement['mode_paiement'] . '</td>
            <td>' . number_format($encaissement['montant_en'],0,'.',' ') . '</td> ';
            if ($_SESSION['role'] != 'commercial')  {
      $output .= ' <td>  <a href="maj_encaissement.php?id=' . $encaissement['id_encaissement'] . '"><button class="btn btn-success  btn-sm"><i class=" fa fa-edit "></i></button></a> ';
            } 
            
         
  }

        $output .='</td> </tr> </tbody>
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
                            <h1>Règlement</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Vente</a></li>
                                <li class="breadcrumb-item active">Règlement</li>
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
                  <h3 class="card-title">Liste des règlements de factures</h3>
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
        toastr.success('Réglement mis à jour avec succès.')
      });
    }


    if (msg == 2) {
      $(function() {
        toastr.success('Chèque supprimé.')
      });
    }
    
  

    function confirmer2(id,id1) {
      var rep = confirm("Voulez-vous vraiment supprimer cette ligne de façon permamente ?");
      if (rep) {
        window.location = 'supprimer_valide.php?id=' + id+'&id1='+id1;

      } else {
        document.reload();
      }
    }

    
  </script>
  <!-- End custom js for this page -->
</body>

</html>