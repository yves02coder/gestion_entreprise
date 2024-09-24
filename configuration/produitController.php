<?php
require_once('database.php');
require_once('fonctions.php');


if(isset($_POST['creer_produit'])){
 $unique=verifier_unicite('produits','code_produit',$_POST['code']);
    if($unique==1){    
    header('Location:../produit/creer_produit.php?msg=1');
    }
    else{
       $resultat=create_produit();
       $msg=($resultat==1)?1:0;
    header('Location:produit_attente.php?msg='.$msg);
      }

}

if(isset($_POST['maj_produit'])){
   
         $resultat=edit_produit($_GET["id"]);
         $msg=($resultat==1)?1:0;
      header('Location:produit_attente.php?msg='.$msg);
        
  
  }
  
