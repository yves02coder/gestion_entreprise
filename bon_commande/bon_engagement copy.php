<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require_once('../configuration/bon_commandeController.php');

require_once("../dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$resultats = engagement($_GET['id']);
foreach ($resultats as $donnees) {

    $service = $donnees['nom_service'];
    $date = date('d/m/Y', strtotime($donnees['date_saisie_b']));
    $date_engagement = date('d/m/Y', strtotime($donnees['date_engagement']));
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
    $montant = number_format($donnees['montant_fp'], 0, '.', ' ');
    $objet = $donnees['objet'];
    $proforma = $donnees['proforma'];
    $date_f = date('d/m/Y', strtotime($donnees['date_fproforma']));
    $type = $donnees['type_engagement'];
    $id_ressource = $donnees['id_ressource'];
    $id_sous_ressource = $donnees['id_sous_ressource'];
    $compte_sressource = $donnees['compte_sressource'];
    $libelle_sressource = $donnees['libelle_sressource'];
    $libelle_ressource = $donnees['libelle_ressource'];
    $date_signature = date('d/m/Y', strtotime($donnees['date_signature_ben']));
    $reference_fproforma = $donnees['reference'];
}



$html = '<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ARSN</title>
 <style>
body{
    font-family: Arial, Helvetica, sans-serif;
    position: relative;
}

footer {position: absolute; bottom: 0;
font-size:10px}

#sign {position: absolute; bottom: 20%;
    text-decoration:underline;
    }
   

    h1{text-align: center;
      font-size: 16px; 
      background-color: #FFE699; 
      padding: 4px;  
    }
    h2{text-align: center;
        font-size: 14px;   
      }
      h3{
        font-size: 14px; 
        padding: 4px;
        background-color: #F8F9FC;   
      }
    .gauche{     
        width: 60%;
        font-size: 12px;
        float:left;
    }
    .droit1{      
        width: 30%;
        font-size: 14px;
        float:right;
    }
    .gauche1{    
        width: 40%;
        font-size: 14px; 
       }
    .drapeau{
        display: flex;
        height: 100vh; 
    }
    .orange{
        height:10px;
        width: 30%;
        background-color:white;      
    }
    .blanc{
        height:10px;
        width: 30%;
        background-color:green; 
           
    }
    .vert{
        height:10px;
        width: 30%;
        background-color:green; 
           
    }
       .marge{
        margin-top:7%;
       }
    hr{
        color: white;
    }

    table{

        border-collapse: collapse;
        width: 100%;
       
    }
    td,th{
        font-size:12px;
        border: 1px solid;
        align-items:left;
    }
    .signature{
        margin:auto;
        padding-top:120px;
        width:600px;
        column-width:auto;

    }
    .table1{
        
       height:140px;
       vertical-align:top; 

    }
  
    #left{
      text-decoration:underline;
      
    }
    #right{
        margin-left:50%;
        text-decoration:underline;    
    }

    
      #right1{
          margin-left:42%;
              
      }
    #carton{
        font-size=10px;
    }
 </style>
</head>
<body>


<div style="padding-top:10px">
<div class="gauche">
<h1 >FICHE D\'ENGAGEMENT POUR BON DE COMMANDE</h1>
<h2>N<sup>o</sup>FE/ARSN/' . $annee . '/' . $_GET['id'] . '</h2>
</div>
<div class="droit1">
<p>Date: <b>' . $date_engagement . '</b></p>
<p>Exercice budgetaire: <b>' . $annee . '</b></p>
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
                                            <td>' . $nature . '</td>
                                            <td>' . $compte_emploi . '</td>
                                            <td>' . $emploi . '</td>
                                        </tr>
                                    </tbody>
                                   </table>
    </div>
    </div>
    <div>
    <div class="gauche1">
   <h3> INFORMATION SUR LE BENEFICIAIRE</h3>
    </div>
    <div>
    <table class="table">
                        <tbody>
                        <tr>
                            <td><b>Tiers</b></td>
                            <td>' . $nom_fournisseur . '</td>
                            <td><b>Adresse</b></td>
                            <td>' . $adresse_fournisseur . '</td>
                        </tr>
                        <tr>
                            <td><b>Numéro du CC / Code</b></td>
                            <td>' . $code_cc . '</td>
                            <td></b>Téléphone<b></td>
                            <td>' . $contact_fournisseur . '</td>
                        </tr>
                    </tbody>
                                                    </table>
    </div>
    </div>
    <div>
    <div class="gauche1">
   <h3> INFORMATION SUR L\'ENGAGEMENT</h3>
    </div>
    <div>
    <table class="table">
                        <tbody>
                        <tr>
                        <td><b>Type de procédure</b></td>
                        <td>' . $type . '</td>
                        <td><b>Référence de la facture</b></td>
                        <td>FACTURE PROFORMA N°' . $reference_fproforma . ' </td>
                    </tr>
                    <tr>
                        <td><b>Objet de la dépense</b></td>
                        <td colspan="3">' . $objet . '</td>
                        
                    </tr>
                    </tbody>
                                   </table>
    </div>
    </div>
    <div>
    <div class="gauche1">
   <h3> INFORMATIONS SUR LA COMMANDE</h3>
    </div>
    <div>
    <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Désignation</th>
                                            <th>Quantité</th>
                                            <th>Prix Unitaire(FCFA)</th>
                                            <th>Prix Total(FCFA)</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

