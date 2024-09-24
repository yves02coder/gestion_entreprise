<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];

if($_SESSION['role']=='controlleur'){
    $reponse=update_table1('bon_factures', 'id_bon_facture', $id,'date_fa_controle', gmdate('Y-m-d'),'valide_controle',1);
    if($reponse==1){
        header('Location:facture_valide.php?msg=1');
    }
     else{  header('Location:facture_valide.php?msg=0');}   
}
elseif($_SESSION['role']=='daf'){
    $reponse=update_table1('bon_factures', 'id_bon_facture', $id,'date_fa_daf', gmdate('Y-m-d'),'valide_daf',1);
    if($reponse==1){
        header('Location:facture_valide.php?msg=1');
    }
     else{  header('Location:facture_valide.php?msg=0');} 
}
elseif($_SESSION['role']=='dg'){
    $reponse=update_table1('bon_factures', 'id_bon_facture', $id,'date_fa_dg', gmdate('Y-m-d'),'valide_dg',1);
    if($reponse==1){
        header('Location:facture_valide.php?msg=1');
    }
     else{  header('Location:facture_valide.php?msg=0');}  
}
elseif($_SESSION['role']=='admin'){
    
    $reponse=update_table1('bon_factures', 'id_bon_facture', $id,'date_fa_daf', gmdate('Y-m-d'),'valide_daf',1);
    if($reponse==1){
        $reponse2=update_table1('bon_factures', 'id_bon_facture', $id,'date_fa_dg', gmdate('Y-m-d'),'valide_dg',1);
        if($reponse2==1){
            $reponse3=update_table1('bon_factures', 'id_bon_facture', $id,'date_fa_controle', gmdate('Y-m-d'),'valide_controle',1);
          if($reponse3==1){
        header('Location:facture_valide.php?msg=1');
        }
        else{ header('Location:facture_valide.php?msg=0');}
     }
     else{ header('Location:facture_valide.php?msg=0');}  
   }
   else{ header('Location:facture_valide.php?msg=0');}
  }
?>