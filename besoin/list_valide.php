<?php 
session_start();
if((!isset($_SESSION['connexion'])) || ($_SESSION['connexion']!='ok')){
    header('Location:../index.php');
}
   require_once('../configuration/besoinController.php');
   include_once('../partials/header.php'); 
   include_once('../partials/footer.php');


    $output='<table class="table table-sm table-striped " id="tab" >';
    $output.=' <thead> 
    <tr>

      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">S/rubrique </th>
      <th scope="col">Objet </th>

      <th>Actions</th>
 
    </tr></thead> <tbody>' ;
    $i=1;
   
    $besoins=liste_besoin_valide();
    
    foreach($besoins as $besoin) 
    { 
   $output.='  <tr>
                
                <td class="py-1">'.$i.'</td>
                <td class="py-1">'.date('d/m/Y',strtotime($besoin['date_saisie'])).'</td>
                <td class="py-1">'.$besoin['libelle_sous'].'</td>
                <td class="py-1">'.$besoin['objet'].'</td>
                <td class="py-1">  
                <a href="show.php?id='.$besoin['id_besoin'].'"><button class="btn btn-info btn-sm "><i class=" fa fa-eye "></i></button></a> ';
            if($besoin['etat_besoin']==0){
              if( nbre_proforma_besoin($besoin['id_besoin'])>=3){
                $output.='<a href="../bon_commande/create_engagement.php?id='.$besoin['id_besoin'].'"><button class="btn btn-primary btn-sm "> Bon d\'engagement </button></a> ';
                  
              }
                if (($_SESSION['role'] != 'commercial') && ($_SESSION['role'] != 'comptable')) {
                    $output.='<a href="#?id='.$besoin['id_besoin'].'"><button class="btn btn-success btn-sm "> <i class=" fa fa-edit "> </i></button></a> ';
                  
                  $output.=' <button class="btn btn-danger  btn-sm" onclick="confirmer('.$besoin['id_besoin'].')"><i class="fa fa-trash"></i></button>';
     
                }}
                $output.='</td>
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
                Besoin enregistré avec succès
                
                </div>';
              }
              elseif (isset($_GET['msg'])&& $_GET['msg']==2){
                echo'<div class="alert alert-success  fade show" role="alert">
                La mise à jour  du besoin s\'est effectuée avec succès
              
                </div>';
              }
              elseif (isset($_GET['msg'])&& $_GET['msg']==3){
                echo'<div class="alert alert-success  fade show" role="alert">
                La suppression du produit s\'est effectuée avec succès
                
                </div>';
              }

              ?>
          <div>
          <h4 class="mb-4">Besoin</h4>
          </div>
        <!-- partial -->
       
                      <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Liste des besoins validés</h6>
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