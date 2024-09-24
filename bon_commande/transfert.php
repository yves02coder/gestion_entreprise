<?php
session_start();
include_once("../configuration/fonctions.php");

$reponse=update_table1('bon_commandes', 'id_bon_commande', $_GET['id'],'transfert',1,'date_transfert',gmdate('Y-m-d'));

$msg=($reponse==1)?3:0;
    header('Location:bon_commande_valide.php?msg='.$msg);   
?>