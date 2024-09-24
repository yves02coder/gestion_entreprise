<?php
require_once('database.php');
require_once('fonctions.php');

if (isset($_POST['creer_fproforma'])) {

    if(isset($_POST['counter'])) {
   
        $nbre_de_ligne=intval($_POST['counter'])+1;

      for ($i=0;$i<$nbre_de_ligne;$i++){
         if(isset($_FILES['proforma'.$i]) AND !empty($_FILES['proforma'.$i])){
            $namefile = $_FILES['proforma'.$i]['name'];
            $typefile = $_FILES['proforma'.$i]['type'];
            //  $sizefile= $_FILES['image']['size'];
            $tmpfile = $_FILES['proforma'.$i]['tmp_name'];
            $errfile = $_FILES['proforma'.$i]['error'];
            $extensions = ['pdf'];
            $type = ['application/pdf'];
            $extension = explode('.', $namefile);

            if (in_array($typefile, $type)) {
                if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
                    if ($errfile == 0) {
                        $proforma = uniqid() . '.' . strtolower(end($extension));
                        if (move_uploaded_file($tmpfile, '../documents/fproforma/' . $proforma)) {
                            $requete = create_fproforma($_POST['fournisseur'.$i],$_POST['besoin'],$_POST['date_fproforma'.$i],htmlspecialchars(addslashes($_POST['reference'.$i])),
                            $_POST['montant'.$i], $_SESSION['id'], $proforma);
                            if($requete==1 && $i==($nbre_de_ligne-1)){
                                  
                                 header('Location:fproforma_attente.php?msg=1');
                                 }
                            else{
                            header('Location:fproforma_attente.php?msg=0');
                                }
                        }
                         else {
                            
                            header('Location:creer_fproforma.php?msg=1');
                        }
                    }
                     else {
                        
                        header('Location:creer_fproforma.php?msg=1');
                    }
                }
                 else {
                    
                    header('Location:creer_fproforma.php?msg=2');
                }
               }
            else {
                    
                header('Location:creer_fproforma.php?msg=3');
                 }
            }

          } 
        }
    }