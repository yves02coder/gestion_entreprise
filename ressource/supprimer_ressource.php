<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('ressources', 'id_ressource', $id);

$msg=($reponse==1)?3:0;
      header('Location:liste_ressource.php?msg='.$msg);

?>