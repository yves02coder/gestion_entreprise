<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
  header('Location:../index.php');
}
require_once('../configuration/ressourceController.php');
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
  <th>Compte s/ressource</th>
  <th>Libellé s/ressource</th>
  <th>Code ressource</th>
  <th>Actions</th>
</tr></thead> <tbody>';
$i = 1;

$sressources = liste_sressource();

foreach ($sressources as $sressource) {
  $output .= '  <tr>
            <td >' . $i . '</td>
            <td>' . $sressource['compte_sressource'] . '</td>
            <td>' . $sressource['libelle_sressource'] . '</td>
            <td>' . $sressource['code_ressource'] . '</td>   
            <td class=""> <a href="maj_sous_ressource.php?id=' . $sressource['id_sous_ressource'] . '"><button class="btn btn-success  btn-sm"><i class=" fa fa-edit "></i></button></a> ';
            if($_SESSION['role']=="admin"){
              $output .= ' <button class="btn btn-danger  btn-sm" id="'.$sressource['id_sous_ressource'].'" name="'.$sressource['id_sous_ressource'].'" onclick="confirmer(' . $sressource['id_sous_ressource'] . ')"><i class="fa fa-trash"></i></button> ';
            }
            $output .= ' </td>
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
                            <h1>S/Ressource</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Paramètre</a></li>
                                <li class="breadcrumb-item active">S/Ressource</li>
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
                  <h3 class="card-title">Liste des S/Ressources</h3>
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
      toastr.success('Sous Ressource enregistré avec succès.')
    });
     }
     if(msg==2){$(function() {
      toastr.success('Sous Ressource mis à jour avec succès.')
    });
     }

     if(msg==3){$(function() {
      toastr.error('Sous Ressource supprimé')
    });
     }
      
     function confirmer(id){
         var rep= confirm("Voulez-vous vraiment supprimer cette ligne de façon permamente ?");
         if(rep)
            {
             window.location='supprimer_sressource.php?id='+id;        
             }
           else  {
              document.reload();
  }
}
    </script>
  <!-- End custom js for this page -->
</body>

</html>



