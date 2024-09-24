<?php
require_once('database.php');
require_once('fonctions.php');


if(isset($_POST['creer_proforma'])){

    $resultat=create_proforma($_SESSION['id']);

    if($resultat==1){
       $proforma_id=getLastId('proformas');
       if(isset($proforma_id)){
       
       if(isset($_POST['counter'])) {
        
       $nbre_produit=intval($_POST['counter'])+1;
     
   for ($i=0;$i<$nbre_produit;$i++){
        if(isset($_POST['produit'.$i])){
           $resultat2=create_proforma_prdt($proforma_id,$_POST['produit'.$i],$_POST['quantite'.$i],$_POST['prix'.$i]);
            
             }
   }
}
       }
       header('Location:proforma_attente.php?msg=1');
    }

    else{
        header('Location:proforma_attente.php?msg=0');
    }

}


