<?php
require_once('database.php');
require_once('fonctions.php');



if(isset($_POST['creer_client'])){
    $rep=verifier_unicite('clients','nom_client',htmlspecialchars(addslashes($_POST['nom'])));
 if($rep!=0){
    header('Location:creer_client.php?msg=1'); 
 }
 else{
    $resultat=create_client($_SESSION['id']);
    $msg=($resultat==1)?1:0;
    header('Location:prospects.php?msg='.$msg);
   }
}

if(isset($_POST['maj_client'])){
    $rep=edit_client($_GET['id']);
        $msg=($rep==1)?2:0;
        header('Location:clients.php?msg='.$msg);
    
}