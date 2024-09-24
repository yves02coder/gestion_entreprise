<?php
require_once('database.php');
require_once('fonctions.php');



if(isset($_POST['creer_fournisseur'])){
  $rep=verifier_unicite('fournisseurs','code_cc',htmlspecialchars(addslashes($_POST['code'])));
if($rep!=0){
  header('Location:creer_fournisseur.php?msg=1'); 
}
else{
  $resultat=create_fournisseur($_SESSION['id']);
  $msg=($resultat==1)?1:0;
  header('Location:fournisseur_attente.php?msg='.$msg);
 }
}

if(isset($_POST['maj_fournisseur'])){
  $rep=verifier_unicite1('fournisseurs','code_cc',htmlspecialchars(addslashes($_POST['code'])),'id_fournisseur',$_GET['id']);
  if($rep!=0){
     header('Location:maj_fournisseur.php?msg=1&id='.$_GET["id"]); 
  }
  else{
  $resultat=maj_fournisseur($_GET['id']);
  $msg=($resultat==1)?2:0;
  header('Location:fournisseur_attente.php?msg='.$msg);
}}





if(isset($_POST['valider_fournisseur'])){
    $valide=update_table('fournisseurs','id_fournisseur',$_GET['id'],'valide',1,'date_valide',gmdate('Y-m-d'),'validateur',$_SESSION['id']);
       if($valide==1){    
       header('Location:list_valide.php?msg=1');
       }
       else{  
        header('Location:list.php?msg=0');
          }
      
   }