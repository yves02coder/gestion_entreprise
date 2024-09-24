<?php 
session_start();
if((!isset($_SESSION['connexion'])) || ($_SESSION['connexion']!='ok')){
    header('Location:../index.php');
}
   require_once('../configuration/budgetController.php');
   include_once('../partials/header.php'); 
   include_once('../partials/footer.php');


    $output='<table class="table table-sm table-striped " id="tab" >';
    $output.=' <thead> 
    <tr>
      <th scope="col">#</th>
      <th scope="col">N<sup>o</sup>Compte </th>
      <th scope="col">Code sous rubrique </th>
      <th scope="col">Libellé </th>
      <th scope="col">Rubrique </th>
      <th>Actions</th>
 
    </tr></thead> <tbody>' ;
    $i=1;
   
    $rubriques= list_sous_rubrique();
    
    foreach($rubriques as $rubrique) 
    { 
   $output.='  <tr>
                <td >'.$i.'</td>
                <td class="py-1">'.$rubrique['scompte'].'</td>
                <td class="py-1">'.$rubrique['code_sous_rubrique'].'</td>
                <td class="py-1">'.$rubrique['libelle_sous'].'</td>
                <td class="py-1">'.$rubrique['libelle_rubrique'].'</td>
                <td class="py-1"> <a href="update.php?id='.$rubrique['id_sous_rubrique'].'"><button class="btn btn-success btn-sm "><i class=" fa fa-edit "></i></button></a>
                <button class="btn btn-danger  btn-sm" onclick="confirmer('.$rubrique['id_sous_rubrique'].')"><i class="fa fa-trash"></i></button>
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
                Sous rubrique enregistrée avec succès
                
                </div>';
              }
              elseif (isset($_GET['msg'])&& $_GET['msg']==2){
                echo'<div class="alert alert-success  fade show" role="alert">
                La mise à jour  de la rubrique s\'est effectuée avec succès
              
                </div>';
              }
              elseif (isset($_GET['msg'])&& $_GET['msg']==3){
                echo'<div class="alert alert-success  fade show" role="alert">
                La suppression du produit s\'est effectuée avec succès
                
                </div>';
              }

              ?>
          <div>
          <h4 class="mb-4"> Sous Rubrique</h4>
          </div>
        <!-- partial -->
       
                      <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Liste des sous rubriques</h6>
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