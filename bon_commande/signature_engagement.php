<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('engagements', 'id_engagement', $id,'signature_ben',1,'date_signature_ben',gmdate('Y-m-d'));

$msg=($reponse==1)?1:0;
      header('Location:engagement_valide.php?msg='.$msg);

?>