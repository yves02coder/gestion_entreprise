<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('emplois', 'id_emploi', $id);
$msg=($reponse==1)?3:0;
      header('Location:liste_emploi.php?msg='.$msg);

?>