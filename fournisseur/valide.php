<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('fournisseurs', 'id_fournisseur', $id,'date_valide_f', gmdate('Y-m-d'),'validateur_f',$_SESSION['id']);
if($reponse==1){
    header('Location:fournisseur_attente.php?msg=3');
}
 else{  header('Location:fournisseur_attente.php?msg=0');}
?>