<?php
require_once('database.php');
require_once('fonctions.php');




if (isset($_POST['creer_facture'])) {

    if (!empty($_FILES['facture'])) {
        $namefile = $_FILES['facture']['name'];
        $typefile = $_FILES['facture']['type'];
        //  $sizefile= $_FILES['image']['size'];
        $tmpfile = $_FILES['facture']['tmp_name'];
        $errfile = $_FILES['facture']['error'];
        $extensions = ['pdf'];
        $type = ['application/pdf'];
        $extension = explode('.', $namefile);
        // $max_size=5242880;
        if (in_array($typefile, $type)) {
            if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
                if ($errfile == 0) {
                    $facture = uniqid() . '.' . strtolower(end($extension));
                    if (move_uploaded_file($tmpfile, '../documents/bon_facture/' . $facture)) {
                        $requete = create_bon_facture($_GET['id'],$facture,$_SESSION['id']);

                        if($requete == 1){
                            $valider=update_propriete_table('livraisons','id_livraison',$_GET['id'],'etat_livraison',1);
                            header('Location:facture_attente.php?msg=1');
                        }
                        else{
                            header('Location:facture_attente.php?msg=0');  
                        }
                        
                    } else {
                        $msg = 1;
                        header('Location:creer_facture.php?msg=' . $msg);
                    }
                } else {
                    $msg = 1;
                    header('Location:creer_facture.php?msg=' . $msg);
                }
            } else {
                $msg = 2;
                header('Location:creer_facture.php?msg=' . $msg);
            }
        } else {
            $msg = 3;
            header('Location:creer_facture.php?msg=' . $msg);
        }
    }
}

if (isset($_POST['creer_facture_s'])) {

    if (!empty($_FILES['facture'])) {
        $namefile = $_FILES['facture']['name'];
        $typefile = $_FILES['facture']['type'];
        //  $sizefile= $_FILES['image']['size'];
        $tmpfile = $_FILES['facture']['tmp_name'];
        $errfile = $_FILES['facture']['error'];
        $extensions = ['pdf'];
        $type = ['application/pdf'];
        $extension = explode('.', $namefile);
        // $max_size=5242880;
        if (in_array($typefile, $type)) {
            if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
                if ($errfile == 0) {
                    $facture = uniqid() . '.' . strtolower(end($extension));
                    if (move_uploaded_file($tmpfile, '../documents/bon_facture/' . $facture)) {
                        $requete = create_bon_facture_s($_GET['id'],$facture,$_SESSION['id']);

                        if($requete == 1){
                            $valider=update_propriete_table('besoins','id_besoin',$_GET['id'],'etat_besoin',1);
                            header('Location:facture_attente.php?msg=1');
                        }
                        else{
                            header('Location:facture_attente.php?msg=0');  
                        }
                        
                    } else {
                        $msg = 1;
                        header('Location:creer_facture_s.php?msg=' . $msg);
                    }
                } else {
                    $msg = 1;
                    header('Location:creer_facture_s.php?msg=' . $msg);
                }
            } else {
                $msg = 2;
                header('Location:creer_facture_s.php?msg=' . $msg);
            }
        } else {
            $msg = 3;
            header('Location:creer_facture_s.php?msg=' . $msg);
        }
    }
}



   