<?php
session_start();
include('../configuration/fonctions.php');

if (isset($_POST['click'])) {
  $tableau = $_POST['tableau'];
  $tableau1 = $_POST['tableau1'];
  $tableau2 = $_POST['tableau2'];
  $output = '<option value="-1" disabled selected>-------Selectionner produit-------</option>';
  for ($i = 0; $i < count($tableau); $i++) {
    $output .= '<option value="' . $tableau[$i] . '">' . $tableau1[$i] . ': ' . $tableau2[$i] . '</option>';
  }
  echo $output;
}

if (isset($_POST['id_produit'])) {
  $resultat = getpropertyByID('produits', 'prix', 'id_produit', $_POST['id_produit']);
  echo $resultat;
}



