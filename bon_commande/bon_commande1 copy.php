<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require_once('../configuration/bon_commandeController.php');

require_once("../dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$resultats = bon_commande($_GET['id']);
foreach ($resultats as $donnees) {

    $service = $donnees['nom_service'];
    $date = date('d/m/Y', strtotime($donnees['date_saisie_b']));
    $date_engagement = date('d/m/Y', strtotime($donnees['date_engagement']));
    $date_commande = date('d/m/Y', strtotime($donnees['date_commande']));
    $annee = $donnees['annee'];
    $id_nature=$donnees['id_nature'];
    $nature=$donnees['libelle_nature'];
    $nom_fournisseur = $donnees['nom_fournisseur'];
    $adresse_fournisseur = $donnees['adresse_fournisseur'];
    $contact_fournisseur = $donnees['contact_fournisseur'];
    $code_cc = $donnees['code_cc'];
    $id_fproforma = $donnees['id_fproforma'];
    $emploi = $donnees['libelle_emploi'];
    $id_emploi=$donnees['id_emploi']; 
    $id_ligne_emploi=$donnees['id_ligne_emploi'];
    $compte_emploi=$donnees['compte_emploi'];
    $montant = $donnees['montant_fp'];
    $objet = $donnees['objet'];
    $proforma = $donnees['proforma'];
    $date_f = date('d/m/Y', strtotime($donnees['date_fproforma']));
    $type = $donnees['type_engagement'];
    $date_signature = date('d/m/Y', strtotime($donnees['date_signature_ben']));
    $reference_fproforma = $donnees['reference'];
    $id_engagement=$donnees['engagement_id'];
   

}
?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ARSN</title>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
   
    padding-top: 80px;
}

footer {
    position: absolute;
    bottom: 0;
    font-size: 10px;
}

#sign {
    position: absolute;
    bottom: 20%;
    text-decoration: underline;
}


h1 {
    text-align: center;
    font-size: 16px;
    background-color: #305496;
    padding: 4px;
}

h2 {
    text-align: center;
    font-size: 14px;
    
}

h3 {
    font-size: 12px;
    padding: 4px;
    background-color: #F8F9FC;
}
p{
    font-size: 11px; 
    text-align: justify;
}

.gauche {
    width: 60%;
    font-size: 12px;
    float: left;
}

.droit1 {
    width: 30%;
    font-size: 14px;
    float: right;
}

.gauche1 {
    width: 45%;
    font-size: 12px;
}

.marge {
    margin-top: 10%;
}

hr {
    color: white;
}

table {

    border-collapse: collapse;
    width: 100%;
}

td,
th {
    font-size: 11px;
    border: 1px solid;
    align-items: left;
}

.signature {
    margin: auto;
    padding-top: 20px;
    width: 600px;
    column-width: auto;

}

.table1 {

    height: 140px;
    vertical-align: top;

}

#left {
    text-decoration: underline;

}

#right {
    margin-left: 50%;
    text-decoration: underline;
}


#right1 {
    margin-left: 42%;

}
</style>


</head>
<body>


<div style="padding-top:10px">
<div class="gauche">
<h1 >BON DE COMMANDE</h1>
<h2>N<sup>o</sup>BC/ARSN/<?= $_GET['id'] ?>/<?= strtoupper($nom_fournisseur)?></h2>
</div>
<div class="droit1">
<p>Date: <b> <?=$date_commande ?></b></p>
<p>Exercice budgetaire: <b><?=$annee ?></b></p>
</div>
</div>

