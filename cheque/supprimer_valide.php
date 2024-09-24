<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('cheques', 'id_cheque', $id);

if($reponse==1){
    
      $reponse1=update_propriete_table ('ordre_paiement','id_ordre_paiement',$_GET['id1'],'etat_op',0);
      
      $msg=($reponse1==1)?3:0;
      header('Location:cheque_valide.php?msg='.$msg);

    
  }

 else{  header('Location:cheque_valide.php?msg=0');}
?>