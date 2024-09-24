<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('ligne_emploi', 'id_ligne_emploi', $id,'date_valide_le', gmdate('Y-m-d'),'validateur_le',$_SESSION['id']);

$msg=($reponse==1)?3:0;
      header('Location:liste_emploi_attente.php?msg='.$msg);

?>