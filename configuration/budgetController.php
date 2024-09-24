<?php

require_once('database.php');
require_once('fonctions.php');


if(isset($_POST['creer_rubrique'])){
 $unique=verifier_unicite('rubriques','code_rubrique',$_POST['code']);
    if($unique==1){    
    header('Location:create_rubrique.php?msg=4');
    }
    else{
       $resultat=create_rubrique();
       $msg=($resultat==1)?1:0;
    header('Location:list_rubrique.php?msg='.$msg);
      }

}
if(isset($_POST['creer_srubrique'])){
    $unique=verifier_unicite('sous_rubriques','code_sous_rubrique',$_POST['code']);
       if($unique==1){    
       header('Location:create_sousRubrique.php?msg=4');
       }
       else{
          $resultat=create_srubrique();
          $msg=($resultat==1)?1:0;
       header('Location:list_sousRubrique.php?msg='.$msg);
         }
   }

  
   if(isset($_POST['creer_ligne'])){
    $unique=verifier_ligne('ligne_budgetaire','id_rubrique',$_POST['rubrique'],'annee',$_POST['annee']);
       if($unique==1){    
       header('Location:create_ligne_budgetaire.php?msg=4');
       }
       else{
          $resultat=create_ligne_budget($_SESSION['id']);
          $msg=($resultat==1)?1:0;
       header('Location:list_budget.php?msg='.$msg);
         }
   }


   if(isset($_POST['creer_sligne'])){
   
          $resultat=create_sligne_budget($_SESSION['id']);
          $msg=($resultat==1)?1:0;
       header('Location:list_sous_budget.php?msg='.$msg);
         
   }

   
   if(isset($_POST['valider_ligne'])){
    $valide=update_table('ligne_budgetaire','id_ligne_budget',$_GET['id'],'valide',1,'date_valide',gmdate('Y-m-d'),'validateur',$_SESSION['id']);
       if($valide==1){    
       header('Location:list_budget_valide.php?msg=1');
       }
       else{  
        header('Location:list_budget.php?msg=0');
          }
      
   }

   if(isset($_POST['valider_sligne'])){
    $valide=update_table('sous_ligne_b','id_sous_ligne',$_GET['id'],'valide',1,'date_valide',gmdate('Y-m-d'),'validateur',$_SESSION['id']);
       if($valide==1){    
       header('Location:list_sous_budget_valide.php?msg=1');
       }
       else{  
       header('Location:list_sous_budget.php?msg=1');
         }
   }