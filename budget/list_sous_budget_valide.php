<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require_once('../configuration/budgetController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');



$i = 1;

$rubriques = s_list_budget2(date('Y'));



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
                Sous Ligne budgetaire validée avec succès
                
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
                    <h4 class="mb-4">S/Ligne budgetaire</h4>
                </div>
                <!-- partial -->


                <div class="col-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-1">Liste des S/lignes budgetaires</h6>

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

                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="col-sm-3 col-form-label">Rubrique*</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" name="rubrique" id="rubrique" required>
                                            <option value="-1" selected disabled> Selectionner rubrique</option>

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
                                <tbody id='contenu'>
                                    <?php
                                    $i = 1;
                                    foreach ($rubriques as $rubrique) {
                                        echo '<tr>  
                                            <td>' . $i . '</td>
                                            <td>' . $rubrique['scompte'] . '</td>
                                            <td>' . $rubrique['code_sous_rubrique'] . '</td>
                                            <td>' . $rubrique['libelle_sous'] . '</td>
                                            <td>' . number_format($rubrique['montant_b'], 0, ',', ' ') . '</td>';          
                                            if (($_SESSION['role'] != 'commercial') && ($_SESSION['role'] != 'comptable')) {
                                                echo' <td class="py-1"> <a href="update.php?id=' . $rubrique['id_sous_ligne'] . '"><button class="btn btn-success btn-sm "><i class=" fa fa-edit "></i></button></a>
                                            
                                                  <button class="btn btn-danger  btn-sm" onclick="confirmer(' . $rubrique['id_sous_ligne'] . ')"><i class="fa fa-trash"></i></button>';
                                                  echo' </tr>';
                                            }
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
            anneesb = $('#anneeb option:selected').val();

            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: {
                    anneesbv: anneesbv
                },
                success: function(rep) {
                    $('#rubrique').html(rep)
                }

            });
        });

        $('#rubrique').change(function() {
            rubriquesbv = $('#rubrique option:selected').val();
            annee_rubriquev = $('#anneeb option:selected').val();
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: {
                    rubriquesbv: rubriquesbv,
                    annee_rubriquev: annee_rubriquev
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