<?php
session_start();
include('../configuration/fonctions.php');

if (isset($_POST['proforma_id'])) {
  $resultat = afficher_client($_POST['proforma_id']);
  echo $resultat;
}



