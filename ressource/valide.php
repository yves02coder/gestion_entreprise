<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('ligne_ressource', 'id_ligne_ressource', $id,'date_valide_lr', gmdate('Y-m-d'),'validateur_lr',$_SESSION['id']);

$msg=($reponse==1)?3:0;
      header('Location:liste_ressource_attente.php?msg='.$msg);

?>