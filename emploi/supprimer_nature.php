<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('natures', 'id_nature', $id);
$msg=($reponse==1)?3:0;
      header('Location:liste_nature.php?msg='.$msg);

?>