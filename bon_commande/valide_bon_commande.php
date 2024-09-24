<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('bon_commandes', 'id_bon_commande', $id,'date_valide_bc', gmdate('Y-m-d'),'validateur_bc',$_SESSION['id']);

$msg=($reponse==1)?3:0;
      header('Location:bon_commande_attente.php?msg='.$msg);

?>