<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('commandes', 'id_commande', $id);
if($reponse==1){
    
      $reponse1=update_propriete_table('proformas','num_proforma',$_GET['id1'],'etat_proforma',0);
      $msg=($reponse1==1)?4:0;
      header('Location:commande_attente.php?msg='.$msg);         
  }
else 
    {header('Location:commande_attente.php?msg=0');}

?>