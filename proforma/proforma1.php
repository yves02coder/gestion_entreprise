<?php
session_start();
if ((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != 'ok')) {
    header('Location:../index.php');
}
require_once('../configuration/proformaController.php');

$resultats = proforma($_GET['id']);
foreach ($resultats as $donnees) {

    $date = date('d/m/Y', strtotime($donnees['date_proforma']));
    $client = $donnees['nom_client'];
    $contact = $donnees['contact'];
    $adresse = $donnees['adresse'];
    $remise = $donnees['remise'];
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


      /*  footer {
            position: absolute;
            bottom: 0;
            font-size: 10px;
        }*/

        #sign {
            position: absolute;
            bottom: 20%;
            text-decoration: underline;
        }


        h1 {
            text-align: center;
            font-size: 16px;
            background-color: #FFE699;
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
            width: 50%;
            font-size: 12px;
            float: left;

        }

        .droit1 {
            width: 40%;
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
            <h4 style="text-align:center"> FACTURE PROFORMA</h4>
        </div>
        <div>
            <div class="gauche">
                <p>
                    N<sup>o</sup>de Facture:<b>FP/ARSN/<?= $_GET['id'] ?></b>
                        <br />
                        <b>Date:<?= $date ?></b>                  
                </p>
                <!--  <h6>N<sup>o</sup>de Facture:FP/ARSN/
                 <br/>
                 Date:</h6>-->
            </div>
            <div class="droit1">
                <p>
                    Client: <b><?= $client ?></b><br/>
                        Contact:<b> <?= $contact ?></b><br/>
                        Adresse: <b><?= $adresse ?></b>
                </p>
            </div>
        </div>

        <div class="container">
            <div class="marge">
            </div>

            <div>
                
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Désignation</th>
                                <th>Quantité</th>
                                <th>P.U(FCFA)</th>
                                <th>P.Total(FCFA)</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                                                $produits = produits_proforma($_GET['id']);
                                                foreach ($produits as $produit) {


                                                    echo '<tr>  
                                                        <td>' . $produit['libelle'] . '</td>
                                                        <td>' . $produit['nombre'] . '</td>
                                                        <td>' . number_format($produit['prix'], 0, ',', ' ').'</td>
                                                        <td>' . number_format($produit['Total'], 0, ',', ' ').'</td>
                                                        </tr>';
                                                }


                                                $TTC = montant_proforma($_GET['id']);

                                                $montant_lettre = new NumberFormatter('fr', NumberFormatter::SPELLOUT);

                                                echo '
                                                <tr> <td colspan="3"><b>Montant Total HT</b></td>
                                                <td colspan="3"><b>' . number_format($TTC, 0, ',', ' ') . ' FCFA</b></td></tr>
                                                <tr> <td colspan="3"><b>Remise</b></td>
                                                <td colspan="3"><b>' . number_format($remise, 0, ',', ' ') . ' FCFA</b></td></tr>
                                                <tr> <td colspan="3"><b>Total HT</b></td>
                                                <td colspan="3"><b>' . number_format(intval($TTC - $remise), 0, ',', ' ') . ' FCFA</b></td></tr>';
                                                ?>
                                                    </tr>
                                                </tbody>
                        

                    </table>
                    <p> Arrêtée la présente facture à la somme de:<br/>
                        <b><?= ucfirst($montant_lettre->format(intval($TTC - $remise))) ?> Francs CFA</b></p>
                </div>
            </div>
            
        </div>
    </div>
    <footer>
       <div>
            <p style="text-align: center; font-size: 8px;"> ARSN (Autorité Nationale de Radioprotection, de Sûreté et Securité Nucléaires)<br/>
                Tel: 27 22 49 74 38 - Adresse: Bonoumin Rond Point Alassane Ouattara, Abidjan, Côte d'Ivoire - info@arsn.ci</p>
            
        </div>
    </footer>
</body>

</html>