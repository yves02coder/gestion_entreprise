<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];

if($_SESSION['role']=='controlleur'){
    $reponse=update_table1('ordre_paiement', 'id_ordre_paiement', $id,'date_op_controle', gmdate('Y-m-d'),'valide_op_controle',1);
    if($reponse==1){
        header('Location:op_valide.php?msg=2');
    }
     else{  header('Location:op_valide.php?msg=0');}   
}
elseif($_SESSION['role']=='daf'){
    $reponse=update_table1('ordre_paiement', 'id_ordre_paiement', $id,'date_op_daf', gmdate('Y-m-d'),'valide_op_daf',1);
    if($reponse==1){
        header('Location:op_valide.php?msg=2');
    }
     else{  header('Location:op_valide.php?msg=0');} 
}
elseif($_SESSION['role']=='dg'){
    $reponse=update_table1('ordre_paiement', 'id_ordre_paiement', $id,'date_op_dg', gmdate('Y-m-d'),'valide_op_dg',1);
    if($reponse==1){
        header('Location:op_valide.php?msg=2');
    }
     else{  header('Location:op_valide.php?msg=0');}  
}
elseif($_SESSION['role']=='admin'){
    
    $reponse=update_table1('ordre_paiement', 'id_ordre_paiement', $id,'date_op_daf', gmdate('Y-m-d'),'valide_op_daf',1);
    if($reponse==1){
        $reponse2=update_table1('ordre_paiement', 'id_ordre_paiement', $id,'date_op_dg', gmdate('Y-m-d'),'valide_op_dg',1);
        if($reponse2==1){
            $reponse3=update_table1('ordre_paiement', 'id_ordre_paiement', $id,'date_op_controle', gmdate('Y-m-d'),'valide_op_controle',1);
          if($reponse3==1){
        header('Location:op_valide.php?msg=2');
        }
        else{ header('Location:op_valide.php?msg=0');}
     }
     else{ header('Location:op_valide.php?msg=0');}  
   }
   else{ header('Location:op_valide.php?msg=0');}
  }
?>