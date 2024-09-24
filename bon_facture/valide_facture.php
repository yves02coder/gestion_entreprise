<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('bon_factures', 'id_bon_facture', $id,'date_valide_fa', gmdate('Y-m-d'),'validateur_fa',$_SESSION['id']);
$msg=($reponse==1)?3:0;
      header('Location:facture_attente.php?msg='.$msg);

?>