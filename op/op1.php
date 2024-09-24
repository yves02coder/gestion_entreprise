<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require_once('../configuration/bon_commandeController.php');

require_once("../dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$resultats = op($_GET['id']);
foreach ($resultats as $donnees) {
    $date_op = date('d/m/Y', strtotime($donnees['date_op']));
    $reference = $donnees['reference_facture'];
    $montant = $donnees['montant_facture'];
    $facture = $donnees['facture'];
    $retenue = $donnees['retenue'];
    $bailleur = $donnees['bailleur'];
    $date_facture = date('d/m/Y', strtotime($donnees['date_facture']));
    $reference_facture = $donnees['reference_facture'];
    $montant_facture = $donnees['montant_facture'];
    $nom_fournisseur_n = $donnees['nom_fournisseur_n'];
    $adresse_fournisseur_n = $donnees['adresse_fournisseur_n'];
    $contact_fournisseur_n = $donnees['contact_fournisseur_n'];
    $code_cc_n = $donnees['code_cc_n'];
    $banque_n = $donnees['banque_n'];
    $num_compte_n = $donnees['num_compte_n'];
    $nom_fournisseur_s = $donnees['nom_fournisseur_s'];
    $adresse_fournisseur_s = $donnees['adresse_fournisseur_s'];
    $contact_fournisseur_s = $donnees['contact_fournisseur_s'];
    $code_cc_s = $donnees['code_cc_s'];
    $banque_s = $donnees['banque_s'];
    $num_compte_s = $donnees['num_compte_s'];
    $objet_n = $donnees['objet_n'];
    $objet_s = $donnees['objet_s'];
    $type_engagement = $donnees['type_engagement'];
    $date_engagement = date('d/m/Y', strtotime($donnees['date_engagement']));
    $annee_s = $donnees['annee_s'];
    $annee_n = $donnees['annee_n'];
    $livraison = $donnees['livraison_id'];
    $emploi_n = $donnees['libelle_emploi_n'];
    $nature_n = $donnees['libelle_nature_n'];
    $compte_emploi_n = $donnees['compte_emploi_n'];
    $emploi_s = $donnees['libelle_emploi_s'];
    $nature_s = $donnees['libelle_nature_s'];
    $compte_emploi_s = $donnees['compte_emploi_s'];
    $id_engagement = $donnees['id_engagement'];
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

            /* padding-top: 80px;*/
        }

        @page {
            margin: 100px 25px;
        }

        header {
            position: fixed;
            top: -80px;
            left: 0px;
            right: 0px;
            height: 50px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
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
            
            background-color: #C6E0B4;
            padding: 3px;
        }

        p {
            font-size: 12px;
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


        .gauche_entete {
            width: 60%;
            font-size: 12px;
            float: left;
            padding-left: 5%;

        }

        .droit_entete {
            width: 30%;
            font-size: 14px;
            float: right;

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
            margin-top: 8%;
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
            font-size: 12px;
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
        <div class="gauche_entete">
            <h4>Autorité de Radioprotection, de <br />Surété et Sécurité Nucléaires</h4>
            <div style="padding-left: 10%; padding-top:-18px;">
                <img class="img-fluid" src="../dist/img/logoarsn.png" alt="" height="50px">
            </div>
        </div>
        <div class="droit_entete">
            <h5 style="text-align: center;"> REPUBLIQUE DE COTE D'IVOIRE<br />
                Union - Discipline - Travail</h5>
            <hr / style="width: 20px;  padding-left:60px; color:black; ">
        </div>
    </header>


    <div class="container" style="padding-top: 5%;">
        <div>
            <div class="gauche">
                <h1>ORDRE DE PAIEMENT</h1>
                <h2>N<sup>o</sup>OP/ARSN/<?php if (!empty($livraison)) {
                                                echo $annee_n;
                                            } else {
                                                echo $annee_s;
                                            } ?>/<?= $_GET['id'] ?></h2>
            </div>
            <div class="droit1">
                <p>Date: <b> <?= $date_op ?></b></p>
                <p>Exercice budgetaire: <b><?php if (!empty($livraison)) {
                                                echo $annee_n;
                                            } else {
                                                echo $annee_s;
                                            } ?></b></p>
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
                                <?php
                                if (!empty($livraison)) {

                                    echo '<td></td>
                                            <td><b>' . $nature_n . '</b></td>
                                            <td><b>' . $compte_emploi_n . '</b></td>
                                            <td><b>' . $emploi_n . '</b></td>';
                                } else {
                                    echo '<td></td>
                                            <td><b>' . $nature_s . '</b></td>
                                            <td><b>' . $compte_emploi_s . '</b></td>
                                            <td><b>' . $emploi_s . '</b></td>';
                                }
                                ?>
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
                                <td><b><?= $type_engagement ?></b></td>
                                <td>Numéro de la fiche d'engagement</td>
                                <td><b>FE/ARSN/<?php if (!empty($livraison)) {
                                                    echo $annee_n;
                                                } else {
                                                    echo $annee_s;
                                                } ?>/<?= $id_engagement ?> du <?= $date_engagement ?></b></td>
                            </tr>
                            <tr>
                                <td>Objet de la dépense</td>
                                <td colspan="3"><b><?php if (!empty($livraison)) {
                                                        echo $objet_n;
                                                    } else {
                                                        echo $objet_s;
                                                    } ?></b></td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>

            <div>
                <div class="gauche1">
                    <h3> INFORMATION SUR LE TIERS</h3>
                </div>
                <div>
                    <table class="table">
                        <tbody>
                            <?php if (!empty($livraison)) {
                                echo '
                        <tr>
                            <td>Raison sociale</td>
                            <td><b>' . $nom_fournisseur_n . '</b></td>
                            <td>Adresse</td>
                            <td><b>' . $adresse_fournisseur_n . '</b></td>
                        </tr>
                        <tr>
                            <td>D Bancaire</td>
                            <td><b>' . $banque_n . '</b></td>
                            <td>N<sup>o</sup> de compte</td>
                            <td><b>' . $num_compte_n . '</b></td>
                        </tr>
                        <tr>
                            <td>N<sup>o</sup>CC/Code</td>
                            <td><b>' . $code_cc_n . '</b></td>
                            <td>Téléphone</td>
                            <td><b>' . $contact_fournisseur_n . '</b></td>
                            <td>Mode de règlement</td>
                            <td><b>CHEQUE</b></td>
                        </tr>';
                            } else {
                                echo '
                            <tr>
                                <td>Raison sociale</td>
                                <td><b>' . $nom_fournisseur_s . '</b></td>
                                <td>Adresse</td>
                                <td></b>' . $adresse_fournisseur_s . '</b></td>
                            </tr>
                            <tr>
                                <td>D Bancaire</td>
                                <td><b>' . $banque_s . '</b></td>
                                <td>N<sup>o</sup> de compte</td>
                                <td></b>' . $num_compte_s . '</b></td>
                            </tr>
                            <tr>
                                <td>N<sup>o</sup>CC/Code</td>
                                <td><b>' . $code_cc_s . '</b></td>
                                <td>Téléphone</td>
                                <td></b>' . $contact_fournisseur_s . '</b></td>
                                <td>Mode de règlement</td>
                                <td></b>CHEQUE</b></td>
                            </tr>';
                            }
                            ?>


                        </tbody>
                    </table>

                </div>
            </div>


            <div>
                <div class="gauche1">

                    <h3> FINANCEMENT DE LA DEPENSE</h3>
                </div>
                <div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>ARSN</td>
                                <td><b><?= number_format(intval($montant_facture - $bailleur - $retenue), 0, '.', ' ') ?></b> Francs CFA</td>

                            </tr>
                            <tr>
                                <td>BAILLEUR</td>
                                <td><b><?= number_format($bailleur, 0, '.', ' ') ?></b> Francs CFA</td>
                            </tr>
                            <tr>
                                <td>RETENUE</td>
                                <td><b><?= number_format($retenue, 0, '.', ' ') ?></b> Francs CFA</td>
                            </tr>
                            <tr>
                                <td></b>MONTANT A PAYER</b></td>
                                <td><b><?= number_format($montant_facture, 0, '.', ' ') ?></b> Francs CFA</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <div class="gauche1">
                    <h3> LISTE DES PIECES JUSTIFICATIVES</h3>
                </div>
                <div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Nature de la pièce</td>
                                <td>Reférences</td>
                                <td>Date de la pièce</td>
                                <td>Montant en Francs CFA</td>
                            </tr>

                            <tr>
                                <td><b>FACTURE NORMALISEE<b></td>
                                <td><b><?= $reference_facture ?></b></td>
                                <td><b><?= $date_facture ?><b></td>
                                <td><b><?= number_format($montant_facture, 0, '.', ' ')  ?></b></td>
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
                            <th>Prise en charge</th>
                            <th>Règlement</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table1">
                                <p>Date:</p>
                                <p>Signature et Cachet</p>
                            </td>
                            <td class="table1">
                                <p>Date:</p>
                                <p>Signature et Cachet</p>
                            </td>
                            <td class="table1">
                                <p>Date:</p>
                                <p>Signature et Cachet</p>
                            </td>
                            <td class="table1">
                                <p>Date:</p>
                                <p>Signature et Cachet</p>
                            </td>

                        </tr>
                </table>

            </div>
        </div>
    </div>
</body>

</html>