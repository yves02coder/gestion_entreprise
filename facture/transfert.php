<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_propriete_table('factures', 'id_facture', $id,'transfert_facture', 1);

$msg=($reponse==1)?3:0;
      header('Location:facture_valide.php?msg='.$msg);

?>