$produits = produit_commande($_GET['id']);
foreach ($produits as $produit) {


    $html .= '<tr>  
                                                <td>' . $produit['libelle_produit'] . '</td>
                                                <td>' . $produit['quantite'] . '</td>
                                                <td>' . number_format($produit['prix'], 0, ',', ' ') . '</td>
                                                <td>' . number_format($produit['total'], 0, ',', ' ') . '</td>
                                                </tr> ';
}

$TTC = montant_commande($_GET['id']);
$montant_lettre = new NumberFormatter('fr', NumberFormatter::SPELLOUT);
$montant_nature=montant_nature_annee($id_nature,$annee);
$montant_emploi=montant_emploi_annee($id_emploi,$annee);
$montant_anterieur=montant_nature_anterieur($id_nature,$_GET['id'],$annee);
$montant_santerieur=montant_emploi_anterieur($id_emploi,$_GET['id'],$annee);


$html .= '
                                                 <tr> <td colspan="3"><b>Total</b></td>
                                                <td colspan="3"><b>' . number_format($TTC, 0, ',', ' ') . ' FCFA</b></td></tr>
                      
                                        </tr>
                                    </tbody>
                                   </table>
                                   <h5> <b>' . $montant_lettre->format($TTC) . ' FRANCS CFA</b></h5>
    </div>
    </div>
    <div>
    <div class="gauche1">
   <h3> SITUATION DE LA LIGNE BUDGETAIRE</h3>
    </div>
    <div class="gauche">
         <table class="table">
         <thead>
                                        <tr>
                                            <th></th>
                                            <th>Compte</th>
                                            <th>S/Compte ' . $compte_emploi . '</th>
                                            
                                        </tr>
                                    </thead>
    <tbody>

    <tr>
    <td><b>Dotation budgetaire (a)</b></td>
    <td><b>' . number_format($montant_nature, 0, ',', ' ') . '</b></td>
    <td><b>' . number_format($montant_emploi, 0, ',', ' ') . '</b></td>
   
</tr>
<tr>
    <td>Engagements antérieurs (b)</td>
    <td>' . number_format($montant_anterieur, 0, ',', ' ') . '</td>
    <td>' . number_format($montant_santerieur, 0, ',', ' ') . '</td>
   
</tr>
<tr>
    <td>Engagement actuel (c)</td>
    <td><b>' . number_format($TTC, 0, ',', ' ') . '</b></td>
    <td><b>' . number_format($TTC, 0, ',', ' ') . '</b></td>
   
</tr>

<tr>
    <td>Engagements total (d=b+c)</td>
    <td>' . number_format(intval($montant_anterieur + $TTC), 0, ',', ' ') . '</td>
    <td>' . number_format(intval($montant_santerieur + $TTC), 0, ',', ' ') . '</td>
    
</tr>
<tr>
<td><b>Crédits disponibles (e=a-d)</b></td>
<td><b>' . number_format(intval($montant_nature - $montant_anterieur - $TTC), 0, ',', ' ') . '</b></td>
<td><b>' . number_format(intval($montant_emploi - $montant_santerieur - $TTC), 0, ',', ' ') . '</b></td>   
</tbody>
</table>

    </div>
           
    </div>
   
    </div>
    </div>
    <div>
    
    <table class="signature" >
    <thead>
    <tr>
        
        <th>Signature du Directeur des Affaires Administratives Financières</th>
        <th>Validation de l\'Ordonnateur</th>
        
    </tr>
</thead>
<tbody>
                        <tr >
                            <td class="table1"><p>Date</p> <p>Signature et Cachet</p></td>
                            <td class="table1"><p>Date</p> <p>Signature et Cachet</p></td>
                           
                        </tr>
    </table>

</div>
</body>
</html>';
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'potrait');

// Render the HTML as PDF
$dompdf->render();
$fichier = "Bon engagement de " . $nom_fournisseur;
// Output the generated PDF to Browser
$dompdf->stream($fichier);
