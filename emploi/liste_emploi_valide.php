<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
  header('Location:../index.php');
}
require_once('../configuration/emploiController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');
$msg=5;
if (isset($_GET['msg'])){
  $msg=$_GET['msg'];
}
$output = '<table id="example1" class="table table-sm table-bordered table-striped">
 <thead> 
<tr>
 
  <th>Annee</th>
  <th>Service</th>
  <th>Nature</th>
  <th>Activité</th>
  <th>Compte</th>
  <th>Emploi</th>
  <th>Montant</th>
  <th>Ressource</th>
  <th>Actions</th>
</tr></thead> <tbody>';


$emplois = liste_emploi_valide();

foreach ($emplois as $emploi) {
  $output .= '  <tr>
            <td>' .$emploi['annee'].'</td>
            <td>' .$emploi['nom_service'].'</td>
            <td>' .$emploi['libelle_nature'].'</td>
            <td>' .$emploi['libelle_activite'].'</td>
            <td>' . $emploi['compte_emploi'] . '</td>
            <td>' . $emploi['libelle_emploi'] . '</td>
            <td>' . number_format($emploi['montant_le'],0,'.',' '). '</td>
            <td>' . $emploi['compte_sressource'] . ':'.$emploi['libelle_sressource'].'</td>    
            <td class="">';
            if($_SESSION['role']!='comptable'){
              $output .= ' <a href="maj_ligne_emploi.php?id=' . $emploi['id_ligne_emploi'] . '"><button class="btn btn-success  btn-sm"><i class=" fa fa-edit "></i></button></a> 
               <button class="btn btn-danger  btn-sm" onclick="confirmer(' . $emploi['id_ligne_emploi'] . ')"><i class="fa fa-trash"></i></button>';
            }
            $output .= '
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
                            <h1>Emploi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Paramètre</a></li>
                                <li class="breadcrumb-item active">Emploi</li>
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
                  <h3 class="card-title">Liste des emplois validés</h3>
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
      toastr.success('Emploi mis à jour avec succès.')
    });
     }
     if(msg==2){$(function() {
      toastr.error('ligne emploi supprimée.')
    });
     }

     function confirmer(id){
         var rep= confirm("Voulez-vous vraiment supprimer cette ligne de façon permamente ?");
         if(rep)
            {
             window.location='supprimer_valide.php?id='+id;        
             }
           else  {
              document.reload();
  }
}
   
    </script>
  <!-- End custom js for this page -->
</body>

</html>



