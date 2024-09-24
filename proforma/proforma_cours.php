<?php 
session_start();
if((!isset($_SESSION['connexion'])) || ($_SESSION['connexion']!='ok')){
    header('Location:../index.php');
}
   require_once('../configuration/proformaController.php');
   include_once('../partials/header.php'); 
   include_once('../partials/footer.php');


    $output='<table class="table table-sm table-striped " id="tab" >';
    $output.=' <thead> 
    <tr>
      <th scope="col">N<sup>o</sup> proforma</th>
      <th scope="col">Date </th>
      <th scope="col">Client </th>
      <th scope="col">Initiateur </th>

      <th>Actions</th>
 
    </tr></thead> <tbody>' ;
    $i=1;
   
    $proformas=liste_proforma_encours();
    
    foreach($proformas as $proforma) 
    { 
   $output.='  <tr>
                
                <td class="py-1">'.$proforma['num_proforma'].'</td>
                <td class="py-1">'.date('d/m/Y',strtotime($proforma['date_facture'])).'</td>
                <td class="py-1">'.$proforma['nom_client'].'</td>
                <td class="py-1">'.$proforma['nom'].'</td>
                <td class="py-1">  
                <a href="show.php?id='.$proforma['num_proforma'].'"><button class="btn btn-info btn-sm "><i class=" fa fa-eye "></i></button></a>
                <a href="#?id='.$proforma['num_proforma'].'"><button class="btn btn-success btn-sm "><i class=" fa fa-edit "></i></button></a>';
                if (($_SESSION['role'] != 'commercial') && ($_SESSION['role'] != 'comptable')) {
                  $output.=' <a href="valide.php?id='.$proforma['num_proforma'].'"><button class="btn btn-success btn-sm "><i class=" fa fa-check "></i> Valider</button></a>';
                }
                $output.=' <button class="btn btn-danger  btn-sm" onclick="confirmer('.$proforma['num_proforma'].')"><i class="fa fa-trash"></i></button>
                </td>
               </tr>  ';
               $i++;       
                       }
    $output.='</tbody>
    <tfoot> <tr>
    </tr></tfoot> </table>';

       
?>
  <body>
  <div class="container-fluid position-relative d-flex p-0">
      <!-- partial:partials/_sidebar.html -->
          <?php include_once('../partials/menu.php'); ?> 
      <!-- partial -->
       <!-- Content Start -->
      <div class="content">
        <!-- partial:partials/_navbar.html -->
          <?php  include_once('../partials/body_header.php'); ?>

          <div class="container-fluid pt-4 px-4">
            <?php    if(isset($_GET['msg'])&& $_GET['msg']==0){
                echo'<div class="alert alert-danger  fade show" role="alert">
              Erreur SQL !!!

              </div>';}
              elseif (isset($_GET['msg'])&& $_GET['msg']==1){
                echo'<div class="alert alert-success  fade show" role="alert">
                Proforma a été enregistrée avec succès
                
                </div>';
              }
              elseif (isset($_GET['msg'])&& $_GET['msg']==2){
                echo'<div class="alert alert-success  fade show" role="alert">
                La mise à jour  du produit s\'est effectuée avec succès
              
                </div>';
              }
              elseif (isset($_GET['msg'])&& $_GET['msg']==3){
                echo'<div class="alert alert-success  fade show" role="alert">
                La suppression du produit s\'est effectuée avec succès
                
                </div>';
              }

              ?>
          <div>
          <h4 class="mb-4">Proforma</h4>
          </div>
        <!-- partial -->
       
                      <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Liste des proformas en attente</h6>
                            <div class="table-responsive">
                  
                              <?php  echo $output; ?> 
                    
                            </div>
                        </div>
                      </div>
                      </div>
          <!-- partial:partials/_footer.html -->
          <?php include_once('../partials/body_footer.php');?>
          <!-- partial -->
      </div>
        
  </div>
     
   
    <!-- End custom js for this page -->
  </body>
</html>