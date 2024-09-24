<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('ordre_paiement', 'id_ordre_paiement', $id);
if($reponse==1){
    
      $reponse1=update_propriete_table ('bon_factures','id_bon_facture',$_GET['id2'],'etat_facture',0);
      
      $msg=($reponse1==1)?3:0;
      header('Location:op_valide.php?msg='.$msg);
     
    
  }

 else{  header('Location:op_valide.php?msg=0');}
?>