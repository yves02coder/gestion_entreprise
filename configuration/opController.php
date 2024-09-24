<?php
require_once('database.php');
require_once('fonctions.php');


   if(isset($_POST['creer_op'])){
    $valide=create_op($_GET['id'],$_SESSION['id']);
       if($valide==1){ 
        $valider=update_propriete_table('bon_factures','id_bon_facture',$_GET['id'],'etat_facture',1);
       header('Location:op_attente.php?msg=1');
       }
       else{  
        header('Location:op_attente.php?msg=0');
          }      
   }
   

   if(isset($_POST['payer_op'])){
    $valide=update_propriete_table('ordre_paiement','id_ordre_paiement',$_GET['id'],'etat_op',1);
       if($valide==1){    
       header('Location:op_valide.php?msg=2');
       }
       else{  
        header('Location:op_valide.php?msg=0');
          }      
   }

   