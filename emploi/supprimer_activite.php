<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('activites', 'id_activite', $id);

$msg=($reponse==1)?3:0;
      header('Location:liste_activite.php?msg='.$msg);

?>