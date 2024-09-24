<?php
session_start();
include('../configuration/fonctions.php');

if (isset( $_POST['id_produit'])){

 /* $resultat=delete_element('produits_commande','id_produit_commande',$_POST['id_produit']);
  if($resultat==1){
    $produits = produit_commande($_POST['id_engagement'] );
                                        foreach ($produits as $produit) {
                                            
                                            $output= '
                                             
                                            <input type="hidden" name="tab[]" value="'.$produit['id_produit_commande'].'" />
                                            <div class="row" id="ligne_produit' . $_POST['id_engagement']  . '' . $produit['id_produit_commande'] . '">

                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label class="col-sm-3 col-form-label">Produit*</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="produit' . $_POST['id_engagement']  . '' . $produit['id_produit_commande'] . '" id="produit' . $_POST['id_engagement']  . '' . $produit['id_produit_commande'] . '" required value="' . $produit['libelle_produit'] . '"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Quantité*</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" min="0" name="quantite' . $_POST['id_engagement']  . '' . $produit['id_produit_commande'] . '" id="quantite' . $_POST['id_engagement']  . '' . $produit['id_produit_commande'] . '" required value="' . $produit['quantite'] . '" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label class="col-sm-6 col-form-label">Prix uintaire</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" min="0" name="prix' . $_POST['id_engagement']  . '' . $produit['id_produit_commande'] . '" id="prix' . $_POST['id_engagement']  . '' . $produit['id_produit_commande'] . '" required value="' . intval($produit['prix']) . '"/>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">

                                                    <label class="col-sm-6 col-form-label py-3"></label>
                                                    <div class="py-1 ">
                                                          <button class="btn btn-danger btn-sm btn_supprime" name="btn_supprime" id="btn_supprime" onclick="supprime_produit('. $_POST['id_engagement']  . ','.$produit['id_produit_commande'].')"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </div>

                                            </div>
                                            ';
                                        }


echo $output;
}*/
echo 'test reussit';
}




