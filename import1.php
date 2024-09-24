<?php
  // Connect to database
  include("configuration/database.php");
  if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
      
      $file = fopen($fileName, "r");
      
      while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
         $bdd->exec("INSERT INTO clients (nom_client,contact,adresse,localisation,email,interlocuteur,domaine,date_saisie,user_id)
          VALUES('" .htmlspecialchars(addslashes($column[0]))."','".htmlspecialchars(addslashes($column[1]))."','".htmlspecialchars(addslashes($column[2])). "','".htmlspecialchars(addslashes($column[3])). "','".htmlspecialchars(addslashes($column[4])). "','".htmlspecialchars(addslashes($column[5])). "','".htmlspecialchars(addslashes($column[6])). "','".$column[7]. "','".$column[8]. "')");
        
        
        if (! empty($result)) {
          $type = "success";
          $message = "Les Données sont importées dans la base de données";
        } else {
          $type = "error";
          $message = "Problème lors de l'importation de données CSV";
        }
      }
    }
  }
  //Retourner à la page index.php
?>