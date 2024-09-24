<?php
require_once('database.php');
require_once('fonctions.php');

if(isset($_POST['creer_facture'])){

    $resultat=create_facture($_GET['id'],$_SESSION['id']);

    if($resultat==1){
       $facture_id=getLastId('factures');
       if(isset($facture_id)){
       
       if(isset($_POST['counter'])) {
        
       $nbre_produit=intval($_POST['counter'])+1;
     
   for ($i=0;$i<$nbre_produit;$i++){
        if(isset($_POST['produit'.$i])){
           $resultat2=create_facture_prdt($facture_id,$_POST['produit'.$i],$_POST['quantite'.$i],$_POST['prix'.$i]);
            
             }
   }
   $valider=update_propriete_table('commandes','id_commande',$_GET['id'],'etat_commande',1);
}
       }
       header('Location:facture_attente.php?msg=1');
    }
    else{
        header('Location:facture_attente.php?msg=0');
    }
}


if(isset($_POST['creer_encaissement'])){
    $valide=create_encaisemment($_GET['id']);
       if($valide==1){
         if(intval($_POST['montant_facture'])==(intval($_POST['montant_paye'])+intval($_POST['montant_encaissement']))){
            $valider=update_propriete_table('factures','id_facture',$_GET['id'],'etat_facture',1);
            if($valider==1){
               header('Location:encaissement.php?msg=1');
            }
            else{
               header('Location:encaissement.php?msg=0');
            }
         } 
        else{
       header('Location:encaissement.php?msg=1');
       }
      }
       else{  
        header('Location:encaissement.php?msg=0');
          }      
   }

