<?php
require_once("database.php");

//************* fonction getTable (obtenir les éléments d'une table) ***************//
function getTable($table)
{
	global $bdd;
	$sql = "SELECT * FROM " . $table;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}


function Alltable($table, $id)
{
	global $bdd;
	$sql = "SELECT * FROM " . $table . " ORDER BY " . $id . " DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
//******************Obtenir le dernier element d'une table */

function getLastId($table)
{
	global $bdd;
	$sql = "SELECT LAST_INSERT_ID() AS id FROM " . $table;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['id'];
}
//******************obtenir les éléments d'une table de façon ordorner */
function getTableOrderByID($table, $id, $ordre)
{
	global $bdd;
	$sql = "SELECT * FROM " . $table . " ORDER BY " . $id . " " . $ordre;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
///*********************Obtenir un element d'une table */
function getElementByID($table, $id_table, $id)
{
	global $bdd;
	$sql = "SELECT * FROM " . $table . " WHERE " . $id_table . "='" . $id . "'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

///*********************Obtenir un element d'une table */
function delete_element($table, $id_table, $id)
{
	global $bdd;
	$sql = "DELETE  FROM " . $table . " WHERE " . $id_table . "='" . $id . "'";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function getpropertyByID($table, $propriete, $id_table, $id)
{
	global $bdd;
	$sql = "SELECT " . $propriete . " FROM " . $table . " WHERE " . $id_table . "='" . $id . "'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats[$propriete];
}

/*************Mise à jour d'un élémnt d'une table  */
function update_propriete_table($table, $id_table, $id, $propriete, $valeur)
{
	global $bdd;
	$sql = "UPDATE " . $table . " 
	    SET " . $propriete . "='" . $valeur . "'
		  WHERE " . $id_table . "='" . $id . "'";

	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function update_table1($table, $id_table, $id, $propriete, $valeur, $propriete1, $valeur1)
{
	global $bdd;
	$sql = "UPDATE " . $table . " 
	    SET " . $propriete . "='" . $valeur . "',
		" . $propriete1 . "='" . $valeur1 . "'
		  WHERE " . $id_table . "='" . $id . "'";

	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}
function update_table($table, $id_table, $id, $propriete, $valeur, $propriete1, $valeur1, $propriete2, $valeur2)
{
	global $bdd;
	$sql = "UPDATE " . $table . " 
	    SET " . $propriete . "='" . $valeur . "',
		" . $propriete1 . "='" . $valeur1 . "',
		" . $propriete2 . "='" . $valeur2 . "'
		  WHERE " . $id_table . "='" . $id . "'";

	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}
/******************Verifié l'unicité d'un élément dans une table */
function verifier_unicite($table, $id_table, $id)
{
	global $bdd;
	$sql = "SELECT count(" . $id_table . ") as nombre 
	 FROM " . $table . " WHERE " . $id_table . "='" . $id . "'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['nombre'];
}

function verifier_unicite1($table, $propriete, $valeur, $id_table, $id)
{
	global $bdd;
	$sql = "SELECT count(" . $propriete . ") as nombre 
	 FROM " . $table . " WHERE " . $propriete . "='" . $valeur . "' AND ". $id_table . "!='" . $id . "'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['nombre'];
}

/*******  fin*/

/************Gestion de user */

function create_user($password)
{
	$nom = htmlspecialchars(addslashes($_POST['nom']));
	$prenom = htmlspecialchars(addslashes($_POST['prenom']));
	$email = htmlspecialchars(addslashes($_POST['email']));
	$role = $_POST['role'];

	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO users (nom,prenom,email,password,role,deleted_at)
    VALUES('" . $nom . "','" . $prenom . "','" . $email . "','" . $password . "','" . $role . "','0')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}
//** */
function verifier_user()
{
	$email = htmlspecialchars(addslashes($_POST['email']));
	$mot_passe = sha1(htmlspecialchars(addslashes($_POST['password'])));
	global $bdd;
	$sql = "SELECT * FROM users 
	      WHERE email='" . $email . "' AND password='" . $mot_passe . "' LIMIT 1";
	$requete = $bdd->query($sql);
	if ($requete->rowCount() == 0) {
		return 0;
	} else {
		$resultats = $requete->fetchAll();
		return $resultats;
	}
}


//*** */
function list_user()
{
	global $bdd;
	$sql = "SELECT * FROM users 
	      WHERE deleted_at=0";
	$requete = $bdd->query($sql);
	$resultat = $requete->fetchAll();
	return $resultat;
}


/*function users($id){
    global $bdd;
	$sql="SELECT * FROM users 
	      WHERE role !='super_admin' AND id_user!='".$id."'";
	$requete=$bdd->query($sql);
    $resultat=$requete->fetchAll();
    return $resultat;    

}*/

//*** */
function update_user($id_user)
{
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];

	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "UPDATE users
    SET nom='" . $nom . "',
        prenom='" . $prenom . "',
        email='" . $email . "'
    WHERE id_user='" . $id_user . "'";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function update_user1($id_user)
{
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$role = $_POST['role'];
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "UPDATE users
    SET nom='" . $nom . "',
        prenom='" . $prenom . "',
        email='" . $email . "',
		role='" . $role . "'
    WHERE id_user='" . $id_user . "'";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

//** */
function update_password($id_user, $password)
{

	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "UPDATE users
    SET 
        password='" . $password . "'
    WHERE id_user='" . $id_user . "'";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function unicite_mail($id, $mail)
{
	global $bdd;
	$sql = "SELECT count('id_user') as nombre 
	 FROM users WHERE id_user !='" . $id . "' AND email='" . $mail . "'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['nombre'];
}

/************Fin de gestion de user */

/*************Gestion ressource ********/

function create_ressource(){
	$code=htmlspecialchars(addslashes($_POST['code']));
	$libelle = htmlspecialchars(addslashes($_POST['libelle']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="INSERT INTO ressources (code_ressource,libelle_ressource)
	VALUES('".$code."','" .$libelle."')";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}
function update_ressource($id){
	$code=htmlspecialchars(addslashes($_POST['code']));
	$libelle = htmlspecialchars(addslashes($_POST['libelle']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="UPDATE ressources
	SET
	code_ressource='" . $code . "',
	libelle_ressource='" . $libelle . "'
    WHERE id_ressource='" . $id . "'";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function montant_ressource_annee($id,$annee){
	global $bdd;
	$sql = "SELECT SUM(montant) as montant_ressource FROM ligne_ressource l
	INNER JOIN sous_ressources s ON s.id_sous_ressource=l.sressource_id
	INNER JOIN ressources r ON r.id_ressource=s.ressource_id 
	WHERE r.id_ressource='".$id."' AND l.annee='".$annee."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['montant_ressource'];
}

function montant_ressource_anterieur($id,$id_engagement,$annee){
	global $bdd;
	$sql = "SELECT SUM(p.montant_fp) as montant_ressource FROM engagements e
	INNER JOIN fproformas p ON p.id_fproforma=e.proforma_id
	INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	INNER JOIN ligne_ressource lr ON lr.id_ligne_ressource=l.ressource_id
	INNER JOIN sous_ressources s ON s.id_sous_ressource=lr.sressource_id
	INNER JOIN ressources r ON r.id_ressource=s.ressource_id 
	WHERE e.id_engagement<'".$id_engagement."' AND r.id_ressource='".$id."'  AND l.annee='".$annee."'" ;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['montant_ressource'];
}




function create_sressource(){
	
	$compte = htmlspecialchars(addslashes($_POST['compte']));
	$libelle = htmlspecialchars(addslashes($_POST['libelle']));
	$ressource = htmlspecialchars(addslashes($_POST['ressource']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="INSERT INTO sous_ressources (compte_sressource,libelle_sressource,ressource_id)
	VALUES('".$compte."','" .$libelle."','".$ressource."')";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function update_sressource($id){
	$compte = htmlspecialchars(addslashes($_POST['compte']));
	$libelle = htmlspecialchars(addslashes($_POST['libelle']));
	$ressource = htmlspecialchars(addslashes($_POST['ressource']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="UPDATE sous_ressources
	SET
	compte_sressource='" . $compte . "',
	libelle_sressource='" . $libelle . "',
	ressource_id='" . $ressource . "'
    WHERE id_sous_ressource='" . $id . "'";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function montant_sressource_annee($id,$annee){
	global $bdd;
	$sql = "SELECT SUM(montant) as montant_sressource FROM ligne_ressource l
	INNER JOIN sous_ressources s ON s.id_sous_ressource=l.sressource_id
	 
	WHERE s.id_sous_ressource='".$id."' AND l.annee='".$annee."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['montant_sressource'];
}

function montant_sressource_anterieur($id,$id_engagement,$annee){
	global $bdd;
	$sql = "SELECT SUM(p.montant_fp) as montant_ressource FROM engagements e
	INNER JOIN fproformas p ON p.id_fproforma=e.proforma_id
	INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	INNER JOIN ligne_ressource lr ON lr.id_ligne_ressource=l.ressource_id
	INNER JOIN sous_ressources s ON s.id_sous_ressource=lr.sressource_id
	WHERE e.id_engagement<'".$id_engagement."' AND s.id_sous_ressource='".$id."' AND l.annee='".$annee."'" ;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['montant_ressource'];
}

function liste_sressource()
{
	global $bdd;
	$sql = "SELECT * FROM sous_ressources s
	INNER JOIN ressources r ON r.id_ressource=s.ressource_id";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function create_ligne_ressource($annee,$sressource,$montant,$user){
    global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="INSERT INTO ligne_ressource (annee,sressource_id,montant,initiateur_lr,date_saisie_lr)
	VALUES('".$annee."','" .$sressource."','".$montant."','".$user."','".gmdate('Y-m-d')."')";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function update_ligne_ressource($id){
	$annee = htmlspecialchars(addslashes($_POST['annee']));
	$sressource = htmlspecialchars(addslashes($_POST['sressource']));
	$montant = htmlspecialchars(addslashes($_POST['montant']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="UPDATE ligne_ressource
	SET
	annee='" . $annee . "',
	sressource_id='" . $sressource . "',
	montant='" . $montant . "'
    WHERE id_ligne_ressource='" . $id . "'";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}


function liste_ressource_attente()
{
	global $bdd;
	$sql = "SELECT * FROM ligne_ressource l
	INNER JOIN sous_ressources s ON s.id_sous_ressource=l.sressource_id
	INNER JOIN ressources r ON r.id_ressource=s.ressource_id
	WHERE l.validateur_lr IS NULL";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function liste_ressource_valide()
{
	global $bdd;
	$sql = "SELECT * FROM ligne_ressource l
	INNER JOIN sous_ressources s ON s.id_sous_ressource=l.sressource_id
	INNER JOIN ressources r ON r.id_ressource=s.ressource_id
	WHERE l.validateur_lr IS NOT NULL";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
function liste_ressource_annee($annee)
{
	global $bdd;
	$sql = "SELECT * FROM ligne_ressource l
	INNER JOIN sous_ressources s ON s.id_sous_ressource=l.sressource_id
	INNER JOIN ressources r ON r.id_ressource=s.ressource_id
	WHERE l.validateur_lr IS NOT NULL AND l.annee='".$annee."' ORDER BY s.compte_sressource ASC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

/************Fin de gestionressource */


/*************Gestion emploi ********/

function create_nature(){
	$code=htmlspecialchars(addslashes($_POST['code']));
	$libelle = htmlspecialchars(addslashes($_POST['libelle']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="INSERT INTO natures (code_nature,libelle_nature)
	VALUES('".$code."','" .$libelle."')";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}
function update_nature($id){
	$code=htmlspecialchars(addslashes($_POST['code']));
	$libelle = htmlspecialchars(addslashes($_POST['libelle']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="UPDATE natures
	SET
	code_nature='" . $code . "',
	libelle_nature='" . $libelle . "'
    WHERE id_nature='" . $id . "'";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function create_activite(){
	$code=htmlspecialchars(addslashes($_POST['code']));
	$libelle = htmlspecialchars(addslashes($_POST['libelle']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="INSERT INTO activites (code_activite,libelle_activite)
	VALUES('".$code."','" .$libelle."')";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}
function update_activite($id){
	$code=htmlspecialchars(addslashes($_POST['code']));
	$libelle = htmlspecialchars(addslashes($_POST['libelle']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="UPDATE activites
	SET
	code_activite='" . $code . "',
	libelle_activite='" . $libelle . "'
    WHERE id_activite='" . $id . "'";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}


function create_emploi($nature,$activite,$compte,$libelle){
    global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="INSERT INTO emplois (nature_id,activite_id,compte_emploi,libelle_emploi)
	VALUES('".$nature."','" .$activite."','".$compte."','" .$libelle."')";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function update_emploi($id){
	$nature = htmlspecialchars(addslashes($_POST['nature']));
	$activite = htmlspecialchars(addslashes($_POST['activite']));
	$compte = htmlspecialchars(addslashes($_POST['compte']));
	$libelle = htmlspecialchars(addslashes($_POST['libelle']));
	
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="UPDATE emplois
	SET
	nature_id='" . $nature . "',
	activite_id='" . $activite . "',
	compte_emploi='" . $compte . "',
	libelle_emploi='" . $libelle . "'
    WHERE id_emploi='" . $id . "'";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}


function liste_emploi()
{
	global $bdd;
	$sql = "SELECT * FROM emplois e
	INNER JOIN natures n ON n.id_nature=e.nature_id
	INNER JOIN activites a ON a.id_activite=e.activite_id";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function create_ligne_emploi($annee,$emploi,$service,$montant,$user,$ressource){
    global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="INSERT INTO ligne_emploi (annee,emploi_id,service_id,montant_le,initiateur_le,date_saisie_le,ressource_id)
	VALUES('".$annee."','" .$emploi."','".$service."','".$montant."','".$user."','".gmdate('Y-m-d')."','".$ressource."')";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function update_ligne_emploi($id){
	$annee = htmlspecialchars(addslashes($_POST['annee']));
	$emploi = htmlspecialchars(addslashes($_POST['emploi']));
	$service = htmlspecialchars(addslashes($_POST['service']));
	$montant = htmlspecialchars(addslashes($_POST['montant']));
	$ressource = htmlspecialchars(addslashes($_POST['ressource']));
	
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="UPDATE ligne_emploi
	SET
	annee='" . $annee . "',
	emploi_id='" . $emploi . "',
	service_id='" . $service . "',
	montant_le='" . $montant . "',
	ressource_id='" . $ressource . "'
    WHERE id_ligne_emploi='" . $id . "'";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function liste_emploi_attente()
{
	global $bdd;
	$sql = "SELECT * FROM ligne_emploi l
	INNER JOIN emplois e ON e.id_emploi=l.emploi_id
	INNER JOIN activites a ON a.id_activite=e.activite_id
	INNER JOIN natures n ON n.id_nature=e.nature_id
	INNER JOIN services s ON s.id_service=l.service_id
	INNER JOIN ligne_ressource lr ON lr.id_ligne_ressource=l.ressource_id
	INNER JOIN sous_ressources sr ON sr.id_sous_ressource=lr.sressource_id
	INNER JOIN users u ON u.id_user=l.initiateur_le
	
	WHERE l.validateur_le IS NULL";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function liste_emploi_valide()
{
	global $bdd;
	$sql = "SELECT * FROM ligne_emploi l
	INNER JOIN emplois e ON e.id_emploi=l.emploi_id
	INNER JOIN activites a ON a.id_activite=e.activite_id
	INNER JOIN natures n ON n.id_nature=e.nature_id
	INNER JOIN services s ON s.id_service=l.service_id
	INNER JOIN ligne_ressource lr ON lr.id_ligne_ressource=l.ressource_id
	INNER JOIN sous_ressources sr ON sr.id_sous_ressource=lr.sressource_id
	INNER JOIN users u ON u.id_user=l.initiateur_le
	INNER JOIN users d ON d.id_user=l.validateur_le
	WHERE l.validateur_le IS NOT NULL";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function liste_emploi_service($service)
{
	global $bdd;
	$sql = "SELECT * FROM ligne_emploi l
	INNER JOIN emplois e ON e.id_emploi=l.emploi_id
	INNER JOIN activites a ON a.id_activite=e.activite_id
	INNER JOIN natures n ON n.id_nature=e.nature_id
	INNER JOIN services s ON s.id_service=l.service_id
	INNER JOIN users u ON u.id_user=l.initiateur_le
	INNER JOIN users d ON d.id_user=l.validateur_le
	WHERE l.validateur_le IS NOT NULL AND l.service_id='".$service."' AND l.annee=".gmdate('Y');
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
function liste_emploi_annee($annee)
{
	global $bdd;
	$sql = "SELECT * FROM ligne_emploi l
	INNER JOIN emplois e ON e.id_emploi=l.emploi_id
	INNER JOIN activites a ON a.id_activite=e.activite_id
	INNER JOIN natures n ON n.id_nature=e.nature_id
	INNER JOIN services s ON s.id_service=l.service_id
	INNER JOIN users u ON u.id_user=l.initiateur_le
	INNER JOIN users d ON d.id_user=l.validateur_le
	WHERE l.validateur_le IS NOT NULL AND l.annee=".$annee;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}




function montant_nature_annee($id,$annee){
	global $bdd;
	$sql = "SELECT SUM(montant_le) as montant_nature FROM ligne_emploi l
	INNER JOIN emplois e ON e.id_emploi=l.emploi_id
	INNER JOIN natures n ON n.id_nature=e.nature_id
	WHERE n.id_nature='".$id."' AND l.annee='".$annee."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['montant_nature'];
}

function montant_nature_anterieur($id,$id_engagement,$annee){
	global $bdd;
	$sql = "SELECT SUM(p.montant_fp) as montant_nature FROM engagements e
	INNER JOIN fproformas p ON p.id_fproforma=e.proforma_id
	INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	INNER JOIN emplois em ON em.id_emploi=l.emploi_id
	INNER JOIN natures n ON n.id_nature=em.nature_id
	WHERE e.id_engagement<'".$id_engagement."' AND n.id_nature='".$id."'  AND l.annee='".$annee."'" ;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['montant_nature']; 
}

function montant_nature_anterieur1($id_nature,$date_etat_b,$annee){
	global $bdd;
	$sql = "SELECT SUM(f.montant_facture) as montant_facture FROM bon_factures f
	INNER JOIN besoins b ON b.id_besoin=f.besoin_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	INNER JOIN emplois em ON em.id_emploi=l.emploi_id
	INNER JOIN natures n ON n.id_nature=em.nature_id
	WHERE b.date_etat_b<'".$date_etat_b."' AND b.type_procedure=2 AND n.id_nature='".$id_nature."'  AND l.annee='".$annee."'" ;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['montant_facture']; 
}


function montant_emploi_annee($id,$annee){
	global $bdd;
	$sql = "SELECT SUM(montant_le) as montant_emploi FROM ligne_emploi l
	INNER JOIN emplois e ON e.id_emploi=l.emploi_id
	
	WHERE e.id_emploi='".$id."' AND l.annee='".$annee."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['montant_emploi'];
}

function montant_emploi_anterieur($id_emploi,$id_engagement,$annee){
	global $bdd;
	$sql = "SELECT SUM(p.montant_fp) as montant_emploi FROM engagements e
	INNER JOIN fproformas p ON p.id_fproforma=e.proforma_id
	INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	INNER JOIN emplois em ON em.id_emploi=l.emploi_id
	
	WHERE e.id_engagement<'".$id_engagement."' AND em.id_emploi='".$id_emploi."'  AND l.annee='".$annee."'" ;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['montant_emploi'];
}

function montant_emploi_anterieur1($id_emploi,$date_etat_b,$annee){
	global $bdd;
	$sql = "SELECT SUM(f.montant_facture) as montant_facture FROM bon_factures f
	INNER JOIN besoins b ON b.id_besoin=f.besoin_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	INNER JOIN emplois em ON em.id_emploi=l.emploi_id
	
	WHERE b.date_etat_b<'".$date_etat_b."' AND b.type_procedure=2 AND em.id_emploi='".$id_emploi."'  AND l.annee='".$annee."'" ;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['montant_facture']; 
}
/************Fin de gestionressource */

/************Gestion service******* */
function create_service(){
	$service = htmlspecialchars(addslashes($_POST['service']));
	
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="INSERT INTO services (nom_service)
	VALUES('".$service."')";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function update_service($id){
	$service = htmlspecialchars(addslashes($_POST['service']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql="UPDATE services
	SET
	nom_service='" . $service . "'
    WHERE id_service='" . $id . "'";
	$requete= $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}
/**************Fin de gestion service */

/*************Gestion produit ********/

function create_produit()
{
	$code_produit = htmlspecialchars(addslashes($_POST['code']));
	$libelle = htmlspecialchars(addslashes($_POST['libelle']));
	$prix = $_POST['prix'];
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO produits (code_produit,libelle,prix,date_saisie_pr,initiateur_pr)
    VALUES('" . $code_produit . "','" . $libelle . "','" . $prix . "','" . gmdate('Y-m-d') . "','" . $_SESSION['id'] . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function edit_produit($id)
{
	$code_produit = htmlspecialchars(addslashes($_POST['code']));
	$libelle = htmlspecialchars(addslashes($_POST['libelle']));
	$prix = $_POST['prix'];
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "UPDATE produits
	SET code_produit='" . $code_produit . "',
	    libelle = '" . $libelle . "',
		prix = '" . $prix . "'
		WHERE id_produit='" . $id . "'";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}



function produit_attente()
{
	global $bdd;
	$sql = "SELECT *  FROM produits p 
	
	WHERE p.validateur_pr IS NULL ORDER BY p.id_produit DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function produit_valide()
{
	global $bdd;
	$sql = "SELECT *  FROM produits p	 
	
	WHERE p.validateur_pr IS NOT NULL  ORDER BY p.id_produit DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}


/*************Fin gestion produit */

/*************Gestion Client ********/

function create_client($id_user)
{
	$nom_client = htmlspecialchars(addslashes($_POST['nom']));
	$contact = htmlspecialchars(addslashes($_POST['contact']));
	$adresse = htmlspecialchars(addslashes($_POST['adresse']));
	$localisation = htmlspecialchars(addslashes($_POST['localisation']));
	$email = htmlspecialchars(addslashes($_POST['email']));
	$interlocuteur = htmlspecialchars(addslashes($_POST['interlocuteur']));
	$domaine = htmlspecialchars(addslashes($_POST['domaine']));

	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO clients (nom_client,contact,adresse,localisation,email,interlocuteur,domaine,date_saisie,user_id)
    VALUES('" . $nom_client . "','" . $contact . "','" . $adresse . "','" . $localisation . "','" . $email . "','" . $interlocuteur . "','" . $domaine . "','" . gmdate('Y-m-d') . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function edit_client($id)
{
	$nom_client = htmlspecialchars(addslashes($_POST['nom']));
	$contact = htmlspecialchars(addslashes($_POST['contact']));
	$email = htmlspecialchars(addslashes($_POST['email']));
	$adresse = htmlspecialchars(addslashes($_POST['adresse']));

	$interlocuteur = htmlspecialchars(addslashes($_POST['interlocuteur']));
	$domaine = htmlspecialchars(addslashes($_POST['domaine']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "UPDATE clients
	SET nom_client='" . $nom_client . "',
	    contact = '" . $contact . "',
		adresse = '" . $adresse . "',
		
		email = '" . $email . "',
		interlocuteur = '" . $interlocuteur . "',
		domaine = '" . $domaine . "',
		WHERE id_client='" . $id . "'";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function liste_prospect()
{
	global $bdd;
	$sql = "SELECT * FROM clients 
	    WHERE id_client NOT IN (SELECT id_client FROM proformas)
		ORDER BY id_client DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function liste_client()
{
	global $bdd;
	$sql = "SELECT * FROM clients 
	    WHERE id_client IN (SELECT id_client FROM proformas) 
		ORDER BY id_client DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}


function afficher_client($id_proforma){
	global $bdd;
	$sql="SELECT nom_client FROM proformas p
	INNER JOIN clients c ON c.id_client=p.id_client
	WHERE p.num_proforma=".$id_proforma;
	$requete=$bdd->query($sql);
	$resultat=$requete->fetch();
	return $resultat['nom_client'];
}
/*************Fin gestion client */



/*************Gestion proforma ********/
function create_proforma($id_user)
{
	$id_client = htmlspecialchars(addslashes($_POST['client']));
	$remise = htmlspecialchars(addslashes($_POST['remise']));

	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO proformas (id_client,date_proforma,remise,initiateur_pro)
    VALUES('" . $id_client . "','" . gmdate('Y-m-d') . "','" . $remise . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function proforma($id)
{
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "SELECT *
	FROM proformas p
	     INNER JOIN clients c ON  c.id_client=p.id_client 
		 INNER JOIN users u ON  u.id_user=p.initiateur_pro
	    WHERE p.num_proforma=".$id;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}



function create_proforma_prdt($id_proforma, $id_produit, $nombre, $prix)
{

	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO proforma_produit (proforma_id,produit_id,nombre,prix)
    VALUES('" . $id_proforma . "','" . $id_produit . "','" . $nombre . "','" . $prix . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function proforma_attente()
{
	global $bdd;
	$sql = "SELECT *
	FROM proformas p
	     INNER JOIN clients c ON  c.id_client=p.id_client 
		 INNER JOIN users u ON  u.id_user=p.initiateur_pro
		
	    WHERE p.validateur_pro IS NULL 
		ORDER BY num_proforma DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
function proforma_valide()
{
	global $bdd;
	$sql = "SELECT *
	FROM proformas p
	     INNER JOIN clients c ON  c.id_client=p.id_client 
		 INNER JOIN users u ON  u.id_user=p.initiateur_pro
		
	    WHERE p.validateur_pro IS NOT NULL AND p.etat_proforma=0
		ORDER BY num_proforma DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function proforma_traite()
{
	global $bdd;
	$sql = "SELECT *
	FROM proformas p
	     INNER JOIN clients c ON  c.id_client=p.id_client 
		 INNER JOIN users u ON  u.id_user=p.initiateur_pro
		 
	    WHERE p.etat_proforma=1 
		ORDER BY num_proforma DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}




/* function produits_proforma($id){
	global $bdd;
	$sql="SELECT pp.produit_id,p.code_produit, p.libelle, pp.nombre, pp.prix  
	  FROM proforma_produit pp
	  INNER JOIN produits p ON p.id_produit=pp.produit_id  
		 WHERE proforma_id=".$id;
	$requete = $bdd->query($sql);
	$resultats=$requete->fetchAll();
	return $resultats;
  }*/

function produits_proforma($id)
{
	global $bdd;
	$sql = "SELECT pp.produit_id,p.code_produit, p.libelle, pp.nombre, pp.prix, (pp.nombre*pp.prix)as Total 
	  FROM proforma_produit pp
	  INNER JOIN produits p ON p.id_produit=pp.produit_id  
		 WHERE proforma_id=" . $id;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}


function encours($id)
{
	global $bdd;
	$sql = "SELECT p.num_proforma, p.date_facture, p.remise, c.nom_client, c.contact, u.nom,c.adresse,
	 pp.produit_id,p.remise,pr.code_produit, pr.libelle, pp.nombre, pp.prix, (pp.nombre*pp.prix)as total 
	 
	FROM proforma_produit pp 
	     INNER JOIN produits pr ON pr.id_produit=pp.produit_id  
	     INNER JOIN proformas p ON  p.num_proforma=pp.proforma_id
	     INNER JOIN clients c ON  p.id_client=c.id_client 
		 INNER JOIN users u ON  p.initiateur=u.id_user
	    WHERE pp.proforma_id=" . $id;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function montant_proforma($id)
{
	global $bdd;
	$sql = "SELECT SUM(pp.nombre*pp.prix) as Total 
	  FROM proforma_produit pp
	  INNER JOIN produits p ON p.id_produit=pp.produit_id  
		 WHERE proforma_id=" . $id;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['Total'];
}

/*************Fin gestion proforma */

/*************Gestion commande ********/
function create_commande($id_user, $commande)
{
	$proforma = htmlspecialchars(addslashes($_POST['proforma']));
	$montant = htmlspecialchars(addslashes($_POST['montant']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO commandes (proforma_id,date_commande,initiateur_co,montant_commande,commande)
    VALUES('" . $proforma . "','" . gmdate('Y-m-d') . "','" . $id_user . "','" . $montant . "','" . $commande . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function commande_attente()
{
	global $bdd;
	$sql = "SELECT * FROM commandes c
	    INNER JOIN proformas p ON  p.num_proforma=c.proforma_id 
	 	INNER JOIN clients cl ON  cl.id_client=p.id_client 
		INNER JOIN users u ON  u.id_user=c.initiateur_co
		
	    WHERE c.validateur_co IS NULL
		ORDER BY id_commande DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function commande_valide()
{
	global $bdd;
	$sql = "SELECT * FROM commandes c
	    INNER JOIN proformas p ON  p.num_proforma=c.proforma_id 
	 	INNER JOIN clients cl ON  cl.id_client=p.id_client 
		INNER JOIN users u ON  u.id_user=c.initiateur_co
		
	    WHERE c.validateur_co IS NOT NULL AND c.etat_commande=0
		ORDER BY id_commande DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function commande_traite()
{
	global $bdd;
	$sql = "SELECT * FROM commandes c
	    INNER JOIN proformas p ON  p.num_proforma=c.proforma_id 
	 	INNER JOIN clients cl ON  cl.id_client=p.id_client 
		INNER JOIN users u ON  u.id_user=c.initiateur_co
		
	    WHERE  c.etat_commande=1
		ORDER BY id_commande DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function commande($id)
{
	global $bdd;
	$sql = "SELECT * FROM commandes c
	    INNER JOIN proformas p ON  p.num_proforma=c.proforma_id 
	 	INNER JOIN clients cl ON  cl.id_client=p.id_client 
		INNER JOIN users u ON  u.id_user=c.initiateur_co
		
	    WHERE c.id_commande=".$id;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}


/*************Fin gestion commande */


/*************Gestion facture ********/
function create_facture($id_commande,$id_user)
{
	$remise = htmlspecialchars(addslashes($_POST['remise']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO factures (commande_id,date_facture,remise_facture,initiateur_fa)
    VALUES('". $id_commande . "','" . gmdate('Y-m-d') . "','" . $remise . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}


function create_encaisemment($id)
{
	
	$mode_paiement=htmlspecialchars(addslashes($_POST['mode_paiement']));
	$montant_encaisse=$_POST['montant'];
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO encaissements (facture_id,date_encaissement,montant_en,mode_paiement)
    VALUES('". $id . "','" . gmdate('Y-m-d') . "','" . $montant_encaisse . "','" . $mode_paiement . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}


function create_facture_prdt($id_facture, $id_produit, $nombre, $prix)
{
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO facture_produit (facture_id,produit_id,nombre,prix)
    VALUES('" . $id_facture . "','" . $id_produit . "','" . $nombre . "','" . $prix . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function facture($id)
{
	global $bdd;
	$sql = "SELECT * FROM factures f
	    INNER JOIN commandes co ON  co.id_commande=f.commande_id
		INNER JOIN proformas p ON  p.num_proforma=co.proforma_id
	     INNER JOIN clients c ON  c.id_client=p.id_client 
		 INNER JOIN users u ON  u.id_user=f.initiateur_fa
	    WHERE f.id_facture=".$id;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
function facture_attente()
{
	global $bdd;
	$sql = "SELECT * FROM factures f
	    INNER JOIN commandes co ON  co.id_commande=f.commande_id
		INNER JOIN proformas p ON  p.num_proforma=co.proforma_id
	     INNER JOIN clients c ON  c.id_client=p.id_client 
		 INNER JOIN users u ON  u.id_user=f.initiateur_fa
	    WHERE f.validateur_fa IS NULL 
		ORDER BY f.id_facture DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function facture_valide()
{
	global $bdd;
	$sql = "SELECT * FROM factures f
	    INNER JOIN commandes co ON  co.id_commande=f.commande_id
		INNER JOIN proformas p ON  p.num_proforma=co.proforma_id
	     INNER JOIN clients c ON  c.id_client=p.id_client 
		 INNER JOIN users u ON  u.id_user=f.initiateur_fa
	    WHERE f.validateur_fa IS NOT NULL  AND  f.etat_facture=0
		ORDER BY f.id_facture DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function facture_traite()
{
	global $bdd;
	$sql = "SELECT *
	FROM factures f
	    INNER JOIN commandes co ON  co.id_commande=f.commande_id
		INNER JOIN proformas p ON  p.num_proforma=co.proforma_id
	     INNER JOIN clients c ON  c.id_client=p.id_client 
		 INNER JOIN users u ON  u.id_user=f.initiateur_fa
	    WHERE f.etat_facture=1 
		ORDER BY f.id_facture DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}



function facture_proforma($id)
{
	global $bdd;
	$sql = "SELECT pp.produit_id,p.code_produit, p.libelle, pp.nombre, pp.prix, (pp.nombre*pp.prix)as Total 
	  FROM proforma_produit pp
	  INNER JOIN produits p ON p.id_produit=pp.produit_id  
		 WHERE proforma_id=" . $id;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function produit_facture($id)
{
	global $bdd;
	$sql = "SELECT pp.produit_id,p.code_produit, p.libelle, pp.nombre, pp.prix, (pp.nombre*pp.prix)as Total 
	  FROM facture_produit pp
	  INNER JOIN produits p ON p.id_produit=pp.produit_id  
		 WHERE facture_id=" . $id;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}


function montant_facture($id)
{
	global $bdd;
	$sql = "SELECT SUM(pp.nombre*pp.prix) as Total 
	  FROM facture_produit pp
	  INNER JOIN produits p ON p.id_produit=pp.produit_id  
		 WHERE facture_id=" . $id;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['Total'];
}

function liste_encaissement()
{
	global $bdd;
	$sql = "SELECT * FROM encaissements e
	
	    INNER JOIN factures f ON  f.id_facture=e.facture_id
	    INNER JOIN commandes co ON  co.id_commande=f.commande_id
		INNER JOIN proformas p ON  p.num_proforma=co.proforma_id
	     INNER JOIN clients c ON  c.id_client=p.id_client 
		 INNER JOIN users u ON  u.id_user=f.initiateur_fa 
		ORDER BY e.id_encaissement DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}


function montant_facture_payer($id)
{
	global $bdd;
	$sql = "SELECT SUM(montant_en) as montant_payer FROM encaissements 
	WHERE facture_id='".$id."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['montant_payer'];
}

/*************Fin gestion facture */





/**************gestion budget*******/

function create_rubrique()
{
	$code_rubrique = htmlspecialchars(addslashes($_POST['code']));
	$libelle = htmlspecialchars(addslashes($_POST['libelle']));
	$compte = $_POST['compte'];
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO rubriques (code_rubrique,libelle_rubrique,compte)
    VALUES('" . $code_rubrique . "','" . $libelle . "','" . $compte . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}


function create_srubrique()
{
	$code_srubrique = htmlspecialchars(addslashes($_POST['code']));
	$libelle = htmlspecialchars(addslashes($_POST['libelle']));
	$rubrique = $_POST['rubrique'];
	$compte = $_POST['compte'];
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO sous_rubriques (code_sous_rubrique,libelle_sous,rubrique_id,scompte)
    VALUES('" . $code_srubrique . "','" . $libelle . "','" . $rubrique . "','" . $compte . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function create_ligne_budget($id_user)
{
	$annee = $_POST['annee'];
	$montant = $_POST['montant'];
	$rubrique = $_POST['rubrique'];
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO ligne_budgetaire (id_rubrique,annee,montant,date_saisie,initiateur)
    VALUES('" . $rubrique . "','" . $annee . "','" . $montant . "','" . gmdate('Y-m-d') . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}


function rubrique_non_selectionner($annee)
{
	global $bdd;
	$sql = "SELECT * FROM rubriques r 
	WHERE id_rubrique NOT IN (SELECT id_rubrique FROM ligne_budgetaire WHERE annee='" . $annee . "')";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}


function srubrique_non_selectionner($id_rubrique, $id_ligne_budget)
{
	global $bdd;
	$sql = "SELECT sr.id_sous_rubrique, sr.code_sous_rubrique, sr.scompte, sr.libelle_sous FROM sous_rubriques sr
	INNER JOIN rubriques r ON r.id_rubrique=sr.rubrique_id
	INNER JOIN ligne_budgetaire l ON l.id_rubrique=r.id_rubrique 
	WHERE sr.rubrique_id='" . $id_rubrique . "' AND sr.id_sous_rubrique NOT IN (SELECT sous_rubrique_id FROM sous_ligne_b WHERE ligne_budget_id='" . $id_ligne_budget . "')";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}


function create_sligne_budget($id_user)
{
	$srubrique = $_POST['srubrique'];
	$montant = $_POST['montant'];
	$rubrique = $_POST['rubrique'];
	$financeur = $_POST['financeur'];
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO sous_ligne_b (sous_rubrique_id,ligne_budget_id,montant,financeur,date_saisie,initiateur)
    VALUES('" . $srubrique . "','" . $rubrique . "','" . $montant . "','" . $financeur . "','" . gmdate('Y-m-d') . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function somme_montant_sous_ligne($id_ligne_budget){
	global $bdd;
	$sql = "SELECT SUM(montant) as somme_montant  FROM sous_ligne_b 
	WHERE ligne_budget_id='".$id_ligne_budget."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return intval($resultats['somme_montant']);
}

function list_sous_rubrique()
{
	global $bdd;
	$sql = "SELECT * FROM sous_rubriques s 
	INNER JOIN rubriques r ON r.id_rubrique=s.rubrique_id";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}


function list_budget($annee)
{
	global $bdd;
	$sql = "SELECT * FROM ligne_budgetaire l 
	INNER JOIN rubriques r ON r.id_rubrique=l.id_rubrique
	WHERE annee='" . $annee . "' AND valide=0";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function list_budget2($annee)
{
	global $bdd;
	$sql = "SELECT * FROM ligne_budgetaire l 
	INNER JOIN rubriques r ON r.id_rubrique=l.id_rubrique
	WHERE annee='" . $annee . "' AND valide=1";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function ligne_budget($id)
{
	global $bdd;
	$sql = "SELECT * FROM ligne_budgetaire l 
	INNER JOIN rubriques r ON r.id_rubrique=l.id_rubrique
	WHERE id_ligne_budget='" . $id . "'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function sous_ligne_budget($id)
{
	global $bdd;
	$sql = "SELECT l.annee, sr.code_sous_rubrique, sr.libelle_sous, r.libelle_rubrique, s.montant, s.date_saisie FROM sous_ligne_b s 
	INNER JOIN sous_rubriques sr ON sr.id_sous_rubrique=s.sous_rubrique_id
	INNER JOIN rubriques r ON r.id_rubrique=sr.rubrique_id
	INNER JOIN ligne_budgetaire l ON l.id_ligne_budget=s.ligne_budget_id
	WHERE s.id_sous_ligne='" . $id . "'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function s_list_budget($annee)
{
	global $bdd;
	$sql = "SELECT *, s.montant as montant_b FROM sous_ligne_b s 
	INNER JOIN sous_rubriques rs ON rs.id_sous_rubrique=s.sous_rubrique_id
	INNER JOIN ligne_budgetaire l ON l.id_ligne_budget=s.ligne_budget_id
	WHERE l.annee='" . $annee . "'AND s.valide=0";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function s_list_budget2($annee)
{
	global $bdd;
	$sql = "SELECT *, s.montant as montant_b FROM sous_ligne_b s 
	INNER JOIN sous_rubriques rs ON rs.id_sous_rubrique=s.sous_rubrique_id
	INNER JOIN ligne_budgetaire l ON l.id_ligne_budget=s.ligne_budget_id
	WHERE l.annee='" . $annee . "'AND s.valide=1";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function ligne_sbudget($id)
{
	global $bdd;
	$sql = "SELECT * FROM sous_ligne_b s 
	INNER JOIN sous_rubriques rs ON rs.id_sous_rubrique=s.sous_rubrique_id
	INNER JOIN ligne_budgetaire l ON l.id_ligne_budget=s.ligne_budget_id
	WHERE s.id_sous_ligne='" . $id . "'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function s_list_budget_par_rubrique($annee, $rubrique)
{
	global $bdd;
	$sql = "SELECT s.id_sous_ligne,rs.id_sous_rubrique, rs.scompte,rs.code_sous_rubrique, rs.libelle_sous, s.montant FROM sous_ligne_b s 
	INNER JOIN sous_rubriques rs ON rs.id_sous_rubrique=s.sous_rubrique_id
	INNER JOIN rubriques r ON r.id_rubrique=rs.rubrique_id
	INNER JOIN ligne_budgetaire l ON l.id_ligne_budget=s.ligne_budget_id
	WHERE l.annee='" . $annee . "' AND r.id_rubrique='" . $rubrique . "' AND s.valide=0";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function s_list_budget_par_rubrique2($annee, $rubrique)
{
	global $bdd;
	$sql = "SELECT s.id_sous_ligne,rs.id_sous_rubrique, rs.scompte,rs.code_sous_rubrique, rs.libelle_sous, s.montant FROM sous_ligne_b s 
	INNER JOIN sous_rubriques rs ON rs.id_sous_rubrique=s.sous_rubrique_id
	INNER JOIN rubriques r ON r.id_rubrique=rs.rubrique_id
	INNER JOIN ligne_budgetaire l ON l.id_ligne_budget=s.ligne_budget_id
	WHERE l.annee='" . $annee . "' AND r.id_rubrique='" . $rubrique . "' AND s.valide=1";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function rubrique_budget_byannee($annee)
{
	global $bdd;
	$sql = "SELECT DISTINCT l.id_rubrique, r.code_rubrique, r.libelle_rubrique FROM ligne_budgetaire l 
	INNER JOIN rubriques r ON r.id_rubrique=l.id_rubrique
	WHERE l.annee='" . $annee . "' AND l.valide=0";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
function rubrique_budget_byannee2($annee)
{
	global $bdd;
	$sql = "SELECT DISTINCT l.id_rubrique, r.code_rubrique, r.libelle_rubrique FROM ligne_budgetaire l 
	INNER JOIN rubriques r ON r.id_rubrique=l.id_rubrique
	WHERE l.annee='" . $annee . "' AND l.valide=1";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function verifier_ligne($table, $id_table, $id, $id_table2, $id2)
{
	global $bdd;
	$sql = "SELECT count(" . $id_table . ") as nombre 
	 FROM " . $table . " WHERE " . $id_table . "='" . $id . "' AND " . $id_table2 . "='" . $id2 . "'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['nombre'];
}
function annee_budgetaire()
{
	global $bdd;
	$sql = "SELECT DISTINCT annee FROM ligne_budgetaire";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
function ligne_budget_annee($annee)
{
	global $bdd;
	$sql = "SELECT *  FROM ligne_budgetaire l
	INNER JOIN rubriques r ON r.id_rubrique=l.id_rubrique 
	WHERE l.annee='" . $annee . "' AND l.valide=0";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
function ligne_budget_annee2($annee)
{
	global $bdd;
	$sql = "SELECT *  FROM ligne_budgetaire l
	INNER JOIN rubriques r ON r.id_rubrique=l.id_rubrique 
	WHERE l.annee='" . $annee . "' AND l.valide=1";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

/**************fin gestion budget*******/

/*************Gestion Fournisseur ********/

function create_fournisseur($id_user)
{
	$nom = htmlspecialchars(addslashes($_POST['nom']));
	$contact = htmlspecialchars(addslashes($_POST['contact']));
	$adresse = htmlspecialchars(addslashes($_POST['adresse']));
	$code = htmlspecialchars(addslashes($_POST['code']));
	$banque = htmlspecialchars(addslashes($_POST['banque']));
	$compte = htmlspecialchars(addslashes($_POST['compte']));

	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO fournisseurs (code_cc,nom_fournisseur,adresse_fournisseur,contact_fournisseur,date_saisie_f,banque,num_compte,initiateur_f)
    VALUES('" . $code . "','" . $nom . "','" . $adresse . "','" . $contact . "','" . gmdate('Y-m-d') . "','" . $banque . "','" . $compte . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function maj_fournisseur($id)
{
	$nom = htmlspecialchars(addslashes($_POST['nom']));
	$contact = htmlspecialchars(addslashes($_POST['contact']));
	$adresse = htmlspecialchars(addslashes($_POST['adresse']));
	$code = htmlspecialchars(addslashes($_POST['code']));
	$banque = htmlspecialchars(addslashes($_POST['banque']));
	$compte = htmlspecialchars(addslashes($_POST['compte']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "UPDATE fournisseurs
	SET nom_fournisseur='" . $nom . "',
	    contact_fournisseur = '" . $contact . "',
		adresse_fournisseur = '" . $adresse . "',
		code_cc = '" . $code . "',
		banque = '" . $banque . "',
		num_compte = '" . $compte . "'
		WHERE id_fournisseur='" . $id . "'";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}
 function fournisseur_attente(){
	global $bdd;
	$sql = "SELECT *  FROM fournisseurs f
	INNER JOIN users u ON u.id_user=f.initiateur_f
	WHERE f.validateur_f IS NULL ORDER BY id_fournisseur DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
 }

 function fournisseur_valide(){
	global $bdd;
	$sql = "SELECT *  FROM fournisseurs f
	INNER JOIN users u ON u.id_user=f.initiateur_f
	INNER JOIN users s ON s.id_user=f.validateur_f
	WHERE f.validateur_f IS NOT NULL  ORDER BY id_fournisseur DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
 }

 function fournisseur_non_selectionner($besoin){
	global $bdd;
	$sql = "SELECT *  FROM fournisseurs f 
	WHERE f.validateur_f IS NOT NULL AND id_fournisseur NOT IN (SELECT fournisseur_id FROM fproformas WHERE besoin_id='".$besoin."')
	 ORDER BY id_fournisseur DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
 }

 function fournisseur($id){
	global $bdd;
	$sql = "SELECT *  FROM fournisseurs f
	INNER JOIN users u ON u.id_user=f.initiateur
	WHERE f.id_fournisseur='".$id."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
 }

/*************Fin gestion fournisseur */

/*************Gestion besoin ********/

function create_besoin($emploi,$service,$type,$objet,$id_user)
{
	
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO besoins (emploi_id,service_id,type_procedure,date_saisie_b,objet,initiateur_b)
    VALUES('" . $emploi . "','" . $service . "','" . $type . "','" . gmdate('Y-m-d') . "','" . $objet . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function edit_besoin($id)
{
	$service = $_POST['service'];
	$emploi = $_POST['emploi'];
	$type = $_POST['type'];
	$objet = htmlspecialchars(addslashes($_POST['objet']));	
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "UPDATE besoins
	SET emploi_id='" . $emploi . "',
	    service_id = '" . $service . "',
		type_procedure = '" . $type . "',
		objet= '" . $objet . "'	
		WHERE id_besoin='" . $id . "'";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function liste_besoin_valide()
{
	global $bdd;
	$sql = "SELECT *  FROM besoins b
	INNER JOIN services s ON s.id_service=b.service_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id 
	INNER JOIN emplois e ON e.id_emploi=l.emploi_id 
	INNER JOIN users u ON u.id_user=b.initiateur_b
	INNER JOIN users r ON r.id_user=b.validateur_b
	WHERE b.validateur_b IS NOT NULL AND b.etat_besoin=0 ORDER BY b.id_besoin DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function liste_besoin_traite()
{
	global $bdd;
	$sql = "SELECT *  FROM besoins b
	INNER JOIN services s ON s.id_service=b.service_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id 
	INNER JOIN emplois e ON e.id_emploi=l.emploi_id 
	INNER JOIN users u ON u.id_user=b.initiateur_b
	INNER JOIN users r ON r.id_user=b.validateur_b
	WHERE b.validateur_b IS NOT NULL AND b.etat_besoin=1 ORDER BY b.id_besoin DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function liste_besoin_attente()
{
	global $bdd;
	$sql = "SELECT *  FROM besoins b
	INNER JOIN services s ON s.id_service=b.service_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id 
	INNER JOIN emplois e ON e.id_emploi=l.emploi_id 
	INNER JOIN users u ON u.id_user=b.initiateur_b
	WHERE b.validateur_b IS NULL ORDER BY b.id_besoin DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
function besoin($id)
{
	global $bdd;
	$sql = "SELECT *  FROM besoins b
	INNER JOIN services s ON s.id_service=b.service_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id 
	INNER JOIN emplois e ON e.id_emploi=l.emploi_id 
	WHERE ".$id."=b.id_besoin";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}


function besoin_par_service($id_service){
	global $bdd;
	$sql = "SELECT *  FROM besoins b
	INNER JOIN services s ON s.id_service=b.service_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id 
	INNER JOIN emplois e ON e.id_emploi=l.emploi_id 
	INNER JOIN users u ON u.id_user=b.initiateur_b
	WHERE b.validateur_b IS NOT NULL AND b.etat_besoin=0 AND b.service_id='".$id_service."'
	AND YEAR(b.date_saisie_b)=YEAR(NOW()) ORDER BY b.id_besoin DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function besoin_non_selectionner()
{
	global $bdd;
	$sql = "SELECT *  FROM besoins b
	INNER JOIN sous_ligne_b s ON s.id_sous_ligne=b.id_sous_ligne
	INNER JOIN sous_rubriques r ON r.id_sous_rubrique=s.sous_rubrique_id 
	WHERE b.valide=1  AND b.etat_besoin=0 ORDER BY b.id_besoin DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function nbre_proforma_besoin($id_besoin){
	global $bdd;
	$sql = "SELECT COUNT(besoin_id) as nombre  FROM fproformas
	WHERE besoin_id='".$id_besoin."' ";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['nombre'];
}

/*************Fin gestion besoin */


/*************Gestion fproforma ********/
function create_fproforma($fournisseur,$besoin,$date_proforma,$reference,$montant,$id_user,$proforma)
{
	/*$fournisseur = htmlspecialchars(addslashes($_POST['fournisseur']));
	$besoin = htmlspecialchars(addslashes($_POST['besoin']));
	$date_proforma = htmlspecialchars(addslashes($_POST['date_proforma']));
	$reference = htmlspecialchars(addslashes($_POST['reference']));
	$montant = htmlspecialchars(addslashes($_POST['montant']));*/
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO fproformas (besoin_id,fournisseur_id,reference,date_reference,montant_fp,proforma,date_fproforma,initiateur_fp)
    VALUES('" . $besoin. "','" . $fournisseur. "','" . $reference. "','" . $date_proforma. "','" . $montant. "','" . $proforma. "','" . gmdate('Y-m-d') . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function fproforma_attente()
{
	global $bdd;
	$sql = "SELECT p.id_fproforma,s.nom_service,p.etat_proforma, p.date_fproforma, f.nom_fournisseur, b.date_saisie_b, b.objet,
	p.reference,p.date_reference,p.montant_fp,p.proforma
	  FROM fproformas p
	 INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	 INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	 INNER JOIN services s ON s.id_service=b.service_id
	 WHERE p.validateur_fp IS NULL
	ORDER BY id_fproforma DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function fproforma_valide()
{
	global $bdd;
	$sql = "SELECT p.id_fproforma,s.nom_service,p.etat_proforma, p.date_fproforma, f.nom_fournisseur, b.date_saisie_b, b.objet,
	p.reference,p.date_reference,p.montant_fp,p.proforma
	  FROM fproformas p
	 INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	 INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	 INNER JOIN services s ON s.id_service=b.service_id
	 WHERE p.validateur_fp IS NOT NULL
	ORDER BY id_fproforma DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function fproforma($id)
{
	global $bdd;
	$sql = "SELECT * 
	  FROM fproformas p
	 INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	 INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	 INNER JOIN services s ON s.id_service=b.service_id
	 INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	WHERE p.id_fproforma='".$id."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
function fproforma_select($id)
{
	global $bdd;
	$sql = "SELECT * 
	FROM fproformas p
	 INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	 INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	 INNER JOIN services s ON s.id_service=b.service_id
	 INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	 INNER JOIN emplois e ON e.id_emploi=l.emploi_id
	WHERE p.besoin_id='".$id."' AND p.validateur_fp IS NOT NULL AND p.montant_fp=(SELECT MIN(montant_fp) FROM fproformas WHERE besoin_id='".$id."' AND validateur_fp) LIMIT 1";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}


function fproforma_par_besoin($id_besoin)
{
	global $bdd;
	$sql = "SELECT p.id_fproforma, p.date_fproforma,p.reference,p.date_reference,p.montant_fp, f.nom_fournisseur, p.proforma, b.date_saisie_b, b.objet
	  FROM fproformas p
	 INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	 INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	WHERE p.besoin_id='".$id_besoin."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}



/*************Fin gestion fproforma */

/***************Gestion bon de commande */
function create_engagement($id_user)
{
	
	$type = $_POST['type_engagement'];
	$proforma = htmlspecialchars(addslashes($_POST['id_fproforma']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO engagements (proforma_id,date_engagement,type_engagement,initiateur_ben)
    VALUES('" . $proforma . "','" . gmdate('Y-m-d') . "','" . $type . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}


function create_produit_commande($id_engagement, $produit, $nombre, $prix)
{
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO produits_commande (engagement_id,libelle_produit,quantite,prix)
    VALUES('" . $id_engagement . "','" . $produit . "','" . $nombre . "','" . $prix . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function delete_produit_commande($id_engagement)
{
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "DELETE  FROM produits_commande WHERE engagement_id='" . $id_engagement . "'";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
	
}

function engagement_attente()
{
	global $bdd;
	$sql = "SELECT *
	  FROM engagements e
	  INNER JOIN fproformas p ON p.id_fproforma=e.proforma_id
	 INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	 INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	 INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	 INNER JOIN services s ON s.id_service=b.service_id
	 WHERE e.validateur_ben IS NULL";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function engagement_valide()
{
	global $bdd;
	$sql = "SELECT *
	  FROM engagements e
	  INNER JOIN fproformas p ON p.id_fproforma=e.proforma_id
	 INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	 INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	 INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	 INNER JOIN services s ON s.id_service=b.service_id
	 WHERE e.validateur_ben IS NOT NULL AND e.etat_engagement=0 ORDER BY id_engagement ASC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
function engagement_traite()
{
	global $bdd;
	$sql = "SELECT *
	  FROM engagements e
	  INNER JOIN fproformas p ON p.id_fproforma=e.proforma_id
	 INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	 INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	 INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	 INNER JOIN services s ON s.id_service=b.service_id
	 WHERE e.validateur_ben IS NOT NULL AND e.etat_engagement=1 ORDER BY id_engagement DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}




function engagement($id)
{
	global $bdd;
	$sql = "SELECT * 
	FROM engagements e
	INNER JOIN fproformas p ON p.id_fproforma=e.proforma_id
   INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
   INNER JOIN besoins b ON b.id_besoin=p.besoin_id
   INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
   INNER JOIN emplois em ON em.id_emploi=l.emploi_id
   INNER JOIN natures n ON n.id_nature=em.nature_id
   INNER JOIN ligne_ressource lr ON lr.id_ligne_ressource=l.ressource_id
   INNER JOIN sous_ressources sr ON sr.id_sous_ressource=lr.sressource_id
   INNER JOIN ressources r ON r.id_ressource=sr.ressource_id
   INNER JOIN services s ON s.id_service=b.service_id
	WHERE id_engagement='".$id."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function produit_commande($id_engagement)
{
	global $bdd;
	$sql = "SELECT *,(quantite*prix) as total 
	 
	FROM produits_commande 
	     WHERE engagement_id='".$id_engagement."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function montant_commande($id_engagement){
	global $bdd;
	$sql = "SELECT SUM(quantite*prix) as total_montant 
	 
	FROM produits_commande 
	     WHERE engagement_id=" . $id_engagement;
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['total_montant'];
}

function create_bon_commande($id_engagement,$id_user)
{

	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO bon_commandes (engagement_id,date_commande,initiateur_bc)
    VALUES('" . $id_engagement . "','" . gmdate('Y-m-d') . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function bon_commande($id)
{
	
	global $bdd;
	$sql = "SELECT * FROM bon_commandes bc
	INNER JOIN engagements e ON e.id_engagement= bc.engagement_id
	INNER JOIN fproformas p ON p.id_fproforma= e.proforma_id
	INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	INNER JOIN emplois em ON em.id_emploi=l.emploi_id
	INNER JOIN natures n ON n.id_nature=em.nature_id
	INNER JOIN ligne_ressource lr ON lr.id_ligne_ressource=l.ressource_id
	INNER JOIN sous_ressources sr ON sr.id_sous_ressource=lr.sressource_id
	INNER JOIN ressources r ON r.id_ressource=sr.ressource_id
	INNER JOIN services s ON s.id_service=b.service_id
	
	WHERE id_bon_commande='".$id."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function bon_commande_attente()
{
	global $bdd;
	$sql = "SELECT * FROM bon_commandes bo
	INNER JOIN engagements e ON e.id_engagement= bo.engagement_id
	INNER JOIN fproformas p ON p.id_fproforma= e.proforma_id
	INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	INNER JOIN services s ON s.id_service=b.service_id
	WHERE bo.validateur_bc IS NULL ORDER BY id_bon_commande DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}


function bon_commande_valide()
{
	global $bdd;
	$sql = "SELECT * FROM bon_commandes bo
	INNER JOIN engagements e ON e.id_engagement= bo.engagement_id
	INNER JOIN fproformas p ON p.id_fproforma= e.proforma_id
	INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	INNER JOIN services s ON s.id_service=b.service_id
	WHERE bo.etat_commande=0 AND bo.validateur_bc IS NOT NULL ORDER BY id_bon_commande ASC"; 
	 
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function bon_commande_traite()
{
	global $bdd;
	$sql = "SELECT * FROM bon_commandes bo
	INNER JOIN engagements e ON e.id_engagement= bo.engagement_id
	INNER JOIN fproformas p ON p.id_fproforma= e.proforma_id
	INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	INNER JOIN ligne_emploi l ON l.id_ligne_emploi=b.emploi_id
	INNER JOIN services s ON s.id_service=b.service_id
	WHERE bo.etat_commande=1 AND bo.validateur_bc IS NOT NULL ORDER BY id_bon_commande DESC"; 
	 
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
/**************Fin gestion bon de commande */

/**************gestion livraison Facturation*/
function create_livraison($bon_commande_id,$piece,$id_user)
{
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO livraisons (bon_commande_id,piece,date_livraison,initiateur_li)
    VALUES('" . $bon_commande_id. "','" . $piece . "','" . gmdate('Y-m-d') . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function liste_livraison()
{

	 
	global $bdd;
	$sql = "SELECT * FROM livraisons l
	INNER JOIN bon_commandes bo ON bo.id_bon_commande=l.bon_commande_id
	INNER JOIN engagements e ON e.id_engagement= bo.engagement_id
	INNER JOIN fproformas p ON p.id_fproforma= e.proforma_id
	INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	INNER JOIN ligne_emploi le ON le.id_ligne_emploi=b.emploi_id
	INNER JOIN services s ON s.id_service=b.service_id
	WHERE l.etat_livraison=0 ORDER BY id_livraison ASC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function livraison_traite()
{

	 
	global $bdd;
	$sql = "SELECT * FROM livraisons l
	INNER JOIN bon_commandes bo ON bo.id_bon_commande=l.bon_commande_id
	INNER JOIN engagements e ON e.id_engagement= bo.engagement_id
	INNER JOIN fproformas p ON p.id_fproforma= e.proforma_id
	INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	INNER JOIN ligne_emploi le ON le.id_ligne_emploi=b.emploi_id
	INNER JOIN services s ON s.id_service=b.service_id
	WHERE l.etat_livraison=1 ORDER BY id_livraison DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function livraison($id)
{
	global $bdd;
	$sql = "SELECT * FROM livraisons l
	INNER JOIN bon_commandes bo ON bo.id_bon_commande=l.bon_commande_id
	INNER JOIN engagements e ON e.id_engagement= bo.engagement_id
	INNER JOIN fproformas p ON p.id_fproforma= e.proforma_id
	INNER JOIN besoins b ON b.id_besoin=p.besoin_id
	INNER JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	INNER JOIN ligne_emploi le ON le.id_ligne_emploi=b.emploi_id
	INNER JOIN services s ON s.id_service=b.service_id
	WHERE l.id_livraison='".$id."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function create_bon_facture($livraison_id,$facture,$id_user)
{
	$montant=htmlspecialchars(addslashes($_POST['montant']));
	$reference=htmlspecialchars(addslashes($_POST['reference']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO bon_factures (livraison_id,facture,date_facture,reference_facture,montant_facture,initiateur_fa)
    VALUES('" . $livraison_id. "','" . $facture . "','" . gmdate('Y-m-d') . "','" . $reference . "','" . $montant . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function create_bon_facture_s($besoin_id,$facture,$id_user)
{
	$montant=htmlspecialchars(addslashes($_POST['montant']));
	$reference=htmlspecialchars(addslashes($_POST['reference']));
	$fournisseur=htmlspecialchars(addslashes($_POST['fournisseur']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO bon_factures (besoin_id,facture,date_facture,reference_facture,montant_facture,fournisseur,initiateur_fa)
    VALUES('" . $besoin_id. "','" . $facture . "','" . gmdate('Y-m-d') . "','" . $reference . "','" . $montant . "','" . $fournisseur . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function bon_facture_attente()
{

	global $bdd;
	/*$sql = "SELECT * FROM bon_factures 
	
	WHERE validateur_fa IS NULL ORDER BY id_bon_facture ASC";*/
	$sql = "SELECT *,b.objet as objet_n,bs.objet as objet_s,s.nom_service as nom_service_n,se.nom_service as nom_service_s FROM bon_factures fa
	LEFT JOIN livraisons l ON l.id_livraison=fa.livraison_id
	LEFT JOIN bon_commandes bo ON bo.id_bon_commande=l.bon_commande_id
	LEFT JOIN engagements e ON e.id_engagement= bo.engagement_id
	LEFT JOIN fproformas p ON p.id_fproforma= e.proforma_id
	LEFT JOIN besoins b ON b.id_besoin=p.besoin_id
	LEFT JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	LEFT JOIN ligne_emploi le ON le.id_ligne_emploi=b.emploi_id
	LEFT JOIN services s ON s.id_service=b.service_id
	LEFT JOIN besoins bs ON bs.id_besoin=fa.besoin_id
	LEFT JOIN services se ON se.id_service=bs.service_id
	WHERE fa.validateur_fa IS NULL ORDER BY id_bon_facture ASC";

	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;	
}

function bon_facture_valide()
{
	global $bdd;
	/*$sql = "SELECT * FROM bon_factures
	WHERE validateur_fa IS NOT NULL AND etat_facture=0 ORDER BY id_bon_facture ASC";*/
	$sql = "SELECT *,b.objet as objet_n,bs.objet as objet_s,s.nom_service as nom_service_n,se.nom_service as nom_service_s FROM bon_factures fa
	LEFT JOIN livraisons l ON l.id_livraison=fa.livraison_id
	LEFT JOIN bon_commandes bo ON bo.id_bon_commande=l.bon_commande_id
	LEFT JOIN engagements e ON e.id_engagement= bo.engagement_id
	LEFT JOIN fproformas p ON p.id_fproforma= e.proforma_id
	LEFT JOIN besoins b ON b.id_besoin=p.besoin_id
	LEFT JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	LEFT JOIN ligne_emploi le ON le.id_ligne_emploi=b.emploi_id
	LEFT JOIN services s ON s.id_service=b.service_id
	LEFT JOIN besoins bs ON bs.id_besoin=fa.besoin_id
	LEFT JOIN services se ON se.id_service=bs.service_id
	WHERE fa.validateur_fa IS NOT NULL AND fa.etat_facture=0  ORDER BY id_bon_facture ASC";
	
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function bon_facture_traite()
{
	global $bdd;
	/*$sql = "SELECT * FROM bon_factures
	WHERE etat_facture=1  ORDER BY id_bon_facture DESC";*/
	$sql = "SELECT *,b.objet as objet_n,bs.objet as objet_s,s.nom_service as nom_service_n,se.nom_service as nom_service_s FROM bon_factures fa
	LEFT JOIN livraisons l ON l.id_livraison=fa.livraison_id
	LEFT JOIN bon_commandes bo ON bo.id_bon_commande=l.bon_commande_id
	LEFT JOIN engagements e ON e.id_engagement= bo.engagement_id
	LEFT JOIN fproformas p ON p.id_fproforma= e.proforma_id
	LEFT JOIN besoins b ON b.id_besoin=p.besoin_id
	LEFT JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	LEFT JOIN ligne_emploi le ON le.id_ligne_emploi=b.emploi_id
	LEFT JOIN services s ON s.id_service=b.service_id
	LEFT JOIN besoins bs ON bs.id_besoin=fa.besoin_id
	LEFT JOIN services se ON se.id_service=bs.service_id
	WHERE fa.etat_facture=1 IS NOT NULL ORDER BY id_bon_facture ASC";
	
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function bon_facture($id)
{

	global $bdd;
	$sql = "SELECT *,b.objet as objet_n,bs.objet as objet_s,s.nom_service as nom_service_n,se.nom_service as nom_service_s FROM bon_factures fa
	LEFT JOIN livraisons l ON l.id_livraison=fa.livraison_id
	LEFT JOIN bon_commandes bo ON bo.id_bon_commande=l.bon_commande_id
	LEFT JOIN engagements e ON e.id_engagement= bo.engagement_id
	LEFT JOIN fproformas p ON p.id_fproforma= e.proforma_id
	LEFT JOIN besoins b ON b.id_besoin=p.besoin_id
	LEFT JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	LEFT JOIN ligne_emploi le ON le.id_ligne_emploi=b.emploi_id
	LEFT JOIN services s ON s.id_service=b.service_id
	LEFT JOIN besoins bs ON bs.id_besoin=fa.besoin_id
	LEFT JOIN services se ON se.id_service=bs.service_id
	WHERE fa.id_bon_facture='".$id."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
	
}

function create_op($facture_id,$id_user)
{
	$retenue=$_POST['retenue'];
	$bailleur=$_POST['bailleur'];
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO ordre_paiement (facture_id,date_op,retenue,bailleur,initiateur_op)
    VALUES('" . $facture_id. "','" . gmdate('Y-m-d') . "','" . $retenue . "','" . $bailleur . "','" . $id_user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}


function op_attente()
{
	global $bdd;
	$sql = "SELECT * FROM ordre_paiement op
	INNER JOIN bon_factures fa ON fa.id_bon_facture=op.facture_id	
	WHERE op.validateur_op IS NULL ORDER BY id_ordre_paiement ASC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
function op_valide()
{
	global $bdd;
	$sql = "SELECT * FROM ordre_paiement op
	INNER JOIN bon_factures fa ON fa.id_bon_facture=op.facture_id
	WHERE op.validateur_op IS NOT NULL AND op.etat_op=0 ORDER BY id_ordre_paiement ASC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function op_traite()
{
	global $bdd;
	$sql = "SELECT * FROM ordre_paiement op
	INNER JOIN bon_factures fa ON fa.id_bon_facture=op.facture_id
	WHERE op.etat_op=1 ORDER BY id_ordre_paiement DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
function op($id)
{
	global $bdd;
	$sql = "SELECT op.id_ordre_paiement, op.date_op, op.retenue, op.bailleur,
	fa.id_bon_facture,fa.livraison_id,fa.facture,fa.date_facture,fa.reference_facture,fa.montant_facture,fa.besoin_id,
	op.valide_op_dg, op.date_op_dg,op.valide_op_daf, op.date_op_daf,op.valide_op_controle, op.date_op_controle,
	fo.nom_fournisseur as nom_fournisseur_s,fo.adresse_fournisseur as adresse_fournisseur_s,fo.contact_fournisseur as contact_fournisseur_s,
	fo.banque as banque_s,fo.num_compte as num_compte_s, fo.code_cc as code_cc_s,
	f.nom_fournisseur as nom_fournisseur_n,f.adresse_fournisseur as adresse_fournisseur_n,f.contact_fournisseur as contact_fournisseur_n,
	f.banque as banque_n,f.num_compte as num_compte_n, f.code_cc as code_cc_n,
	b.objet as objet_n,b.type_procedure as type_procedure_n, bs.objet as objet_s,bs.type_procedure as type_procedure_s,
	s.nom_service as nom_service_n,se.nom_service as nom_service_s,
	e.id_engagement,e.type_engagement,e.date_engagement,
	le.annee as annee_n, n.libelle_nature as libelle_nature_n, em.compte_emploi as compte_emploi_n, em.libelle_emploi as libelle_emploi_n,
	lem.annee as annee_s,na.libelle_nature as libelle_nature_s, emp.compte_emploi as compte_emploi_s, emp.libelle_emploi as libelle_emploi_s FROM ordre_paiement op
	LEFT JOIN bon_factures fa ON fa.id_bon_facture=op.facture_id
	LEFT JOIN fournisseurs fo ON fo.id_fournisseur=fa.fournisseur
	LEFT JOIN livraisons l ON l.id_livraison=fa.livraison_id
	LEFT JOIN bon_commandes bo ON bo.id_bon_commande=l.bon_commande_id
	LEFT JOIN engagements e ON e.id_engagement= bo.engagement_id
	LEFT JOIN fproformas p ON p.id_fproforma= e.proforma_id
	LEFT JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	LEFT JOIN besoins b ON b.id_besoin=p.besoin_id
	LEFT JOIN services s ON s.id_service=b.service_id
	LEFT JOIN ligne_emploi le ON le.id_ligne_emploi=b.emploi_id
	LEFT JOIN emplois em ON em.id_emploi=le.emploi_id
	LEFT JOIN natures n ON n.id_nature=em.nature_id
	LEFT JOIN besoins bs ON bs.id_besoin=fa.besoin_id
	LEFT JOIN services se ON se.id_service=bs.service_id
	LEFT JOIN ligne_emploi lem ON lem.id_ligne_emploi=bs.emploi_id
	LEFT JOIN emplois emp ON emp.id_emploi=le.emploi_id
	LEFT JOIN natures na ON na.id_nature=emp.nature_id
	WHERE id_ordre_paiement='".$id."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}
/**************fin gestion livraison Facturation*/

/**************gestion  Facturation cheque*/

function create_cheque($id,$user)
{
	
	$montant_cheque=htmlspecialchars(addslashes($_POST['montant_cheque']));
	$banque=htmlspecialchars(addslashes($_POST['banque']));
	$numero_cheque=htmlspecialchars(addslashes($_POST['numero_cheque']));
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO cheques (numero_cheque,ordre_paiement_id,montant_cheque,banque,date_cheque,initiateur_ch)
    VALUES('" . $numero_cheque. "','" . $id . "','" . $montant_cheque . "','" . $banque . "','" . gmdate('Y-m-d') . "','" . $user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}

function montant_payer($id)
{
	global $bdd;
	$sql = "SELECT SUM(montant_cheque) as montant_payer FROM cheques 
	WHERE ordre_paiement_id='".$id."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetch();
	return $resultats['montant_payer'];
}

function cheque_attente()
{
	global $bdd;
	$sql = "SELECT c.id_cheque, c.numero_cheque, c.montant_cheque, c.date_cheque, c.banque,  op.id_ordre_paiement,
	fa.livraison_id,fa.besoin_id,
	c.valide_cheque_dg, c.date_cheque_dg,c.valide_cheque_daf, c.date_cheque_daf,
	le.annee as annee_n,lem.annee as annee_s FROM cheques c
	LEFT JOIN ordre_paiement op ON op.id_ordre_paiement=c.ordre_paiement_id
	LEFT JOIN bon_factures fa ON fa.id_bon_facture=op.facture_id
	LEFT JOIN fournisseurs fo ON fo.id_fournisseur=fa.fournisseur
	LEFT JOIN livraisons l ON l.id_livraison=fa.livraison_id
	LEFT JOIN bon_commandes bo ON bo.id_bon_commande=l.bon_commande_id
	LEFT JOIN engagements e ON e.id_engagement= bo.engagement_id
	LEFT JOIN fproformas p ON p.id_fproforma= e.proforma_id
	LEFT JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	LEFT JOIN besoins b ON b.id_besoin=p.besoin_id
	LEFT JOIN services s ON s.id_service=b.service_id
	LEFT JOIN ligne_emploi le ON le.id_ligne_emploi=b.emploi_id
	LEFT JOIN besoins bs ON bs.id_besoin=fa.besoin_id
	LEFT JOIN ligne_emploi lem ON lem.id_ligne_emploi=bs.emploi_id
	WHERE c.validateur_ch IS NULL ORDER BY id_cheque ASC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function cheque_valide()
{
	global $bdd;
	$sql = "SELECT c.id_cheque, c.numero_cheque, c.montant_cheque, c.date_cheque, c.banque,  op.id_ordre_paiement,
	fa.livraison_id,fa.besoin_id,
	c.valide_cheque_dg, c.date_cheque_dg,c.valide_cheque_daf, c.date_cheque_daf,
	le.annee as annee_n,lem.annee as annee_s FROM cheques c
	LEFT JOIN ordre_paiement op ON op.id_ordre_paiement=c.ordre_paiement_id
	LEFT JOIN bon_factures fa ON fa.id_bon_facture=op.facture_id
	LEFT JOIN fournisseurs fo ON fo.id_fournisseur=fa.fournisseur
	LEFT JOIN livraisons l ON l.id_livraison=fa.livraison_id
	LEFT JOIN bon_commandes bo ON bo.id_bon_commande=l.bon_commande_id
	LEFT JOIN engagements e ON e.id_engagement= bo.engagement_id
	LEFT JOIN fproformas p ON p.id_fproforma= e.proforma_id
	LEFT JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	LEFT JOIN besoins b ON b.id_besoin=p.besoin_id
	LEFT JOIN services s ON s.id_service=b.service_id
	LEFT JOIN ligne_emploi le ON le.id_ligne_emploi=b.emploi_id
	LEFT JOIN besoins bs ON bs.id_besoin=fa.besoin_id
	LEFT JOIN ligne_emploi lem ON lem.id_ligne_emploi=bs.emploi_id
	WHERE c.validateur_ch IS NOT NULL  AND c.etat_cheque=0 ORDER BY id_cheque ASC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function cheque_traite()
{
	global $bdd;
	$sql = "SELECT c.id_cheque, c.numero_cheque, c.montant_cheque, c.date_cheque, c.banque,  op.id_ordre_paiement,
	fa.livraison_id,fa.besoin_id,
	c.valide_cheque_dg, c.date_cheque_dg,c.valide_cheque_daf, c.date_cheque_daf,
	le.annee as annee_n,lem.annee as annee_s FROM cheques c
	LEFT JOIN ordre_paiement op ON op.id_ordre_paiement=c.ordre_paiement_id
	LEFT JOIN bon_factures fa ON fa.id_bon_facture=op.facture_id
	LEFT JOIN fournisseurs fo ON fo.id_fournisseur=fa.fournisseur
	LEFT JOIN livraisons l ON l.id_livraison=fa.livraison_id
	LEFT JOIN bon_commandes bo ON bo.id_bon_commande=l.bon_commande_id
	LEFT JOIN engagements e ON e.id_engagement= bo.engagement_id
	LEFT JOIN fproformas p ON p.id_fproforma= e.proforma_id
	LEFT JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	LEFT JOIN besoins b ON b.id_besoin=p.besoin_id
	LEFT JOIN services s ON s.id_service=b.service_id
	LEFT JOIN ligne_emploi le ON le.id_ligne_emploi=b.emploi_id
	LEFT JOIN besoins bs ON bs.id_besoin=fa.besoin_id
	LEFT JOIN ligne_emploi lem ON lem.id_ligne_emploi=bs.emploi_id
	WHERE c.etat_cheque=1 ORDER BY id_cheque DESC";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function cheque($id)
{
	global $bdd;
	$sql = "SELECT c.id_cheque, c.numero_cheque, c.montant_cheque, c.date_cheque, c.banque,  op.id_ordre_paiement,
	fa.livraison_id,fa.besoin_id,fo.nom_fournisseur as nom_fournisseur_s,f.nom_fournisseur as nom_fournisseur_n,
	c.valide_cheque_dg, c.date_cheque_dg,c.valide_cheque_daf, c.date_cheque_daf,
	le.annee as annee_n,lem.annee as annee_s FROM cheques c
	LEFT JOIN ordre_paiement op ON op.id_ordre_paiement=c.ordre_paiement_id
	LEFT JOIN bon_factures fa ON fa.id_bon_facture=op.facture_id
	LEFT JOIN fournisseurs fo ON fo.id_fournisseur=fa.fournisseur
	LEFT JOIN livraisons l ON l.id_livraison=fa.livraison_id
	LEFT JOIN bon_commandes bo ON bo.id_bon_commande=l.bon_commande_id
	LEFT JOIN engagements e ON e.id_engagement= bo.engagement_id
	LEFT JOIN fproformas p ON p.id_fproforma= e.proforma_id
	LEFT JOIN fournisseurs f ON  f.id_fournisseur=p.fournisseur_id
	LEFT JOIN besoins b ON b.id_besoin=p.besoin_id
	LEFT JOIN services s ON s.id_service=b.service_id
	LEFT JOIN ligne_emploi le ON le.id_ligne_emploi=b.emploi_id
	LEFT JOIN besoins bs ON bs.id_besoin=fa.besoin_id
	LEFT JOIN ligne_emploi lem ON lem.id_ligne_emploi=bs.emploi_id
	WHERE c.id_cheque='".$id."'";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}

function retrait_cheque($id,$user,$cheque)
{
	
	global $bdd;
	$bdd->query('SET NAMES UTF8');
	$sql = "INSERT INTO livraison_cheque (cheque_id,cheque,date_livraison_cheque,initiateur_lch)
    VALUES('" . $id. "','" . $cheque. "','" . gmdate('Y-m-d') . "','" . $user . "')";
	$requete = $bdd->query($sql);
	$rep=($requete)?1:0;
    return $rep;
}
function cheque_retire()
{
	global $bdd;
	$sql = "SELECT * FROM livraison_cheque lc
	LEFT JOIN cheques c ON c.id_cheque=lc.cheque_id
	";
	$requete = $bdd->query($sql);
	$resultats = $requete->fetchAll();
	return $resultats;
}




/**************fin gestion Facturation cheque*/