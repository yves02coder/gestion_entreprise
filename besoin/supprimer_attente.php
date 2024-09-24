<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('besoins', 'id_besoin', $id);
$msg=($reponse==1)?4:0;
      header('Location:besoin_attente.php?msg='.$msg);

?>