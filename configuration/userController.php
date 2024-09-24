<?php
require_once('database.php');
require_once('fonctions.php');


if(isset($_POST['creer_user'])){
 $unique=verifier_unicite('users','email',$_POST['email']);
 if($unique==1){
    
  header('Location:creer_user.php?msg=1');
 }

 else {
  $password=sha1($_POST['email']);
  $resultat=create_user($password);
  $msg=($resultat==1)?1:0;
  header('Location:liste_user.php?msg='.$msg);
}
 
}

if(isset($_POST['maj_user'])){

  $unique=verifier_unicite1('users','email',$_POST['email'],'id_user',$_GET['id']);
  
  if($unique==1){
     
   header('Location:maj_user.php?msg=3');
  }

  $resultat=update_user1($_GET['id']);
  $msg=($resultat==1)?2:0;
 header('Location:liste_user.php?msg='.$msg);

}

if(isset($_POST['maj_info'])){
  $unique=verifier_unicite1('users','email',$_POST['email'],'id_user',$_SESSION['id']);
  
  if($unique==1){
    
   header('Location:profile.php#maj?msg=3');
  }
 
  else {
   $password=sha1($_POST['email']);
   $resultat=update_user($_SESSION['id']);

   if($resultat==1){
    
    $_SESSION['nom']=htmlspecialchars(addslashes($_POST['nom']));
    $_SESSION['prenom']=htmlspecialchars(addslashes($_POST['prenom']));
    $_SESSION['email']=htmlspecialchars(addslashes($_POST['email']));
  header('Location:profile.php?msg=2');
 }
else{
   
   header('Location:profile.php?msg=0');
  }
} 
 }

 if(isset($_POST['maj_pass'])){
  $password=getpropertyByID('users','password','id_user',$_SESSION['id']);
  if ($password!=sha1(htmlspecialchars(addslashes($_POST['Apassword'])))){
    header('Location:profile.php?msg=5');
  }
  else{
    if(htmlspecialchars(addslashes($_POST['Npassword']))!=htmlspecialchars(addslashes($_POST['Cpassword']))){
      header('Location:profile.php?msg=6');
    }
    else{
      update_propriete_table('users','id_user',$_SESSION['id'],'password',sha1(htmlspecialchars(addslashes($_POST['Npassword']))));
      header('Location:profile.php?msg=4');
    }
  }
}
  

?>