<?php
require_once('database.php');
require_once('fonctions.php');
if (isset($_POST['creer_engagement'])) {
    $resultat = create_engagement($_SESSION['id']);
    if ($resultat == 1) {
        $engagement_id = getLastId('engagements');
        if (isset($engagement_id)) {
            if (isset($_POST['counter'])) {
                $nbre_produit = intval($_POST['counter']) + 1;
                for ($i = 0; $i < $nbre_produit; $i++) {
                    if (isset($_POST['produit' . $i])) {
                        $resultat2 = create_produit_commande($engagement_id, htmlspecialchars(addslashes($_POST['produit' . $i])), $_POST['quantite' . $i], $_POST['prix' . $i]);
                    }
                }
            }
        }
        $valider = update_table1('besoins', 'id_besoin', $id_besoin, 'etat_besoin', 1,'date_etat_b',gmdate('Y-m-d h:i:s'));
        header('Location:engagement_attente.php?msg=1');
    } else {
        header('Location:engagement_attente.php?msg=0');
    }
}



if (isset($_POST['update_engagement'])) {

    if (isset($_FILES['bon_engagement']) and !empty($_FILES['bon_engagement'])) {
        $namefile = $_FILES['bon_engagement']['name'];
        $typefile = $_FILES['bon_engagement']['type'];
        //  $sizefile= $_FILES['image']['size'];
        $tmpfile = $_FILES['bon_engagement']['tmp_name'];
        $errfile = $_FILES['bon_engagement']['error'];
        $extensions = ['pdf'];
        $type = ['application/pdf'];
        $extension = explode('.', $namefile);

        if (in_array($typefile, $type)) {
            if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
                if ($errfile == 0) {
                    $bon_engagement = uniqid() . '.' . strtolower(end($extension));
                    if (move_uploaded_file($tmpfile, '../documents/bon_engagement/' . $bon_engagement)) {
                        $requete = update_propriete_table('engagements', 'id_engagement', $_GET['id'], 'engagement', $bon_engagement);
                        if ($requete == 1) {
                            header('Location:engagement_valide.php?msg=2');
                        } else {
                            header('Location:engagement_valide.php?msg=0');
                        }
                    } else {

                        header('Location:update_engagement.php?msg=1');
                    }
                } else {

                    header('Location:update_engagement.php?msg=1');
                }
            } else {

                header('Location:update_engagement.php?msg=2');
            }
        } else {

            header('Location:update_engagement.php?msg=2');
        }
    }
}



if(isset($_POST['maj_engagement'])){
   
    foreach($_POST['tab'] AS $val){
        if(isset($_POST['produit'.$_GET['id'].''.$val])){
        $resultat=update_table('produits_commande','id_produit_commande',$val,'libelle_produit',htmlspecialchars(addslashes($_POST['produit'.$_GET['id'].''.$val])),'quantite',$_POST['quantite'.$_GET['id'].''.$val],'prix',$_POST['prix'.$_GET['id'].''.$val]);
        }
        else{
           $resultat1=delete_element('produits_commande','id_produit_commande',$val);
        }   
    }
    if($resultat==1 || $resultat1==1){
        if (isset($_POST['count'])) {
            $nbre_produit = intval($_POST['count'])+1 ;
            for ($i = 0; $i < $nbre_produit; $i++) {
                if (isset($_POST['produit'. $i])) {
                    $resultat2 = create_produit_commande($_GET['id'], htmlspecialchars(addslashes($_POST['produit' . $i])), $_POST['quantite' . $i], $_POST['prix' . $i]);
                }
            }
            $msg=($resultat2==1) ? 2:0;
            
            header('Location:engagement_attente.php?msg='.$msg);
        }  
    } 
      
   }

if (isset($_POST['creer_bon_commande'])) {

    $resultat = create_bon_commande($_GET['id'], $_SESSION['id']);
    if ($resultat == 1) {
        $valider = update_propriete_table('engagements', 'id_engagement', $_GET['id'], 'etat_engagement', 1);
        $msg = ($valider == 1) ? 1 : 0;
        header('Location:bon_commande_attente.php?msg=' . $msg);
    } else
        header('Location:bon_commande_attente.php?msg=0');
}



if (isset($_POST['maj_bon_commande'])) {


    if (isset($_FILES['bon_commande']) and !empty($_FILES['bon_commande'])) {
        $namefile = $_FILES['bon_commande']['name'];
        $typefile = $_FILES['bon_commande']['type'];
        //  $sizefile= $_FILES['image']['size'];
        $tmpfile = $_FILES['bon_commande']['tmp_name'];
        $errfile = $_FILES['bon_commande']['error'];
        $extensions = ['pdf'];
        $type = ['application/pdf'];
        $extension = explode('.', $namefile);

        if (in_array($typefile, $type)) {
            if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
                if ($errfile == 0) {
                    $bon_commande = uniqid() . '.' . strtolower(end($extension));
                    if (move_uploaded_file($tmpfile, '../documents/bon_commande/' . $bon_commande)) {
                        $requete = update_propriete_table('bon_commandes', 'id_bon_commande', $_GET['id'], 'bon_commande', $bon_commande);
                        if ($requete == 1) {
                            header('Location:bon_commande_valide.php?msg=2');
                        } else {
                            header('Location:bon_commande_valide.php?msg=0');
                        }
                    } else {

                        header('Location:maj_bon_commande.php?msg=1');
                    }
                } else {

                    header('Location:maj_bon_commande.php?msg=1');
                }
            } else {

                header('Location:maj_bon_commande.php?msg=2');
            }
        } else {

            header('Location:maj_bon_commande.php?msg=2');
        }
    }
}

   /*  if(isset($_POST['valider_bon_commande'])){
      $valide=update_table('bon_commandes','id_bon_commande',$_GET['id'],'valide',1,'date_valide',gmdate('Y-m-d'),'validateur',$_SESSION['id']);
         if($valide==1){ 
            $valider=update_propriete_table('engagements','id_engagement',$_GET['id'],'etat_engagement',1);
    
         header('Location:bon_commande_valide.php?msg=1');
         }
         else{  
          header('Location:bon_commande_encours.php?msg=0');
            }      
     }*/
