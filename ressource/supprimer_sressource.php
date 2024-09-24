<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('sous_ressources', 'id_sous_ressource', $id);
$msg=($reponse==1)?3:0;
      header('Location:liste_sous_ressource.php?msg='.$msg);

?>