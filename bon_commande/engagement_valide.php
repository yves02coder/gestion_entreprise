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
  <th>Date BE</th>
  <th>Service</th>
  <th>Besoin</th>
  <th>Date besoin</th>
  <th>Fournisseur</th>
  <th>Montant</th>
  <th>Document</th>
  <th>Actions</th>
</tr></thead> <tbody>';


$engagements = engagement_valide();

foreach ($engagements as $engagement) {
  $output .= '  <tr>
            <td>' .$engagement['annee'].'/'.$engagement['id_engagement'].'</td>
            <td>' .date('d-m-Y',strtotime($engagement['date_engagement'])).'</td>
            <td>' .$engagement['nom_service'].'</td>
            <td>' .$engagement['objet'].'</td>
            <td>' .date('d-m-Y',strtotime($engagement['date_saisie_b'])).'</td>
            <td>' .$engagement['nom_fournisseur'].'</td>
            <td>' . number_format($engagement['montant_fp'],0,'.',' '). '</td>';
             if($engagement['signature_ben']==0){
             $output .= '   <td><a href="../documents/fproforma/'.$engagement['proforma'].'" target="_blank">'.$engagement['proforma'].'</a></td> 
              
            <td class="">
            <a href="engagement.php?id='. $engagement['id_engagement'] .'"><button class="btn btn-primary  btn-sm"><i class=" fa fa-eye "></i></button></a>
             <a href="maj_engagement.php?id='. $engagement['id_engagement'] .'"><button class="btn btn-success  btn-sm"><i class=" fa fa-edit "></i></button></a> 
             <a href="bon_engagement.php?id='. $engagement['id_engagement'] .'" target="_blank"><button class="btn btn-warning  btn-sm"><i class=" fa fa-print "></i></button></a> ';
             
             if($_SESSION['role']=='admin'||$_SESSION['role']=='daf'){
                $output .= '<button class="btn btn-primary  btn-sm" id="'.$engagement['id_engagement'].'" name="'.$engagement['id_engagement'].'" onclick="confirmer(' . $engagement['id_engagement'] . ')"><i class="fa fa-check"></i></button> ';
               }
            if($_SESSION['role']!='comptable'){
               $output .= '<button class="btn btn-danger  btn-sm" onclick="confirmer2(' . $engagement['id_engagement'] . ','.$engagement['id_besoin'].')"><i class="fa fa-trash"></i></button>';
           
              }   
              $output .= '  </td>
           </tr>  ';
          }
           else{
            $output .= '   <td><a href="../documents/bon_engagement/'.$engagement['engagement'].'" target="_blank">'.$engagement['engagement'].'</a></td> 
              
            <td class="">
            <a href="creer_bon_commande.php?id='. $engagement['id_engagement'] .'"><button class="btn btn-primary  btn-sm">BC</button></a> 
            
            <a href="engagement.php?id='. $engagement['id_engagement'] .'"><button class="btn btn-primary  btn-sm"><i class=" fa fa-eye "></i></button></a> 
            <a href="bon_engagement.php?id='. $engagement['id_engagement'] .'" target="_blank"><button class="btn btn-warning  btn-sm"><i class=" fa fa-print "></i></button></a> 
             
            <a href="update_engagement.php?id='. $engagement['id_engagement'] .'"><button class="btn btn-success  btn-sm"><i class=" fa fa-edit "></i></button></a>'; 
            if($_SESSION['role']=='admin'){
              $output .= '<button class="btn btn-danger  btn-sm" onclick="confirmer2(' . $engagement['id_engagement'] . ','.$engagement['id_besoin'].')"><i class="fa fa-trash"></i></button>';
          
             } 
           
             $output .= '  </tr>  ';
           }
 
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
                            <h1>Bon d'engagement</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Budget</a></li>
                                <li class="breadcrumb-item active">Bon d'engagement</li>
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
                  <h3 class="card-title">Liste des bons d'engagement validés</h3>
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
      toastr.success('Bon d\'engagement signé.')
    });
     }
     if(msg==2){$(function() {
      toastr.success('Bon d\'engagement inseré avec succès.')
    });
     }
     if(msg==3){$(function() {
      toastr.success('Bon d\'engagement supprimé.')
    });
     }
   
     function confirmer(id){
         var rep= confirm("confirmer la signature ?");
         if(rep)
            {
             window.location='signature_engagement.php?id='+id;        
             }
           else  {
              document.reload();
  }
}
function confirmer2(id,id2){
         var rep= confirm("Voulez-vous vraiment supprimer cette ligne de façon permamente ?");
         if(rep)
            {
             window.location='supprimer_valide_engagement.php?id='+id+'&id2='+id2;        
             }
           else  {
              document.reload();
  }
} 
   
    </script>
  <!-- End custom js for this page -->
</body>

</html>



