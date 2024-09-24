<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('proformas', 'num_proforma', $id);

$msg=($reponse==1)?3:0;
      header('Location:proforma_attente.php?msg='.$msg);
?>