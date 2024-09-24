<?php
require_once('database.php');
require_once('fonctions.php');




if (isset($_POST['creer_commande'])) { 

$num_proforma=$_POST['proforma'];
    if (!empty($_FILES['commande'])) {
        $namefile = $_FILES['commande']['name'];
        $typefile = $_FILES['commande']['type'];
        //  $sizefile= $_FILES['image']['size'];
        $tmpfile = $_FILES['commande']['tmp_name'];
        $errfile = $_FILES['commande']['error'];
        $extensions = ['pdf'];
        $type = ['application/pdf'];
        $extension = explode('.', $namefile);
        // $max_size=5242880;
        if (in_array($typefile, $type)) {
            if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
                if ($errfile == 0) {
                    $commande = uniqid() . '.' . strtolower(end($extension));
                    if (move_uploaded_file($tmpfile, '../documents/commande/' . $commande)) {
                        $requete = create_commande($_SESSION['id'], $commande);
                        if($requete == 1){
                            $valider=update_propriete_table('proformas','num_proforma',$num_proforma,'etat_proforma',1);
                            header('Location:commande_attente.php?msg=1');
                        }
                        else{
                            header('Location:commande_attente.php?msg=0');  
                        }
                    }
                 else {
                        $msg = 1;
                        header('Location:creer_commande.php?msg=' . $msg);
                    }
                } else {
                    $msg = 1;
                    header('Location:create_commande.php?msg=' . $msg);
                }
            } else {
                $msg = 2;
                header('Location:create_commande.php?msg=' . $msg);
            }
        } else {
            $msg = 3;
            header('Location:create_commande.php?msg=' . $msg);
        }
    }
}

