<?php
session_start();
include('../configuration/fonctions.php');



if (isset( $_POST['annee'])){
   
  
  $ressources=liste_ressource_annee($_POST['annee']);
foreach ($ressources as $ressource) {

$output .= '<option value="' . $ressource['id_ligne_ressource'] . '">' . $ressource['compte_sressource'] . ': ' . $ressource['libelle_sressource'] . '</option>';
}
echo $output;
}



