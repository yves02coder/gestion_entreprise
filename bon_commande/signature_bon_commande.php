<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];

if(($_SESSION['role']=='daf' || $_SESSION['role']=='admin')){
$reponse=update_table1('bon_commandes', 'id_bon_commande', $id,'signature_daf', 1,'date_signature_daf',gmdate('Y-m-d'));

$msg=($reponse==1)?1:0;
header('Location:bon_commande_valide.php?msg='.$msg);

}

if(($_SESSION['role']=='dg' || $_SESSION['role']=='admin')){
    $reponse1=update_table1('bon_commandes', 'id_bon_commande', $id,'signature_dg', 1,'date_signature_dg',gmdate('Y-m-d'));
   
    $msg=($reponse1==1)?1:0;
    header('Location:bon_commande_valide.php?msg='.$msg);
    
}
?>