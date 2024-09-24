<?php
require_once('database.php');
require_once('fonctions.php');


if(isset($_POST['creer_besoin'])){
         
  if(isset($_POST['counter'])) {
   
  $nbre_de_ligne=intval($_POST['counter'])+1;

for ($i=0;$i<$nbre_de_ligne;$i++){
   if(isset($_POST['objet'.$i]) AND !empty($_POST['objet'.$i])){
      $resultat=create_besoin($_POST['emploi'.$i],$_POST['service'.$i],$_POST['type'.$i],htmlspecialchars(addslashes($_POST['objet'.$i])),$_SESSION['id']);
        }
}
$msg=($resultat==1)?1:0;
header('Location:besoin_attente.php?msg='.$msg);
}
}



if(isset($_POST['maj_besoin'])){
 
  $resultat=edit_besoin($_GET['id']);
  $msg=($resultat==1)?2:0;
  header('Location:besoin_attente.php?msg='.$msg);
 }

