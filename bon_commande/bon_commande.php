<?php

require_once('../configuration/bon_commandeController.php');
require_once("../dompdf/autoload.inc.php");

use Dompdf\Dompdf;

ob_start();

require("bon_commande1.php");

    $content=ob_get_contents();
    ob_get_clean();

  
$dompdf = new Dompdf();
$dompdf->loadHtml($content);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'potrait');

// Render the HTML as PDF
$dompdf->render();
$fichier = "Bon commande de " . $nom_fournisseur;
// Output the generated PDF to Browser
$dompdf->stream($fichier);