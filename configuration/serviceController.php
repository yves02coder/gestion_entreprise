<?php
require_once('database.php');
require_once('fonctions.php');


if(isset($_POST['creer_service'])){
    $rep=verifier_unicite('services','nom_service',htmlspecialchars(addslashes($_POST['service'])));
 if($rep!=0){
    header('Location:creer_service.php?msg=1'); 
 }
 else{
    $resultat=create_service();
    $msg=($resultat==1)?1:0;
    header('Location:liste_service.php?msg='.$msg);
   }
}

   if(isset($_POST['maj_service'])){
    $rep=verifier_unicite1('services','nom_service',htmlspecialchars(addslashes($_POST['service'])),'id_service',$_GET['id']);
    if($rep!=0){
       header('Location:maj_service.php?msg=1&id='.$_GET["id"]); 
    }
    else{
    $resultat=update_service($_GET['id']);
    $msg=($resultat==1)?2:0;
    header('Location:liste_service.php?msg='.$msg);
}}














































