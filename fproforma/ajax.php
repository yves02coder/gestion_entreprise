<?php
session_start();
include('../configuration/fonctions.php');




if (isset( $_POST['id_service'])){
  
  $output = '<option value="-1" disabled selected>--Selectionner besoin--</option>';
  $besoins=besoin_par_service($_POST['id_service']);
foreach ($besoins as $besoin) {

$output .= '<option value="' . $besoin['id_besoin'] . '">' . date('d-m-Y',strtotime($besoin['date_saisie_b'])). ':'.$besoin['objet'].'</option>';
}
echo $output;
}



if (isset( $_POST['besoin'])){
  
  $output = '<option value="-1" disabled selected>-------Selectionner fournisseur-------</option>';
  $fournisseurs=fournisseur_non_selectionner($_POST['besoin']);
foreach ($fournisseurs as $fournisseur) {

$output .= '<option value="' . $fournisseur['id_fournisseur'] . '">' . $fournisseur['nom_fournisseur']. '</option>';
}
echo $output;
}



