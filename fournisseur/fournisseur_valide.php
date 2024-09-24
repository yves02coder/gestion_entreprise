<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
  header('Location:../index.php');
}
require_once('../configuration/fournisseurController.php');
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
  <th>N<sup>o</sup>CC</th>
  <th>Nom</th>
  <th>Contact</th>
  <th>Adresse</th>
  <th>Banque</th>
  <th>N<sup>o</sup>Ccompte</th>
  <th>Actions</th>
</tr></thead> <tbody>';
$i = 1;

$fournisseurs = fournisseur_valide();

foreach ($fournisseurs as $fournisseur) {
  $output .= '  <tr>
            <td >' . $i . '</td>
            <td>' .$fournisseur['code_cc']. '</td>
            <td>' .$fournisseur['nom_fournisseur']. '</td>
            <td>' .$fournisseur['adresse_fournisseur']. '</td>
            <td>' .$fournisseur['contact_fournisseur']. '</td>
            <td>' .$fournisseur['banque']. '</td>
            <td>' .$fournisseur['num_compte']. '</td> ';
            if($_SESSION['role']!='comptable'){        
          $output.='  <td class=""> <a href="maj_fournisseur.php?id=' . $fournisseur['id_fournisseur'] . '"><button class="btn btn-success  btn-sm"><i class=" fa fa-edit "></i></button></a> 
                <button class="btn btn-danger  btn-sm" onclick="confirmer(' . $fournisseur['id_fournisseur'] . ')"><i class="fa fa-trash"></i></button>';
            }
            $output.='</td>
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
                            <h1>Fournisseur</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Budget</a></li> 
                                <li class="breadcrumb-item active">Fournisseur</li>
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
                  <h3 class="card-title">Liste des fournisseurs validés</h3>
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
      toastr.success('Fournisseur mis à jour avec succès.')
    });
     }
     if(msg==2){$(function() {
      toastr.success('Fournisseur supprimé avec succès.')
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



