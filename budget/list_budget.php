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

                                                echo '<option value="' . $annee['annee'] . '"';
                                                if (date('Y') == $annee['annee']) {
                                                    echo 'selected';
                                                }
                                                echo '>'
                                                    . $annee['annee'] . '</option>';
                                            }
                                            
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>



                        <div class="table-responsive">
                            <table class="table table-sm table-striped  " id="tab">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Compte </th>
                                        <th scope="col">Code </th>
                                        <th scope="col">Rubrique </th>
                                        <th scope="col">Montant</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="contenu">
                                    <?php
                                    
                                    $i = 1;
                                    foreach ($rubriques as $rubrique) {
                                        echo '<tr>  
                                            <td>' . $i . '</td>
                                            <td>' . $rubrique['compte'] . '</td>
                                            <td>' . $rubrique['code_rubrique'] . '</td>
                                            <td>' . $rubrique['libelle_rubrique'] . '</td>
                                            <td>' . number_format($rubrique['montant'], 2, ',', ' ') . '</td> 
                                        
                                            <td class="py-1"> <a href="update.php?id=' . $rubrique['id_ligne_budget'] . '"><button class="btn btn-success btn-sm "><i class=" fa fa-edit "></i></button></a>';
                                            if (($_SESSION['role'] != 'commercial') && ($_SESSION['role'] != 'comptable')) {
                                                echo' <a href="valide_budget.php?id='.$rubrique['id_ligne_budget'].'"><button class="btn btn-success btn-sm "><i class=" fa fa-check "></i> Valider </button></a> ';
                                            }
                                            echo'<button class="btn btn-danger  btn-sm" onclick="confirmer(' . $rubrique['id_ligne_budget'] . ')"><i class="fa fa-trash"></i></button>
                                            </tr>';
                                        $i++;
                                    }

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

    <script type="text/javascript">
        $('#anneeb').change(function() {
            anneeb = $('#anneeb option:selected').val();

            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: {
                    anneeb: anneeb
                },
                success: function(rep) {
                    $('#contenu').html(rep)
                }

            });
        });
    </script>
    <!-- End custom js for this page -->
</body>

</html>