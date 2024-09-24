<?php
require_once('database.php');
require_once('fonctions.php');


   if(isset($_POST['creer_cheque'])){
    $valide=create_cheque($_GET['id'],$_SESSION['id']);
       if($valide==1){
         if(intval($_POST['montant'])==(intval($_POST['montant_paye'])+intval($_POST['montant_cheque']))){
            $valider=update_propriete_table('ordre_paiement','id_ordre_paiement',$_GET['id'],'etat_op',1);
            if($valider==1){
               header('Location:cheque_attente.php?msg=1');
            }
            else{
               header('Location:cheque_attente.php?msg=0');
            }
         } 
        else{
       header('Location:cheque_attente.php?msg=1');
       }
      }
       else{  
        header('Location:cheque_attente.php?msg=0');
          }      
   }

   
if (isset($_POST['creer_retrait_cheque'])) {

   if (!empty($_FILES['cheque'])) {
       $namefile = $_FILES['cheque']['name'];
       $typefile = $_FILES['cheque']['type'];
       //  $sizefile= $_FILES['image']['size'];
       $tmpfile = $_FILES['cheque']['tmp_name'];
       $errfile = $_FILES['cheque']['error'];
       $extensions = ['pdf'];
       $type = ['application/pdf'];
       $extension = explode('.', $namefile);
       // $max_size=5242880;
       if (in_array($typefile, $type)) {
           if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
               if ($errfile == 0) {
                   $cheque = uniqid() . '.' . strtolower(end($extension));
                   if (move_uploaded_file($tmpfile, '../documents/cheque/' . $cheque)) {
                       $requete = retrait_cheque($_GET['id'],$_SESSION['id'],$cheque);

                       if($requete == 1){
                           $valider=update_propriete_table('cheques','id_cheque',$_GET['id'],'etat_cheque',1);
                           header('Location:cheque_retire.php?msg=1');
                       }
                       else{
                           header('Location:cheque_retire.php?msg=0');  
                       }
                       
                   } else {
                       
                       header('Location:retrait_cheque.php?msg=1');
                   }
               } else {
                   
                   header('Location:retrait_cheque.php?msg=1');
               }
           } else {
               
               header('Location:retrait_cheque.php?msg=2');
           }
       } else {
           
           header('Location:retriat_cheque.php?msg=2');
       }
   }
}

   

   
   

   