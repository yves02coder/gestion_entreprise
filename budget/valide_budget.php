<?php 
session_start();
if((!isset($_SESSION['connexion'])) || ($_SESSION['connexion']!='ok')){
    header('Location:../index.php');
}
   require_once('../configuration/budgetController.php');
   include_once('../partials/header.php');
    include_once('../partials/footer.php');
  $lignes=ligne_budget($_GET['id']);
    foreach($lignes as $ligne){
        $annee= $ligne['annee'];
        $libelle= $ligne['libelle_rubrique'];
        $montant= $ligne['montant'];
        $date_saisie=date('d/m/Y', strtotime($ligne['date_saisie']));
    }    
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
          <?php if((isset($_GET['msg'])) && ($_GET['msg']==4)){
            echo'<div class="alert alert-danger  fade show" role="alert">
          Cette ligne budgetaire exixte déjà
               
              </div>';}
              ?> 
           <h4 class="mb-4">Ligne budgetaire</h4>
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-8">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Validation ligne budgetaire</h6>
                            <form method="POST">
                           
                            <div class="row mb-3">
                            <label for="annee" class="col-sm-4 col-form-label"> Année*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" disabled value="<?=$annee?>">
                                           
                                    </div>

                            </div>

                            <div class="row mb-3">
                                    <label for="date" class="col-sm-4 col-form-label">Date*</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="<?=$date_saisie?>">
                                    </div>
                            </div>

                            <div class="row mb-3">
                            <label for="rubrique" class="col-sm-4 col-form-label"> Rubrique*</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="<?=$libelle?>">
                                    </div>
                            </div>

                            <div class="row mb-3">
                                    <label for="montant" class="col-sm-4 col-form-label">Montant*</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled value="<?=number_format($montant, 0, ',', ' ')?>">
                                    </div>
                            </div>

                           

                           

                            <div class="text-center  py-2">
                            <button type="submit" class="btn btn-primary mr-2" name="valider_ligne" id="valider_ligne">Valider</button>
                             
                             </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          <!-- partial:partials/_footer.html -->
          <?php include_once('../partials/body_footer.php');?>
          <!-- partial -->
        </div>
        
    </div>
     
  </body>
</html>