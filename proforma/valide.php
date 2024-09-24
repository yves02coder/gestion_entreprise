<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('proformas', 'num_proforma', $id,'date_valide_pro', gmdate('Y-m-d'),'validateur_pro',$_SESSION['id']);

$msg=($reponse==1)?3:0;
      header('Location:proforma_attente.php?msg='.$msg);

?>