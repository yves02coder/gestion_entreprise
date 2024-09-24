<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('fournisseurs', 'id_fournisseur', $id);
$msg=($reponse==1)?4:0;
    header('Location:fournisseur_attente.php?msg='.$msg);

?>