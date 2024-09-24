<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require_once('../configuration/budgetController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');



$i = 1;

$rubriques = list_budget(date('Y'));

 

?>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('../partials/menu.php'); ?>
        <!-- partial -->
        <!-- Content Start -->
        <div class="content">
            <!-- partial:partials/_navbar.html -->
            <?php include_once('../partials/body_header.php'); ?>

            <div class="container-fluid pt-4 px-4">
                <?php if (isset($_GET['msg']) && $_GET['msg'] == 0) {
                    echo '<div class="alert alert-danger  fade show" role="alert">
              Erreur SQL !!!

              </div>';
                } elseif (isset($_GET['msg']) && $_GET['msg'] == 1) {
                    echo '<div class="alert alert-success  fade show" role="alert">
                Ligne budgetaire enregistrée avec succès
                
                </div>';
                } elseif (isset($_GET['msg']) && $_GET['msg'] == 2) {
                    echo '<div class="alert alert-success  fade show" role="alert">
                La mise à jour  de la rubrique s\'est effectuée avec succès
              
                </div>';
                } elseif (isset($_GET['msg']) && $_GET['msg'] == 3) {
                    echo '<div class="alert alert-success  fade show" role="alert">
                La suppression du produit s\'est effectuée avec succès
                
                </div>';
                }

                ?>
                <div>
                    <h4 class="mb-4">Ligne budgetaire</h4>
                </div>
                <!-- partial -->


                <div class="col-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-1">Liste des lignes budgetaires</h6>
                         
                        <div class="row py-4">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="col-sm-3 col-form-label">Année*</label>
                            <div class="col-sm-12">
                                <select class="form-select" name="anneeb" id="anneeb" required>
                                    <?php
                                    $annees = annee_budgetaire();
                                    foreach ($annees as $annee) {

                                        echo'<option value="'.$annee['annee'].'"';
                                        if(date('Y')==$annee['annee']){echo'selected';} echo'>'
                                            .$annee['annee'].'</option>';
    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

        
                </div>



                <div class="table-responsive">

<table class="table table-sm table-striped table-bordered ">
    <thead>
        <tr>
        
      <th scope="col">#</th>
      <th scope="col">Code </th>
      <th scope="col">Rubrique </th>
      <th scope="col">Montant</th>
      <th scope="col">Dépense</th>
      <th scope="col">Ecart</th>
      
 
        </tr>
    </thead>
    <tbody>
        <?php
       $i = 1;
        foreach ($rubriques as $rubrique) {


            echo '<tr>  
            <td>' . $i . '</td>
            <td>' . $rubrique['code_rubrique'] . '</td>
            <td>' . $rubrique['libelle_rubrique'] . '</td>
            <td>' . $rubrique['montant'] . '</td>
            <td>' . intval('0') . '</td>
            <td>' . intval($rubrique['montant']-0) . '</td>
           </tr>';
            $i++;
        }
        $montant = 0;
      
        echo '<tr> <td colspan="3"><b class="text-right">Total</b></td>
        <td><b>' . 0 . '</b></td>
        <td><b>' . 0 . '</b></td>
        <td><b>' . 0 . '</b></td>
        </tr>
        ';
            ?>
    </tbody>
</table>

</div>

                    </div>
                </div>
            </div>
            <!-- partial:partials/_footer.html -->
            <?php include_once('../partials/body_footer.php'); ?>
            <!-- partial -->
        </div>

    </div>


    <!-- End custom js for this page -->
</body>

</html>