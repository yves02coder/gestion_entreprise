<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
  header('Location:../index.php');
}
require_once('../configuration/fproformaController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg=5;
if (isset($_GET['msg'])){
  $msg=$_GET['msg'];
}
$output = '<table id="example1" class="table table-sm table-bordered table-striped">
 <thead> 
<tr>
  <th>Service</th>
  <th>Besoin</th>
  <th>Fournisseur</th>
  <th>Date</th>
  <th>Référence</th>
  <th>Montant</th>
  <th>Proforma</th>
  <th>Actions</th>
</tr></thead> <tbody>';


$fproformas = fproforma_attente();

foreach ($fproformas as $fproforma) {
  $output .= '  <tr>
            <td>' .$fproforma['nom_service'].'</td>
            <td>' .$fproforma['objet'].'</td>
            <td>' .$fproforma['nom_fournisseur'].'</td>
            <td>' .date('d-m-Y',strtotime($fproforma['date_fproforma'])).'</td>
            <td>' . $fproforma['reference'] . '</td>
            <td>' . number_format($fproforma['montant_fp'],0,'.',' '). '</td>
            <td><a href="../documents/fproforma/'.$fproforma['proforma'].'" target="_blank">'.$fproforma['proforma'].'</a> </td>  
            <td class=""> <a href="maj_fproforma.php?id='. $fproforma['id_fproforma'] .'"><button class="btn btn-success  btn-sm")"><i class=" fa fa-edit "></i></button></a> ';
           
            if ($_SESSION['role'] !='comptable') {
              $output .= '  <button class="btn btn-primary  btn-sm" id="'.$fproforma['id_fproforma'].'" name="'.$fproforma['id_fproforma'].'" onclick="confirmer(' . $fproforma['id_fproforma'] . ')"><i class="fa fa-check"></i></button> ';
            }
            $output .= '<button class="btn btn-danger  btn-sm" onclick="confirmer2(' . $fproforma['id_fproforma'] . ')"><i class="fa fa-trash"></i></button>
            </td>
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
                            <h1>Proforma/Fournisseur</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Paramètre</a></li>
                                <li class="breadcrumb-item active">Proforma/Fournisseur</li>
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
                  <h3 class="card-title">Liste des Proforma/Fournisseur en attente</h3>
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
      toastr.success('Proforma enregistrée avec succès.')
    });
     }
     if(msg==2){$(function() {
      toastr.success('Proforma mis à jour avec succès.')
    });
     }
     if(msg==3){$(function() {
      toastr.success('Proforma validée.')
    });
     }

     if(msg==4){$(function() {
      toastr.success('Proforma supprimée.')
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
function confirmer2(id){
         var rep= confirm("Voulez-vous vraiment supprimer cette ligne de façon permamente ?");
         if(rep)
            {

             window.location='supprimer_attente.php?id='+id;
           
             }
           else  {
              document.reload();
  }
}   
      
   
    </script>
  <!-- End custom js for this page -->
</body>

</html>



