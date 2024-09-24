<?php
session_start();
include('../configuration/fonctions.php');



if (isset($_POST['id_rubrique'])) {
  $resultat = intval(getpropertyByID('rubriques', 'compte', 'id_rubrique', $_POST['id_rubrique']));
  echo $resultat;
}

if (isset($_POST['annee'])) {
  $output = '<option value="-1" disabled selected>-------Selectionner rubrique-------</option>';
  $resultats = ligne_budget_annee2($_POST['annee']);
  foreach ($resultats as $resultat)
    $output .= '<option value="' . $resultat['id_ligne_budget'] . '">' . $resultat['code_rubrique'] . '| ' . $resultat['libelle_rubrique'] . '</option>';
  echo $output;
}

if (isset($_POST['rubrique'])) {
  $output = '<option value="-1" disabled selected>-------Selectionner s/rubrique-------</option>';
  $id = getpropertyByID('ligne_budgetaire', 'id_rubrique', 'id_ligne_budget', $_POST['rubrique']);
  $resultats = srubrique_non_selectionner($id, $_POST['rubrique']);
  foreach ($resultats as $resultat)
    $output .= '<option value="' . $resultat['id_sous_rubrique'] . '">' . $resultat['code_sous_rubrique'] . '| ' . $resultat['libelle_sous'] . '</option>';
  echo $output;
}

if (isset($_POST['rubrique1'])) {
  
  $montant = getpropertyByID('ligne_budgetaire', 'montant', 'id_ligne_budget', $_POST['rubrique1']);
  $resultats = somme_montant_sous_ligne($_POST['rubrique1']);
  $montant=intval($montant-$resultats);
  echo $montant;
}

if (isset($_POST['anneeb'])) {
  $rubriques = list_budget($_POST['anneeb']);
  $i = 1;
  foreach ($rubriques as $rubrique) {
    echo '<tr>  
                                            <td>' . $i . '</td>
                                            <td>' . $rubrique['compte'] . '</td>
                                            <td>' . $rubrique['code_rubrique'] . '</td>
                                            <td>' . $rubrique['libelle_rubrique'] . '</td>
                                            <td>' . number_format($rubrique['montant'], 2, ',', ' ') . '</td>          
                                            <td class="py-1"> <a href="update.php?id=' . $rubrique['id_ligne_budget'] . '"><button class="btn btn-success btn-sm "><i class=" fa fa-edit "></i></button></a>';
                                            if (($_SESSION['role'] != 'commercial') && ($_SESSION['role'] != 'comptable')) {
                                              echo' <a href="valide.php?id='.$rubrique['id_ligne_budget'].'"><button class="btn btn-success btn-sm "><i class=" fa fa-check "></i> Valider </button></a> ';
                                          }
                                           echo' <button class="btn btn-danger  btn-sm" onclick="confirmer(' . $rubrique['id_ligne_budget'] . ')"><i class="fa fa-trash"></i></button>
                                            </tr>';
    $i++;
  }
}

if (isset($_POST['anneebv'])) {
  $rubriques = list_budget2($_POST['anneeb']);
  $i = 1;
  foreach ($rubriques as $rubrique) {
    echo '<tr>  
                                            <td>' . $i . '</td>
                                            <td>' . $rubrique['compte'] . '</td>
                                            <td>' . $rubrique['code_rubrique'] . '</td>
                                            <td>' . $rubrique['libelle_rubrique'] . '</td>
                                            <td>' . number_format($rubrique['montant'], 2, ',', ' ') . '</td>';
                                            if (($_SESSION['role'] != 'commercial') && ($_SESSION['role'] != 'comptable')) {          
                                              echo' <td class="py-1"> <a href="update.php?id=' . $rubrique['id_ligne_budget'] . '"><button class="btn btn-success btn-sm "><i class=" fa fa-edit "></i></button></a>
                                              <button class="btn btn-danger  btn-sm" onclick="confirmer(' . $rubrique['id_ligne_budget'] . ')"><i class="fa fa-trash"></i></button>';
                                                        
                                          }
                                           echo'  </tr>';
    $i++;
  }
}

if (isset($_POST['anneesb'])) {

  $rubriques = rubrique_budget_byannee($_POST['anneesb']);
  $output = '<option value="-1" disabled selected>-------Selectionner rubrique-------</option>
           <option value="0">Toutes les rubriques</option>';

  foreach ($rubriques as $rubrique) {

    $output .= '<option value="' . $rubrique['id_rubrique'] . '">' . $rubrique['code_rubrique'] . ': ' . $rubrique['libelle_rubrique'] . '</option>';
  }
  echo $output;
}

