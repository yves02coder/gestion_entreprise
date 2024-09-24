<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('ligne_emploi', 'id_ligne_emploi', $id);
$msg=($reponse==1)?2:0;
      header('Location:liste_emploi.php?msg='.$msg);

?>