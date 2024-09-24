<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('besoins', 'id_besoin', $id,'date_valide_b', gmdate('Y-m-d'),'validateur_b',$_SESSION['id']);
$msg=($reponse==1)?3:0;
      header('Location:besoin_attente.php?msg='.$msg);

?>