if (isset($_POST['anneesbv'])) {

  $rubriques = rubrique_budget_byannee2($_POST['anneesb']);
  $output = '<option value="-1" disabled selected>-------Selectionner rubrique-------</option>
           <option value="0">Toutes les rubriques</option>';

  foreach ($rubriques as $rubrique) {

    $output .= '<option value="' . $rubrique['id_rubrique'] . '">' . $rubrique['code_rubrique'] . ': ' . $rubrique['libelle_rubrique'] . '</option>';
  }
  echo $output;
}

if (isset( $_POST['rubriquesb'])){
  $listes="";
  if(($_POST['rubriquesb'])==0){
  $listes= s_list_budget($_POST['annee_rubrique']);
}
else {
  $listes=s_list_budget_par_rubrique($_POST['annee_rubrique'],($_POST['rubriquesb']));

}
$i=1;
foreach($listes as $liste){
  echo '<tr>  
  <td>' . $i . '</td>
  <td>' . $liste['scompte'] . '</td>
  <td>' . $liste['code_sous_rubrique'] . '</td>
  <td>' . $liste['libelle_sous'] . '</td>
  <td>' . number_format($liste['montant'], 2, ',', ' ') . '</td>          
  <td class="py-1"> <a href="update.php?id=' . $liste['id_sous_ligne'] . '"><button class="btn btn-success btn-sm "><i class=" fa fa-edit "></i></button></a>';
  if (($_SESSION['role'] != 'commercial') && ($_SESSION['role'] != 'comptable')) {
                                                echo' <a href="valide.php?id='.$liste['id_sous_ligne'].'"><button class="btn btn-success btn-sm "><i class=" fa fa-check "></i> Valider </button></a> ';
                                            }
 echo' <button class="btn btn-danger  btn-sm" onclick="confirmer(' . $liste['id_sous_ligne'] . ')"><i class="fa fa-trash"></i></button>
  </tr>';
$i++;
}
}


if (isset( $_POST['rubriquesbv'])){
  $listes="";
  if(($_POST['rubriquesbv'])==0){
  $listes= s_list_budget2($_POST['annee_rubriquev']);
}
else {
  $listes=s_list_budget_par_rubrique2($_POST['annee_rubriquev'],($_POST['rubriquesbv']));

}
$i=1;
foreach($listes as $liste){
  echo '<tr>  
  <td>' . $i . '</td>
  <td>' . $liste['scompte'] . '</td>
  <td>' . $liste['code_sous_rubrique'] . '</td>
  <td>' . $liste['libelle_sous'] . '</td>
  <td>' . number_format($liste['montant_b'], 2, ',', ' ') . '</td>';  
  if (($_SESSION['role'] != 'commercial') && ($_SESSION['role'] != 'comptable')) {       
  echo'<td class="py-1"> <a href="update.php?id=' . $liste['id_sous_ligne'] . '"><button class="btn btn-success btn-sm "><i class=" fa fa-edit "></i></button></a>                                             
  <button class="btn btn-danger  btn-sm" onclick="confirmer(' . $liste['id_sous_ligne'] . ')"><i class="fa fa-trash"></i></button>';
}
echo'</tr>';
$i++;
}
}


if (isset( $_POST['rubriqueb'])){
  
  $rubriques=s_list_budget_par_rubrique(date('Y'),($_POST['rubriqueb']));
  $output = '<option value="-1" disabled selected>-------Selectionner rubrique-------</option>';

foreach ($rubriques as $rubrique) {

$output .= '<option value="' . $rubrique['id_sous_ligne'] . '">' . $rubrique['code_sous_rubrique'] . '| ' . $rubrique['libelle_sous'] . '</option>';
}
echo $output;
}

if (isset( $_POST['year'])){
  
  $rubriques=rubrique_non_selectionner($_POST['year']);
  $output = '<option value="-1" disabled selected>-------Selectionner rubrique-------</option>';

foreach ($rubriques as $rubrique) {

$output .= '<option value="' . $rubrique['id_rubrique'] . '">' . $rubrique['code_rubrique'] . '| ' . $rubrique['libelle_rubrique'] . '</option>';
}
echo $output;
}




