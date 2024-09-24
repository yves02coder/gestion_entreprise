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
  <th>#</th>
  <th>Code Nature</th>
  <th>Libellé</th>
  
  <th>Actions</th>
</tr></thead> <tbody>';
$i = 1;

$natures = Alltable('natures', 'id_nature');

foreach ($natures as $nature) {
  $output .= '  <tr>
            <td >' . $i . '</td>
            <td>' . $nature['code_nature'] . '</td>
            <td>' . $nature['libelle_nature'] . '</td>
                
            <td class=""> <a href="maj_nature.php?id=' . $nature['id_nature'] . '"><button class="btn btn-success  btn-sm")"><i class=" fa fa-edit "></i></button></a> ';
            if($_SESSION['role']=="admin"){
              $output .= ' <button class="btn btn-danger  btn-sm" id="'.$nature['id_nature'].'" name="'.$nature['id_nature'].'" onclick="confirmer(' . $nature['id_nature'] . ')"><i class="fa fa-trash"></i></button> ';
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
                  <h3 class="card-title">Liste des natures économiques</h3>
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
      toastr.success('Nature enregistré avec succès.')
    });
     }
     if(msg==2){$(function() {
      toastr.success('Nature mis à jour avec succès.')
    });
     }
     if(msg==3){$(function() {
      toastr.error('Nature supprimée.')
    });
     }

     function confirmer(id){
         var rep= confirm("Voulez-vous vraiment supprimer cette ligne de façon permamente ?");
         if(rep)
            {
             window.location='supprimer_nature.php?id='+id;        
             }
           else  {
              document.reload();
  }
}
      
   
    </script>
  <!-- End custom js for this page -->
</body>

</html>



