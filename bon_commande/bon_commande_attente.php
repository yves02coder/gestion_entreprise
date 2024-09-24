<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
  header('Location:../index.php');
}
require_once('../configuration/bon_commandeController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg=5;
if (isset($_GET['msg'])){
  $msg=$_GET['msg'];
}
$output = '<table id="example1" class="table table-sm table-bordered table-striped">
 <thead> 
<tr>
  <th>#</th>
  <th>Date BC</th>
  <th>Engagement</th> 
  <th>Fournisseur</th>
  <th>Montant</th>
  <th>Proforma</th>
  <th>Bon d\'engagement</th>
  <th>Actions</th>
</tr></thead> <tbody>';


$bons = bon_commande_attente();

foreach ($bons as $bon) {
  $output .= '  <tr>
            <td>' .$bon['annee'].'/'.$bon['id_bon_commande'].'</td>
            <td>' .date('d-m-Y',strtotime($bon['date_commande'])).'</td>
            <td>' .$bon['annee'].'/'.$bon['id_engagement'].'</td>
            <td>' .$bon['nom_fournisseur'].'</td>
            <td>' . number_format($bon['montant_fp'],0,'.',' '). '</td>
            <td><a href="../documents/fproforma/'.$bon['proforma'].'" target="_blank">'.$bon['proforma'].'</a></td>
            <td><a href="../documents/engagement/'.$bon['engagement'].'" target="_blank">'.$bon['engagement'].'</a></td>
          
            <td class="">
            <a href="commande.php?id='. $bon['id_bon_commande'] .'"><button class="btn btn-primary  btn-sm"><i class=" fa fa-eye "></i></button></a> ';
           
            if ($_SESSION['role']!='comptable') {
              $output .= '  <button class="btn btn-primary  btn-sm" id="'.$bon['id_bon_commande'].'" name="'.$bon['id_bon_commande'].'" onclick="confirmer(' . $bon['id_bon_commande'] . ')"><i class="fa fa-check"></i></button>';
            }
           
            $output .= ' <button class="btn btn-danger  btn-sm" onclick="confirmer2(' . $bon['id_bon'] .','.$bon['id_engagement'].')"><i class="fa fa-trash"></i></button>
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
                            <h1>Bon de commande</h1>
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
                  <h3 class="card-title">Liste des bons de commande en attente</h3>
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
      msg= <?php echo json_encode($msg); ?>;

      if(msg==0){$(function() {
      toastr.error('Erreur sql.')
    });
     }
     if(msg==1){$(function() {
      toastr.success('Bon de commande enregistré avec succès.')
    });
     }
     if(msg==2){$(function() {
      toastr.success('Bon de commande mis à jour avec succès.')
    });
     }
     if(msg==3){$(function() {
      toastr.success('Bon de commande validé.')
    });
     }
     if(msg==4){$(function() {
      toastr.success('Bon de commande supprimé.')
    });
     }
    

     function confirmer(id){
         var rep= confirm("Confirmer la validation");
         if(rep)
            {
             window.location='valide_bon_commande.php?id='+id;  
             }
           else  {
              document.reload();
  }
} 

function confirmer2(id,id2){
         var rep= confirm("Voulez-vous vraiment supprimer cette ligne de façon permamente ?");
         if(rep)
            {
             window.location='supprimer_attente_commande.php?id='+id+'&id2='+id2;  
             }
           else  {
              document.reload();
  }
}
      
   
    </script>
  <!-- End custom js for this page -->
</body>

</html>



