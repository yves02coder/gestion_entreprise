<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('produits', 'id_produit', $id,'date_valide_pr', gmdate('Y-m-d'),'validateur_pr',$_SESSION['id']);

$msg=($reponse==1)?3:0;
      header('Location:produit_attente.php?msg='.$msg);

?>