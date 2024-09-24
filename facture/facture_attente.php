<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
  header('Location:../index.php');
}
require_once('../configuration/factureController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg=5;
if (isset($_GET['msg'])){
  $msg=$_GET['msg'];
}
$output = '<table id="example1" class="table table-sm table-bordered table-striped">
 <thead> 
<tr>
<th>Date</th>
<th>N<sup>o</sup> facture</th>
<th>Client</th>
<th>Montant</th>
<th>Remise</th>
<th> Montant avec Remise </th>
  <th>Actions</th>
</tr></thead> <tbody>';
$i = 1;

$factures = facture_attente();

foreach ($factures as $facture) {
  $output .= '  <tr>
            <td>' . date('d/m/Y',strtotime($facture['date_facture'])) . '</td> 
            <td> FA/ARSN/'. $facture['id_facture'] .'</td>       
            <td>' . $facture['nom_client'] . '</td>';
          $montant=montant_facture($facture['id_facture']);
          $output .= ' <td>' .number_format($montant,0,'.',' '). '</td>  
            <td>' . number_format($facture['remise_facture'],0,'.',' ') . '</td>
            <td>' . number_format(intval($montant-$facture['remise_facture']),0,'.',' ') . '</td>
            <td class=""> 
            <a href="voir_facture.php?id=' . $facture['id_facture'] . '"><button class="btn btn-primary btn-sm"><i class=" fa fa-eye "></i></button></a> 
          
            <a href="#?id=' . $facture['id_facture'] . '"><button class="btn btn-success btn-sm"><i class=" fa fa-edit "></i></button></a> ';
            if($_SESSION['role']!="commercial"){
              $output .= '  <button class="btn btn-primary  btn-sm"  onclick="confirmer(' . $facture['id_facture']  . ')"><i class="fa fa-check"></i></button> ';  
                       }
              $output .= '<button class="btn btn-danger  btn-sm" onclick="confirmer2(' . $facture['id_facture'] . ','.$facture['commande_id'].')"><i class="fa fa-trash"></i></button>
            </td>
           </tr>  ';
  $i++;
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
                            <h1>Facture</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Vente</a></li>
                                <li class="breadcrumb-item active">Facture</li>
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
                  <h3 class="card-title">Liste des factures en attente</h3>
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
     $(function () {
    $("#example1").DataTable({
      
      "responsive": true, 
      "lengthChange": false,
       "autoWidth": true,
      "buttons": ["excel", "pdf", "print"],
     
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
     
      });
      msg= <?php echo json_encode($msg); ?>;

      if(msg==0){$(function() {
      toastr.error('Erreur sql.')
    });
     }
     if(msg==1){$(function() {
      toastr.success('Facture enregistrée avec succès.')
    });
     }
     if(msg==2){$(function() {
      toastr.success('Facture mise à jour avec succès.')
    });
     }
     if(msg==3){$(function() {
      toastr.success('Facture validée .')
    });
     }
     if(msg==4){$(function() {
      toastr.error('Facture supprimée .')
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

function confirmer2(id,id1){
         var rep= confirm("Voulez-vous vraiment supprimer cette ligne de façon permamente ?");
         if(rep)
            {
             window.location='supprimer_attente.php?id='+id+'&id1='+id1;       
             }
           else  {
              document.reload();
  }
}
    </script>
  <!-- End custom js for this page -->
</body>

</html>



