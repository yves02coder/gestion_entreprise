<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require_once('../configuration/besoinController.php');
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
            <?php include_once('../partials/body_header.php'); ?>

            <div class="container-fluid pt-4 px-4">
                <?php if ((isset($_GET['msg'])) && ($_GET['msg'] == 4)) {
                    echo '<div class="alert alert-danger  fade show" role="alert">
          Cette ligne budgetaire exixte déjà
               
              </div>';
                }
                ?>
                <h4 class="mb-4">Besoin</h4>
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-8">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Nouveau besoin</h6>
                            <form method="POST">

                                <div class="row mb-3">
                                    <label for="rubrique" class="col-sm-4 col-form-label"> Rubrique*</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="rubrique" id="rubrique" required>
                                            <option selected disabled value="-1">-------Selectionner rubrique------</option>

                                            <?php
                                            $rubriques = rubrique_budget_byannee2(date('Y'));
                                            foreach ($rubriques as $rubrique) {
                                                echo '<option value="' . $rubrique['id_rubrique'] . '">' . $rubrique['code_rubrique'] . '|' . $rubrique['libelle_rubrique'] . ' </option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                

                                <div class="row mb-3">
                                    <label for="rubrique" class="col-sm-4 col-form-label"> S/Rubrique*</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="srubrique" id="srubrique" required>
                                            <option selected disabled value="-1">-------Selectionner s/rubrique------</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="type" class="col-sm-4 col-form-label"> Type de procédure*</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="type" id="type" required>
                                            <option selected value="1">Procédure normale</option>
                                            <option value="0">Procédure simplifiée</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="objet" class="col-sm-4 col-form-label">Objet du besoin*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="objet" name="objet" nim="0" required>
                                    </div>
                                </div>



                                <div class="text-center  py-2">
                                    <button type="submit" class="btn btn-primary mr-2" name="creer_besoin" id="creer_besoin">Enregistrer</button>
                                    <button type="reset" class="btn btn-dark">Annuler</button>
                                </div>
                            </form>
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
       

        $('#rubrique').change(function() {

            rubriqueb = $('#rubrique option:selected').val();
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: {
                    rubriqueb: rubriqueb
                },
                success: function(rep) {
                    $('#srubrique').html(rep);
                }
            });
        });
    </script>
</body>

</html>