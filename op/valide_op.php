<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('ordre_paiement', 'id_ordre_paiement', $id,'date_valide_op', gmdate('Y-m-d'),'validateur_op',$_SESSION['id']);


if($reponse==1){
    header('Location:op_attente.php?msg=3');
}
 else{  header('Location:op_attente.php?msg=0');}
?>
