<?php
session_start();
if((!isset($_SESSION['connexion'])) || ($_SESSION['connexion']!='ok')){
    header('Location:../index.php');
} 
   require_once('../configuration/clientController.php');
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
           <h4 class="mb-4">Client</h4>
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-8">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Nouveau prospect</h6>
                            <form method="POST">

                            <div class="row mb-3">
                                    <label for="nom" class="col-sm-4 col-form-label">Nom*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nom" name="nom" required placeholder="Nom">
                                    </div>
                            </div>

                            <div class="row mb-3">
                                    <label for="contact" class="col-sm-4 col-form-label">Contact*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="contact" name="contact" required placeholder="0000000000">
                                    </div>
                            </div>
                            <div class="row mb-3">
                                    <label for="adresse" class="col-sm-4 col-form-label">Adresse*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="adresse" name="adresse" required placeholder="Abidjan">
                                    </div>
                            </div>
                            <div class="row mb-3">
                                    <label for="email" class="col-sm-4 col-form-label">Email*</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="email" name="email" required placeholder="abc@exemple.com">
                                    </div>
                            </div>
                            <div class="row mb-3">
                                    <label for="interlocuteur" class="col-sm-4 col-form-label">Interlocuteur*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="interlocuteur" name="interlocuteur" required placeholder="Interlocuteur">
                                    </div>
                            </div>

                            <div class="row mb-3">
                                    <label for="domaine" class="col-sm-4 col-form-label">Domaine d'activité*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="domaine" name="domaine" required placeholder="Domaine d'activité">
                                    </div>
                            </div>

                            <div class="text-center  py-2">
                            <button type="submit" class="btn btn-primary mr-2" name="creer_client" id="creer_client">Enregistrer</button>
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
     
  </body>
