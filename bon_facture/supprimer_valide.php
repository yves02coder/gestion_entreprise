<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('bon_factures', 'id_bon_facture', $id);
if($reponse==1){
    if(!empty($_GET['id1'])){
      $reponse1=update_propriete_table ('livraisons','id_livraison',$_GET['id1'],'etat_livraison',0);
      if($reponse1==1){
        header('Location:facture_attente.php?msg=3');
      }
      else {
        header('Location:facture_attente.php?msg=0');
      }

    }
    else{
      $reponse1=update_table1('besoins','id_besoin',$_GET['id2'],'etat_besoin',0,'date_etat_b',NULL);
      if($reponse1==1){
        header('Location:facture_attente.php?msg=3');
      }
      else {
        header('Location:facture_attente.php?msg=0');
      }
    }
  }
 else{  header('Location:facture_attente.php?msg=0');
}