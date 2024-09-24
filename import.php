<?php
  // Connect to database
  include("configuration/database.php");
  if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
      
      $file = fopen($fileName, "r");
      
      while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
         $bdd->exec("INSERT INTO fournisseurs (code_cc,nom_fournisseur,adresse_fournisseur,contact_fournisseur,date_saisie_f,initiateur_f,date_valide_f,validateur_f)
          VALUES('" .$column[0]. "','" .htmlspecialchars(addslashes($column[1]))."','".htmlspecialchars(addslashes($column[2]))."','".htmlspecialchars(addslashes($column[3])). "','".$column[4]. "','".$column[5]. "','".$column[6]. "','".$column[7]. "')");
        
        
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