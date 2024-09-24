<?php
session_start();
include_once("../configuration/fonctions.php");
$id= $_GET['id'];
$reponse=delete_element('clients', 'id_client', $id);
$msg=($reponse==1)?3:0;
    header('Location:prospects.php?msg='.$msg);

?>