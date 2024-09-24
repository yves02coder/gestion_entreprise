<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('engagements', 'id_engagement', $id,'date_valide_ben', gmdate('Y-m-d'),'validateur_ben',$_SESSION['id']);
$msg=($reponse==1)?3:0;
      header('Location:engagement_attente.php?msg='.$msg);

?>