<div>
<div div class="marge">
</div>
<div>
    <div class="gauche1">
   <h3> INPUTATION BUDGETAIRE</h3>
    </div>
    <div>
    <table class="table">
                                    <thead>
                                        <tr>
                                            <th>N<sup>o</sup> Compte</th>
                                            <th>Libellé du Compte</th>
                                            <th>N<sup>o</sup>S/Compte</th>
                                            <th>Libellé du S/Compte</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr>
                                            <td></td>
                                            <td><b><?=$nature ?></b></td>
                                            <td><b><?= $compte_emploi?></b></td>
                                            <td><b><?= $emploi?></b></td>
                                        </tr>
                                    </tbody>
                                   </table>
    </div>
    </div>

    <div>
    <div class="gauche1">
   <h3> INFORMATION SUR L'ENGAGEMENT</h3>
    </div>
    <div>
    <table class="table">
                        <tbody>
                        <tr>
                        <td>Type de procédure</td>
                        <td><b><?= $type ?></b></td>
                        <td>Montant à engager</td>
                        <td></b><?= number_format($montant, 0, '.', ' ') ?></b></td>
                    </tr>
                   
                    </tbody>
                                   </table>
                                      
                               <?php    $TTC=montant_commande($id_engagement);
                                                
                                   $montant_lettre= new NumberFormatter('fr',NumberFormatter::SPELLOUT);?>

                                   <p> <b><?=$montant_lettre->format($TTC)?> FRANCS CFA</b></p>
    </div>
    </div>
    <div>
    <div class="gauche1">

   <h3> DETAILS DE LA COMMANDE</h3>
    </div>
    <div>
    <table class="table">
                        <tbody>
                        <tr>
                            <td>Date commande</td>
                            <td><b><?=$date_commande?></b></td>
                            
                        </tr>
                        <tr>
                            <td>Objet de la dépense</td>
                            <td></b><?= $objet ?><b></td>
                        </tr>
                    </tbody>
                    </table>
    </div>
    </div>
    <div>
    <div class="gauche1">
   <h3> REFERENCES DU FOURNISSEUR OU DU BENEFICIAIRE</h3>
    </div>
    <div>
    <table class="table">
                        <tbody>
                        <tr>
                            <td>Numéro du CC / Code</td>
                            <td><b><?= $code_cc?></b></td>
                            <td>Téléphone</td>
                            <td><b><?= $contact_fournisseur?></b></td>
                        </tr>
                        <tr>
                        
                            <td>Tiers</td>
                            <td><b><?= $nom_fournisseur?></b></td>
                            <td>Adresse</td>
                            <td><b><?= $adresse_fournisseur ?></b></td>
                        </tr>
                        
                    </tbody>
                                                    </table>
    </div>
    </div>

    <div>
    <div class="gauche1">
   <h3> LISTE DES PIECES JUSTIFICATIVES </h3>
    </div>
    <div>
    <table class="table">
                        <tbody>
                        <tr>
                        <th> Nature de la pièce</th>
                        <th>Références </th>
                        <th>Date de la pièce </th>
                        <th>Montant </th>
                        </tr>
                        <tr>
                            <td><b>FACTURE PROFORMA</b></td>
                            <td><b><?=$reference_fproforma?></b></td>
                            <td><b><?= $date_f ?></b></td>
                            <td><b><?= number_format($montant, 0, '.', ' ') ?><b></td>
                        </tr>
                       
                    </tbody>
                                                    </table>
    </div>
    </div>
    
 
    <div>
  <p><b>Instruction à suivre pour le règlement</b> <br/>
   Après avoir exécuté ses prestations ou ses obligation et afin d'obtenir son règlement, le créantier ARSN doit expédier
   sa facture ou son décompte accompagné du bordereau d'envoi ci-joint. Ce bordereau doit être completé par l'indicateur
   des modalités souhaitées qui permatteont à l'ARSN d'exécuter le paiement. Il doit être daté et signé.</p> 
   
   
    </div>
    <div>
    
    <table class="signature" >
    <thead>
    <tr>
        
        <th>Signature du Directeur des Affaires Administratives Financières</th>
        <th>Validation de l'Ordonnateur</th>
        
    </tr>
</thead>
<tbody>
                        <tr >
                            <td class="table1"><p>Date:</p> <p>Signature et Cachet</p></td>
                            <td class="table1"><p>Date:</p> <p>Signature et Cachet</p></td>
                           
                        </tr>
    </table>

</div>
</body>
</html>
