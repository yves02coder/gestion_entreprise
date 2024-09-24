<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=update_table1('cheques', 'id_cheque', $id,'date_valide_cheque', gmdate('Y-m-d'),'validateur_ch',$_SESSION['id']);
$msg=($reponse==1)?3:0;
      header('Location:cheque_attente.php?msg='.$msg);


?>
