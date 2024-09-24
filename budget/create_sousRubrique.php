<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
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
            <?php include_once('../partials/body_header.php'); ?>

            <div class="container-fluid pt-4 px-4">
                <?php if ((isset($_GET['msg'])) && ($_GET['msg'] == 4)) {
                    echo '<div class="alert alert-danger  fade show" role="alert">
          Ce code rubrique exixte déjà
               
              </div>';
                }
                ?>
                <h4 class="mb-4">Sous Rubrique</h4>
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-8">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Nouvelle sous rubrique</h6>
                            <form method="POST">
                                <div class="row mb-3">
                                    <label for="rubrique" class="col-sm-4 col-form-label"> Rubrique*</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="rubrique" id="rubrique" required>
                                            <option selected disabled value="-1">-------Selectionner rubrique------</option>
                                            <?php
                                            $rubriques = getTable('rubriques');
                                            foreach ($rubriques as $rubrique) {
                                                echo '<option value="' . $rubrique['id_rubrique'] . '">' . $rubrique['code_rubrique'] . '|' . $rubrique['libelle_rubrique'] . ' </option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="code" class="col-sm-4 col-form-label">Code sous rubrique*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="code" name="code" required placeholder="Code rubrique">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="libelle" class="col-sm-4 col-form-label">Libellé*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="libelle" name="libelle" required placeholder="Libellé">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="compte" class="col-sm-4 col-form-label">N<sup>o</sup>Compte*</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="compte" name="compte" required min="0">
                                    </div>
                                </div>
                                <div class="text-center  py-2">
                                    <button type="submit" class="btn btn-primary mr-2" name="creer_srubrique" id="creer_srubrique">Enregistrer</button>
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
            id_rubrique = $('#rubrique option:selected').val();
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: {
                      id_rubrique: id_rubrique
                      },
                success: function(rep) {
                    
                    $('#compte').val(rep);
                   
                }
            });

        });
    </script>
    
</body>

</html>