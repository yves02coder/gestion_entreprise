<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
  header('Location:../index.php');
}
require_once('../configuration/opController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg = 5;
if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
}
$output = '<table id="example1" class="table table-sm table-bordered table-striped">
 <thead> 
<tr>
 <th>Date facture</th> 
 <th>Référence facture</th>
 <th>Facture</th>
 <th>Montant</th>
 <th>Bailleur</th>
 <th>Retenue</th>
 <th>Montant ARSN</th>
  <th>Actions</th> 
</tr></thead> <tbody>';


$factures =op_attente();

foreach ($factures as $facture) {
  
  $output .= '
           </tr>  
            <td>' . date('d/m/Y', strtotime($facture['date_facture'])) . '</td> 
            <td>' . $facture['reference_facture'] . '</td>
            <td><a href="../documents/bon_facture/' . $facture['facture'] . '" target="_blank">' . $facture['facture'] . '</a></td>
            <td>' . number_format($facture['montant_facture'],0,'.',' ') . '</td>  
            <td>' . number_format($facture['bailleur'],0,'.',' ') . '</td> 
            <td>' . number_format($facture['retenue'],0,'.',' ') . '</td> 
            <td>' . number_format(($facture['montant_facture']-($facture['retenue']+$facture['bailleur'])),0,'.',' ') . '</td>      
            <td> <a href="voir_op.php?id=' . $facture['id_ordre_paiement'] . '"><button class="btn btn-warning  btn-sm"><i class=" fa fa-eye "></i></button></a> 
            <a href="maj_op.php?id=' . $facture['id_ordre_paiement'] . '"><button class="btn btn-success  btn-sm"><i class=" fa fa-edit "></i></button></a> ';
            if($_SESSION['role']!='comptable'){
              $output .= '<button class="btn btn-primary  btn-sm" id="'.$facture['id_ordre_paiement'].'" name="'.$facture['id_ordre_paiement'].'" onclick="confirmer(' . $facture['id_ordre_paiement'] . ')"><i class="fa fa-check"></i></button> ';
                  }   
           $output .= '<button class="btn btn-danger  btn-sm" id="'.$facture['id_ordre_paiement'].'" name="'.$facture['id_ordre_paiement'].'" onclick="confirmer2(' . $facture['id_ordre_paiement'] . ','. $facture['id_facture_id'] .')"><i class="fa fa-trash"></i></button>
           </td></tr>';
             
            
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
                  <h3 class="card-title">Liste des ordres de paiement en attente</h3>
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
        toastr.success('ordre de paiement enregistré avec succès.')
      });
    }
    if (msg == 2) {
      $(function() {
        toastr.success('ordre de paiement mis à jour avec succès.')
      });
    }

    if (msg == 3) {
      $(function() {
        toastr.success('ordre de paiement validé.')
      });
    }

    if (msg == 4) {
      $(function() {
        toastr.success('ordre de paiement supprimée.')
      });
    }
    
    function confirmer(id) {
      var rep = confirm("Confirmer la validation");
      if (rep) {
        window.location = 'valide_op.php?id=' + id;

      } else {
        document.reload();
      }
    }
    function confirmer2(id,id2){
         var rep= confirm("Voulez-vous vraiment supprimer cette ligne de façon permamente ?");
         if(rep)
            {
             window.location='supprimer_attente.php?id='+id+'&id2='+id2;        
             }
           else  {
              document.reload();
  }
}

    
  </script>
  <!-- End custom js for this page -->
</body>

</html>