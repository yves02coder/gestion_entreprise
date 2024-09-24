<?php
require_once('database.php');
require_once('fonctions.php');

/*****************************nature*************/
if(isset($_POST['creer_nature'])){
 $rep=verifier_unicite('natures','code_nature',htmlspecialchars(addslashes($_POST['code'])));
 if($rep!=0){
    header('Location:creer_nature.php?msg=1'); 
 }
 else{
 $resultat=create_nature();
 $msg=($resultat==1)?1:0;
 header('Location:liste_nature.php?msg='.$msg);
}
}

if(isset($_POST['maj_nature'])){
    $rep=verifier_unicite1('natures','code_nature',htmlspecialchars(addslashes($_POST['code'])),'id_nature',$_GET['id']);
    if($rep!=0){
       header('Location:maj_nature.php?msg=1&id='.$_GET['id']); 
    }
    else{
    $resultat=update_nature($_GET['id']);
    $msg=($resultat==1)?2:0;
    header('Location:liste_nature.php?msg='.$msg);
   }
}
/***************************Fin nature */

/*****************************activite*************/
if(isset($_POST['creer_activite'])){
    $rep=verifier_unicite('activites','code_activite',htmlspecialchars(addslashes($_POST['code'])));
    if($rep!=0){
       header('Location:creer_activite.php?msg=1'); 
    }
    else{
    $resultat=create_activite();
    $msg=($resultat==1)?1:0;
    header('Location:liste_activite.php?msg='.$msg);
   }
   }
   
   if(isset($_POST['maj_activite'])){
       $rep=verifier_unicite1('activites','code_activite',htmlspecialchars(addslashes($_POST['code'])),'id_activite',$_GET['id']);
       if($rep!=0){
          header('Location:maj_activite.php?msg=1&id='.$_GET['id']); 
       }
       else{
       $resultat=update_activite($_GET['id']);
       $msg=($resultat==1)?2:0;
       header('Location:liste_activite.php?msg='.$msg);
      }
   }
   /***************************Fin activite */
   /****************Emploi **************/

   if(isset($_POST['creer_emploi'])){
         
            if(isset($_POST['counter'])) {
            
            $nbre_de_ligne=intval($_POST['counter'])+1;
        
        for ($i=0;$i<$nbre_de_ligne;$i++){
            if(isset($_POST['libelle'.$i]) AND !empty($_POST['libelle'.$i])){
                $resultat=create_emploi($_POST['nature'.$i],$_POST['activite'.$i],$_POST['compte'.$i],htmlspecialchars(addslashes($_POST['libelle'.$i])));
                }
        }
        $msg=($resultat==1)?1:0;
        header('Location:liste_emploi.php?msg='.$msg);
        }
            }

    if(isset($_POST['maj_emploi'])){
       $resultat=update_emploi($_GET['id']);
       $msg=($resultat==1)?2:0;
       header('Location:liste_emploi.php?msg='.$msg);
   }


if(isset($_POST['creer_ligne_emploi'])){
         
         if(isset($_POST['counter'])) {
          
         $nbre=intval($_POST['counter'])+1;
       
     for ($y=0;$y<$nbre;$y++){
          if(isset($_POST['montant'.$y]) AND !empty($_POST['montant'.$y])){
             $resultat=create_ligne_emploi($_POST['annee'.$y],$_POST['emploi'.$y],$_POST['service'.$y],$_POST['montant'.$y],$_SESSION['id'],$_POST['ressource'.$y]);
               }
     }
     $msg=($resultat==1)?1:0;
     header('Location:liste_emploi_attente.php?msg='.$msg);
  }
       
}

         if(isset($_POST['maj_ligne_emploi'])){
          
            $resultat=update_ligne_emploi($_GET['id']);
            $msg=($resultat==1)?2:0;
            header('Location:liste_emploi_attente.php?msg='.$msg);
        }

/**************************fin emploi */