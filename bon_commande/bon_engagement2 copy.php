<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require_once('../configuration/bon_commandeController.php');

$resultats = engagement($_GET['id']);
foreach ($resultats as $donnees) {

    $service = $donnees['nom_service'];
    $date = date('d/m/Y', strtotime($donnees['date_saisie_b']));
    $date_engagement = date('d/m/Y', strtotime($donnees['date_engagement']));
    $annee = $donnees['annee'];
    $id_nature = $donnees['id_nature'];
    $nature = $donnees['libelle_nature'];
    $nom_fournisseur = $donnees['nom_fournisseur'];
    $adresse_fournisseur = $donnees['adresse_fournisseur'];
    $contact_fournisseur = $donnees['contact_fournisseur'];
    $code_cc = $donnees['code_cc'];
    $id_fproforma = $donnees['id_fproforma'];
    $emploi = $donnees['libelle_emploi'];
    $id_emploi = $donnees['id_emploi'];
    $id_ligne_emploi = $donnees['id_ligne_emploi'];
    $compte_emploi = $donnees['compte_emploi'];
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
    $id_besoin=$donnees['id_besoin'];
    $date_etat_b=$donnees['date_etat_b'];
}
?>
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
           
           /* padding-top: 80px;*/
        }

        @page { margin: 100px 25px; }
    header { position: fixed; top: -60px; left: 0px; right: 0px;  height: 50px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px;  height: 50px; }
   

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
            background-color: #FFE699;
            padding: 4px;
        }

        p{
    font-size: 11px; 
    text-align: justify;
      }

        h2 {
            text-align: center;
            font-size: 14px;
            
        }

        h3 {
            font-size: 14px;
            padding: 4px;
            background-color: #F8F9FC;
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
            width: 40%;
            font-size: 14px;
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

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
 <header>
 <div class="gauche">
  <img class="img-fluid" src="../dist/img/logoarsn.png" alt="" height="50px">
  </div>
  <div class="droit1">
  <img class="img-fluid" src="../dist/img/logoarsn.png" alt="" height="50px">
  </div>
 </header>

<div>
        <div class="gauche">
            <h1>FICHE D'ENGAGEMENT POUR BON DE COMMANDE</h1>
            <h2>N<sup>o</sup>FE/ARSN/<?= $annee ?>/<?= $_GET['id'] ?></h2>
        </div>
        <div class="droit1">
            <p>Date: <b><?= $date_engagement ?></b></p>
            <p>Exercice budgetaire: <b> <?= $annee ?></b></p>
        </div>
    </div>
    <div class="container"> 
        <div class="marge">
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
                        <td><?= $nature ?></td>
                        <td><?= $compte_emploi ?></td>
                        <td><?= $emploi ?></td>
                    </tr>
                </tbody>
            </table>
         </div>
        </div>
        <div style="padding-top:10px;">
            <div class="gauche1">
                <h3> INFORMATION SUR LE BENEFICIAIRE</h3>
            </div>


            <div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><b>Tiers</b></td>
                            <td><?= $nom_fournisseur ?></td>
                            <td><b>Adresse</b></td>
                            <td><?= $adresse_fournisseur ?></td>
                        </tr>
                        <tr>
                            <td><b>Numéro du CC / Code</b></td>
                            <td><?= $code_cc ?></td>
                            <td></b>Téléphone<b></td>
                            <td><?= $contact_fournisseur ?></td>
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
                            <td><b>Type de procédure</b></td>
                            <td><?= $code_cc ?></td>
                            <td><b>Référence de la facture</b></td>
                            <td>FACTURE PROFORMA N°'<?= $reference_fproforma ?></td>
                        </tr>
                        <tr>
                            <td><b>Objet de la dépense</b></td>
                            <td colspan="3"><?= $objet ?></td>

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
                    <tbody>
                        <?php
                        $TTC = montant_commande($_GET['id']);
                        $montant_lettre = new NumberFormatter('fr', NumberFormatter::SPELLOUT);
                        $montant_nature = montant_nature_annee($id_nature, $annee);
                        $montant_emploi = montant_emploi_annee($id_emploi, $annee);
                        $montant_anterieur = montant_nature_anterieur($id_nature, $_GET['id'], $annee);
                        $montant_santerieur = montant_emploi_anterieur($id_emploi, $_GET['id'], $annee);
                        $montant_anterieur1=montant_nature_anterieur1($id_nature,$date_etat_b,$annee);
                        $montant_santerieur1=montant_emploi_anterieur1($id_emploi,$date_etat_b,$annee);
                        $produits = produit_commande($_GET['id']);
                        foreach ($produits as $produit) {


                            echo '<tr>
                                        <td>' . $produit['libelle_produit'] . '</td>
                                        <td>' . $produit['quantite'] . '</td>
                                        <td>' . number_format($produit['prix'], 0, ',', ' ') . '</td>
                                        <td>' . number_format($produit['total'], 0, ',', ' ') . '</td>
                                    </tr> ';
                        }

                        
                        ?>

                        <tr>
                            <td colspan="3"><b>Total</b></td>
                            <td colspan="3"><b><?= number_format($TTC, 0, ',', ' ') ?> FCFA</b></td>
                        </tr>

                        </tr>
                    </tbody>
                </table>
                <p> <b><?= $montant_lettre->format($TTC) ?> FRANCS CFA</b></p>
            </div>
        </div>
        <div>
            <div class="gauche1">
                <h3> SITUATION DE LA LIGNE BUDGETAIRE</h3>
            </div>


            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Compte</th>
                            <th>S/Compte <?= $compte_emploi ?></th>

                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td><b>Dotation budgetaire (a)</b></td>
                            <td><b><?= number_format($montant_nature, 0, ',', ' ') ?></b></td>
                            <td><b><?= number_format($montant_emploi, 0, ',', ' ') ?></b></td>

                        </tr>
                        <tr>
                            <td>Engagements antérieurs (b)</td>
                            <td><?= number_format(intval($montant_anterieur+$montant_anterieur1), 0, ',', ' ') ?></td>
                            <td><?= number_format(intval($montant_santerieur+$montant_santerieur1), 0, ',', ' ') ?></td>

                        </tr>
                        <tr>
                            <td>Engagement actuel (c)</td>
                            <td><b><?= number_format($TTC, 0, ',', ' ') ?></b></td>
                            <td><b><?= number_format($TTC, 0, ',', ' ') ?></b></td>

                        </tr>

                        <tr>
                            <td>Engagements total (d=b+c)</td>
                            <td><?= number_format(intval($montant_anterieur + $montant_anterieur1+$TTC), 0, ',', ' ') ?></td>
                            <td><?= number_format(intval($montant_santerieur +$montant_santerieur1+$TTC), 0, ',', ' ') ?></td>

                        </tr>
                        <tr>
                            <td><b>Crédits disponibles (e=a-d)</b></td>
                            <td><b><?= number_format(intval($montant_nature - $montant_anterieur-$montant_anterieur1 - $TTC), 0, ',', ' ') ?></b></td>
                            <td><b><?= number_format(intval($montant_emploi - $montant_santerieur-+$montant_santerieur1 - $TTC), 0, ',', ' ') ?></b></td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>


        <div>

            <table class="signature">
                <thead>
                    <tr>

                        <th>Signature du Directeur des Affaires Administratives Financières</th>
                        <th>Validation de l'Ordonnateur</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table1">
                            <p>Date</p>
                            <p>Signature et Cachet</p>
                        </td>
                        <td class="table1">
                            <p>Date</p>
                            <p>Signature et Cachet</p>
                        </td>

                    </tr>
            </table>

        </div>

    </div>
</body>

</html>