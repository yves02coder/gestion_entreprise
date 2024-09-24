<?php
require_once('database.php');
require_once('fonctions.php');


if(isset($_POST['creer_ressource'])){
 $rep=verifier_unicite('ressources','code_ressource',htmlspecialchars(addslashes($_POST['code'])));
 if($rep!=0){
    header('Location:creer_ressource.php?msg=1'); 
 }
 else{
 $resultat=create_ressource();
 $msg=($resultat==1)?1:0;
 header('Location:liste_ressource.php?msg='.$msg);
}
}

if(isset($_POST['maj_ressource'])){
    $rep=verifier_unicite1('ressources','code_ressource',htmlspecialchars(addslashes($_POST['code'])),'id_ressource',$_GET['id']);
    if($rep!=0){
       header('Location:maj_ressource.php?msg=1&id='.$_GET["id"]); 
    }
    else{
    $resultat=update_ressource($_GET['id']);
    $msg=($resultat==1)?2:0;
    header('Location:liste_ressource.php?msg='.$msg);
   }
}

if(isset($_POST['creer_sressource'])){
    $rep=verifier_unicite('sous_ressources','compte_sressource',htmlspecialchars(addslashes($_POST['compte'])));
 if($rep!=0){
    header('Location:creer_sous_ressource.php?msg=1'); 
 }
 else{
    $resultat=create_sressource();
    $msg=($resultat==1)?1:0;
    header('Location:liste_sous_ressource.php?msg='.$msg);
   }
}

   if(isset($_POST['maj_sressource'])){
    $rep=verifier_unicite1('sous_ressources','compte_sressource',htmlspecialchars(addslashes($_POST['compte'])),'id_sous_ressource',$_GET['id']);
    if($rep!=0){
       header('Location:maj_sous_ressource.php?msg=1&id='.$_GET["id"]); 
    }
    else{
    $resultat=update_sressource($_GET['id']);
    $msg=($resultat==1)?2:0;
    header('Location:liste_sous_ressource.php?msg='.$msg);
}}
   


if(isset($_POST['creer_ligne_ressource'])){
         
         if(isset($_POST['counter'])) {
          
         $nbre_de_ligne=intval($_POST['counter'])+1;
       
     for ($i=0;$i<$nbre_de_ligne;$i++){
          if(isset($_POST['montant'.$i]) AND !empty($_POST['montant'.$i])){
             $resultat=create_ligne_ressource($_POST['annee'.$i],$_POST['sressource'.$i],$_POST['montant'.$i],$_SESSION['id']);
               }
     }
     $msg=($resultat==1)?1:0;
     header('Location:liste_ressource_attente.php?msg='.$msg);
  }
         }

         if(isset($_POST['maj_ligne_ressource'])){
          
            $resultat=update_ligne_ressource($_GET['id']);
            $msg=($resultat==1)?2:0;
            header('Location:liste_ressource_attente.php?msg='.$msg);
        }