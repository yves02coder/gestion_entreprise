<?php
session_start();
include('../configuration/fonctions.php');

if (isset( $_POST['id_service'])){

  $emplois=liste_emploi_service($_POST['id_service']);
foreach ($emplois as $emploi) {

$output .= '<option value="' . $emploi['id_ligne_emploi'] . '">' . $emploi['compte_emploi'] . ': ' . $emploi['libelle_emploi'] . '</option>';
}
echo $output;
}



