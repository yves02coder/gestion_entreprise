<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('services', 'id_service', $id);

$msg=($reponse==1)?3:0;
      header('Location:liste_service.php?msg='.$msg);

?>