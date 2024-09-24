<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
  header('Location:../index.php');
}
require_once('../configuration/FactureController.php');
include_once('../partials/header.php');
include_once('../partials/footer.php');


global $tab_idproduit;
global $tab_codeproduit;
global $tab_libelle;
$tab_idproduit=array();
$tab_codeproduit=array();
$tab_libelle=array();
$resultats=getTable('produits');
foreach($resultats as $donnees){
  $tab_idproduit[]=$donnees['id_produit'];
  $tab_codeproduit[]=$donnees['code_produit'];
  $tab_libelle[]=$donnees['libelle'];
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
      <?php include_once('../partials/body_header.php'); ?>

      <div class="container-fluid pt-4 px-4">
        <h4 class="mb-4">Facture</h4>
        <div class="row g-4">
          <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
              <h6 class="mb-4">Nouvelle facture</h6>
              
              <form method="POST">
              <input type="number" id="counter" name="counter" style="display:none"/>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group ">
                      <label class="col-sm-3 col-form-label">Commande*</label>
                      <div class="col-sm-12">
                        <select class="form-select" name="commande" id="commande" required >
                          <option value="-1">-------Selectionner commande------</option>
                          <?php
                          $commandes = commande_facture();
                          foreach ($commandes as $commande) {
                            echo '<option value="'.$commande['id_commande']. '">N<sup>o</sup>'.$commande['id_commande'].':'.date('d/m/Y', strtotime($commande['date_commande'])).'/'.$commande['nom_client'].' </option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group ">
                      <label class="col-sm-3 col-form-label">Date*</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" readonly value="<?= gmdate('d/m/Y') ?>" />
                      </div>
                    </div>
                  </div>
                 
                  <div class="col-md-3">
                    <div class="form-group ">
                      <label class="col-sm-3 col-form-label">Remise*</label>
                      <div class="col-sm-12">
                        <input type="number" class="form-control" required min="0" name="remise" id="remise" value="<?= 0 ?>" />
                      </div>
                    </div>
                  </div>
                </div>
                <div id="zone_produit">
                  <div class="row" id="produit_pro">
                    <div class="col-md-4">
                      <div class="form-group ">
                        <label class="col-sm-3 col-form-label">Produit*</label>
                        <div class="col-sm-12">
                        <select class="form-select" name="produit0" id="produit0" required onchange="prix(this.id)" >
                          <option selected disabled value="-1">-------Selectionner Produit------</option>
                          <?php
                              for ($i=0;$i<count($tab_idproduit);$i++) {
                                echo'<option value="'.$tab_idproduit[$i].'">'.$tab_codeproduit[$i].': '.$tab_libelle[$i].'</option>';
                             } 
                          ?>
                         
                        </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group ">
                        <label class="col-sm-3 col-form-label">Quantité*</label>
                        <div class="col-sm-12">
                          <input type="number" class="form-control" min="0" name="quantite0" id="quantite0" required />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group ">
                        <label class="col-sm-6 col-form-label">Prix uintaire</label>
                        <div class="col-sm-12">
                        <input type="number" class="form-control" min="0" name="prix0" id="prix0" required/>
          
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
                <div class="py-3">
              <button class="btn btn-primary mr-2"  name="btnaddprdt" id="btnaddprdt">Ajouter produit</button>
            </div>
            <div class="text-center  py-4">
              <button type="submit" class="btn btn-primary mr-2" name="creer_facture" id="creer_facture">Enregistrer</button>
              <button type="reset" class="btn btn-dark">Annuler</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- partial:partials/_footer.html -->
    <?php include_once('../partials/body_footer.php'); ?>
    
    <script type="text/javascript">
x=0;

tableau = <?php echo json_encode($tab_idproduit); ?>;
tableau1 = <?php echo json_encode($tab_codeproduit); ?>;
tableau2 = <?php echo json_encode($tab_libelle); ?>;
// Action du bouton ajout produit 
$('#btnaddprdt').click(function(e){
    x++;
    e.preventDefault();
    $('#counter').val(x);   
    ajoutproduit(x);
    
})
//
function ajoutproduit(x){

 // var produit ='#produit'+(x-1);
 
  //var valeur1=$(machine+' option:selected').val();
  /* var valeur=$('#produit'+(x-1)+' option:selected').val();
  var indice= tableau.indexOf(valeur);
  
  tableau.splice(indice,1);
  tableau1.splice(indice,1);
  tableau2.splice(indice,1)*/


 $('#zone_produit').append(`


 <div class="row" id="produit_pro">
                    <div class="col-md-4">
                      <div class="form-group ">
                        <label class="col-sm-3 col-form-label">Produit`+x+`*</label>
                        <div class="col-sm-12">
                        <select class="form-select" name="produit`+x+`" id="produit`+x+`" required onchange="prix(this.id)" >
                          <option value="-1">-------Selectionner Produit------</option>
                         
                        </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group ">
                        <label class="col-sm-3 col-form-label">Quantité*</label>
                        <div class="col-sm-12">
                          <input type="number" class="form-control" min="0" name="quantite`+x+`" id="quantite`+x+`" required />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group ">
                        <label class="col-sm-6 col-form-label">Prix uintaire</label>
                        <div class="col-sm-12">
                        <input type="number" class="form-control" min="0" name="prix`+x+`" id="prix`+x+`" required/>
          
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2 py-3">
                      <div class="form-group ">
                      <label class="col-sm-6 col-form-label"></label>
                        <div class="col-sm-12 ">
                        <button class="btn btn-danger  btn-sm delete_prdt" onclick="confirmer()"><i class="fa fa-trash"></i></button>
              
                        </div>
                      </div>
                    </div>
                  </div>

    `)
$.ajax({
             type: 'POST',
             url: "../lib/ajax.php",
             data: {click:'click',tableau:tableau,tableau1:tableau1,tableau2:tableau2},
             success: function(resultat){
              
                     $('#produit'+x).html(resultat);
                 }
             }); 
 
}

function prix(id){

i=id;
id_produit=$('#'+i+' option:selected').val();
var numero=i.substr(-1);
var zone="prix"+numero;
 afficherprix(id_produit,zone); 
}

function afficherprix(id_produit,zone) {  
             $.ajax({
             type: 'POST',
             url: "../lib/ajax.php",
             data: {id_produit:id_produit},
             success: function(resultat){
                     $('#'+zone).val(resultat);
                     
                 }
             });   
} 
  </script>
    <!-- partial -->
  </div>

  </div>

</body>

</html>