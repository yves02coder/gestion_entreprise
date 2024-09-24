<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('fproformas', 'id_fproforma', $id);
$msg=($reponse==1)?4:0;
      header('Location:fproforma_attente.php?msg='.$msg);

?>