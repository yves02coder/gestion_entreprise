<?php
require_once('database.php');
require_once('fonctions.php');

if(isset($_POST['connexion'])){
    $resultats=verifier_user();
    if($resultats==0){
        $msg=1;
        header('Location:index.php?msg='.$msg);
    }
    else{
        session_start();
        $_SESSION['connexion']='ok';
        foreach($resultats as $resultat){
          $_SESSION['email']=$resultat['email'];
          $_SESSION['nom']=$resultat['nom'];
          $_SESSION['prenom']=$resultat['prenom'];
          $_SESSION['role']=$resultat['role'];
          $_SESSION['id']=$resultat['id_user']; 
       
        
            ob_start();
       header('Location:connexion/accueil.php');
       ob_end_flush();
          
          
        }
      }
    }



