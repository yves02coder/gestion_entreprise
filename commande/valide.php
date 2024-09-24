<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('commandes', 'id_commande', $id,'date_valide_co', gmdate('Y-m-d'),'validateur_co',$_SESSION['id']);

$msg=($reponse==1)?3:0;
      header('Location:commande_attente.php?msg='.$msg);

?>