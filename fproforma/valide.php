<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('fproformas', 'id_fproforma', $id,'date_valide_fp', gmdate('Y-m-d'),'validateur_fp',$_SESSION['id']);
$msg=($reponse==1)?3:0;
      header('Location:fproforma_attente.php?msg='.$msg);

?>