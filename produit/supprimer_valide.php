<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('produits', 'id_produit', $id);

$msg=($reponse==1)?3:0;
      header('Location:produit_valide.php?msg='.$msg);
?>