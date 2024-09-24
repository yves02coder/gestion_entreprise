<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('bon_commandes', 'id_bon_commande', $id);
if($reponse==1){
    
      $reponse1=update_propriete_table ('engagements','id_engagement',$_GET['id2'],'etat_engagement',0);
      $msg=($reponse1==1)?3:0;
      header('Location:bon_commande_valide.php?msg='.$msg);
     
  }

 else{  header('Location:engagement_valide.php?msg=0');}
?>