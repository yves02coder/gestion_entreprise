<?php 
session_start();
if((!isset($_SESSION['connexion'])) || ($_SESSION['connexion']!='ok')){
    header('Location:../index.php');
}
   require_once('../configuration/userController.php');
   include_once('../partials/header.php'); 
   include_once('../partials/footer.php');


    $output='<table class="table table-sm table-striped " id="tab" >';
    $output.=' <thead> 
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom </th>
      <th scope="col">Prénoms </th>
      <th scope="col">Email </th>
      <th scope="col">Rôle </th>
      <th>Actions</th>
 
    </tr></thead> <tbody>' ;
    $i=1;
   
    $users=list_user();
    
    foreach($users as $user) 
    { 
   $output.='  <tr>
                <td >'.$i.'</td>
                <td class="py-1">'.$user['nom'].'</td>
                <td class="py-1">'.$user['prenom'].'</td>
                <td class="py-1">'.$user['email'].'</td>
                <td class="py-1">'.$user['role'].'</td>
                
                <td class="py-1> <a href="update.php?id='.$user['id_user'].'"><button class="btn btn-success btn-sm "><i class=" fa fa-edit "></i></button></a>
                <button class="btn btn-danger  btn-sm" onclick="confirmer('.$user['id_user'].')"><i class="fa fa-trash"></i></button>
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
                Utilisateur a été enregistrée avec succès
                
                </div>';
              }
              elseif (isset($_GET['msg'])&& $_GET['msg']==2){
                echo'<div class="alert alert-success  fade show" role="alert">
                La mise à jour  de l\'utilisateur s\'est effectuée avec succès
              
                </div>';
              }
              elseif (isset($_GET['msg'])&& $_GET['msg']==3){
                echo'<div class="alert alert-success  fade show" role="alert">
                La suppression de l\'utilisateur s\'est effectuée avec succès
                
                </div>';
              }

              ?>
          <div>
          <h4 class="mb-4">Utilisateur</h4>
          </div>
        <!-- partial -->
       
                      <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Liste des utilisateurs</h6>
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