<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
  header('Location:../index.php');
}
require_once('../configuration/clientController.php');
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
  <th>Nom</th>
  <th>Contact</th>
  <th>Adresse</th>
  <th>Email</th>
  <th>Interlocuteur</th>
  <th>Domaine d\'activité</th>
  <th>Actions</th>
</tr></thead> <tbody>';
$i = 1;

$clients =fournisseur_attente();

foreach ($clients as $client) {
  $output .= '  <tr>
            <td >' . $i . '</td>
            <td>' .$client['non_client']. '</td>
            <td>' .$client['contact']. '</td>
            <td>' .$client['adresse']. '</td>
            <td>' .$client['email']. '</td>
            <td>' .$client['interlocuteur']. '</td>
            <td>' .$client['domaine']. '</td>
                
            <td class=""> <a href="maj_client.php?id=' . $client['id_client'] . '"><button class="btn btn-success  btn-sm"><i class=" fa fa-edit "></i></button></a>
            <button class="btn btn-primary  btn-sm" id="'.$client['id_client'].'" name="'.$client['id_client'].'" onclick="confirmer(' . $client['id_client'] . ')"><i class="fa fa-check"></i></button>           
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
                            <h1>Client</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Budget</a></li>
                                <li class="breadcrumb-item active">Client</li>
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
                  <h3 class="card-title">Liste des clients en attente</h3>
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
      toastr.success('client enregistré avec succès.')
    });
     }
     if(msg==2){$(function() {
      toastr.success('client mis à jour avec succès.')
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
   
    </script>
  <!-- End custom js for this page -->
</body>

</html>



