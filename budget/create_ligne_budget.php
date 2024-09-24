<?php 
session_start();
if((!isset($_SESSION['connexion'])) || ($_SESSION['connexion']!='ok')){
    header('Location:../index.php');
}
   require_once('../configuration/budgetController.php');
   include_once('../partials/header.php');
    include_once('../partials/footer.php');
       
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
                            <h6 class="mb-4">Nouvelle ligne budgetaire</h6>
                            <form method="POST">

                            <div class="row mb-3">
                            <label for="annee" class="col-sm-4 col-form-label"> Année*</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="annee" id="annee" required>
                                            <option  selected disabled value="-1">-------Selectionner année------</option>
                                            <?php
                        
                                                echo '<option value="' . date('Y') . '">' . date('Y') . ' </option>';
                                                echo '<option value="' . date('Y', strtotime('+1year')) . '">' . date('Y', strtotime('+1year')) . ' </option>';
                                            ?>
                                        </select>
                                    </div>

                            </div>
                            <div class="row mb-3">
                            <label for="rubrique" class="col-sm-4 col-form-label"> Rubrique*</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="rubrique" id="rubrique" required>
                                            <option selected disabled value="-1">-------Selectionner rubrique------</option>
                                          
                                        </select>
                                    </div>
                            </div>

                            <div class="row mb-3">
                                    <label for="montant" class="col-sm-4 col-form-label">Montant*</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="montant" name="montant" nim="0" required >
                                    </div>
                            </div>            

                            <div class="text-center  py-2">
                            <button type="submit" class="btn btn-primary mr-2" name="creer_ligne" id="creer_ligne">Enregistrer</button>
                             <button type="reset"class="btn btn-dark">Annuler</button>
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
    <script type="text/javascript">
        $('#annee').change(function() {
           year = $('#annee option:selected').val();

            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: {
                    year: year
                },
                success: function(rep) {
                    $('#rubrique').html(rep)
                }

            });
        });
        </script> 
  </body>
</html>