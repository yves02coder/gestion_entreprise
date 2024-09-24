<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('factures', 'id_facture', $id);
if($reponse==1){
    
      $reponse1=update_propriete_table('commandes','id_commande',$_GET['id1'],'etat_commande',0);
      $msg=($reponse1==1)?3:0;
      header('Location:facture_valide.php?msg='.$msg);         
  }
else 
    {header('Location:facture_valide.php?msg=0');}

?>