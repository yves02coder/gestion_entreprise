<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('engagements', 'id_engagement', $id);
if($reponse==1){
    $reponse1=delete_produit_commande($id);
     if($reponse1==1){
      $reponse2=update_table1('besoins','id_besoin',$_GET['id2'],'etat_besoin',0,'date_etat_b',NULL);
      $msg=($reponse2==1)?3:0;
      header('Location:engagement_valide.php?msg='.$msg);
    
  }
else 
    {header('Location:engagement_valide.php?msg=0');}
}
 else{  header('Location:engagement_valide.php?msg=0');}
?>