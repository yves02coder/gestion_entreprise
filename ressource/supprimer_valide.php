<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('ligne_ressource', 'id_ligne_ressource', $id);
$msg=($reponse==1)?2:0;
      header('Location:liste_ressource_valide.php?msg='.$msg);

?>