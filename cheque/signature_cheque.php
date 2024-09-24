<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];

if($_SESSION['role']=='daf'){
    $reponse=update_table1('cheques', 'id_cheque', $id,'date_cheque_daf', gmdate('Y-m-d'),'valide_cheque_daf',1);
    if($reponse==1){
        header('Location:cheque_valide.php?msg=2');
    }
     else{  header('Location:cheque_valide.php?msg=0');} 
}
elseif($_SESSION['role']=='dg'){
    $reponse=update_table1('cheques', 'id_cheque', $id,'date_cheque_dg', gmdate('Y-m-d'),'valide_cheque_dg',1);
    if($reponse==1){
        header('Location:cheque_valide.php?msg=2');
    }
     else{  header('Location:cheque_valide.php?msg=0');}  
}
elseif($_SESSION['role']=='admin'){
    
    $reponse=update_table1('cheques', 'id_cheque', $id,'date_cheque_daf', gmdate('Y-m-d'),'valide_cheque_daf',1);
    if($reponse==1){
        $reponse2=update_table1('cheques', 'id_cheque', $id,'date_cheque_dg', gmdate('Y-m-d'),'valide_cheque_dg',1);
        if($reponse2==1){
           
        header('Location:cheque_valide.php?msg=2');
        }
        else{
             header('Location:cheque_valide.php?msg=0');
            }
     }
     else{
         header('Location:cheque_valide.php?msg=0');
        }  
   }
   
  
?>