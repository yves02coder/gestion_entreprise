<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('livraisons', 'id_livraison', $id);
if($reponse==1){
    
      $reponse1=update_propriete_table ('bon_commandes','id_bon_commande',$_GET['id2'],'etat_commande',0);
      
      $msg=($reponse1==1)?3:0;
      header('Location:liste_livraison.php?msg='.$msg);
      
    
  }

 else{  header('Location:liste_livraison.php?msg=0');}
?>