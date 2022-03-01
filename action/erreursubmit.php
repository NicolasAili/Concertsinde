<?php
/*
	Type fichier : php
	Fonction : permet d'insérer dans la BDD un contact/problème
	Emplacement : action
	Connexion à la BDD : oui  
	Contenu HTML : non
	JS+JQuery : non
	CSS : non
*/
?>
<?php
	include '../php/error.php';  
	require '../php/connectcookie.php';
	require '../php/database.php';
	
	$type = $_POST['type'];

	$pseudo = $_POST['pseudo'];
	$probleme = $_POST['probleme'];
	$mail = $_POST['mailinput'];
	$sujet = $_POST['sujet'];

	$idconcert = $_POST['idconcert'];

	$artiste = $_POST['artiste'];
	$date = $_POST['date'];
	$heure = $_POST['heure'];
	$salle = $_POST['salle'];
	$ville = $_POST['ville'];
	$cp = $_POST['cp'];
	$departement = $_POST['departement'];
	$region = $_POST['region'];
	$pays = $_POST['pays'];
	$adresse = $_POST['adresse'];
	$lien_fb = $_POST['lien_fb'];
	$lien_ticket = $_POST['lien_ticket'];

	require ('../php/inject.php'); //0) ajouter inject et définir redirect
	$redirect = '../allconcerts.php';

	$values = array($pseudo, $sujet); //1) mettre données dans un arrray
	$inject = inject($values, null); //2) les vérifier

	$returnval = inject($probleme, 'text'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
    if (!is_null($returnval)) 
    {
      array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
    }
    $returnval = inject($mail, 'mail'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
    if (!is_null($returnval)) 
    {
      array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
    }

    $validate = validate($inject, $redirect); //3)validation de tous les champs
    if($validate == 0) //4) si pas d'injection : ajout des variables
    {
      $pseudo = mysqli_real_escape_string($con, $pseudo); 
      $probleme = mysqli_real_escape_string($con, $probleme);
      $mail = mysqli_real_escape_string($con, $mail); 
      $sujet = mysqli_real_escape_string($con, $sujet); 
    }

	$erreur = 0;

	if ($artiste && $artiste != 'artiste') 
	{
		$erreur = 1;
	}
	if ($date && $date != 'date') 
	{
		$erreur = 1;
	}
	if ($heure && $heure != 'artiste') 
	{
		$erreur = 1;
	}
	if ($salle && $salle != 'salle/denomination') 
	{
		$erreur = 1;
	}
	if ($ville && $ville != 'ville') 
	{
		$erreur = 1;
	}
	if ($cp && $cp != 'code_postal') 
	{
		$erreur = 1;
	}
	if ($departement && $departement != 'departement') 
	{
		$erreur = 1;
	}
	if ($region && $region != 'region') 
	{
		$erreur = 1;
	}
	if ($pays && $pays != 'pays') 
	{
		$erreur = 1;
	}
	if ($adresse && $adresse != 'adresse') 
	{
		$erreur = 1;
	}
	if ($lien_fb && $lien_fb != 'lien de l\'evenement') 
	{
		$erreur = 1;
	}

	if ($lien_ticket && $lien_ticket != 'lien vers la billetterie') 
	{
		$erreur = 1;
	}

	if ($erreur == 1) {
		setcookie('contentMessage', 'Erreur', time() + 15, "/");
		header("Location: ../allconcerts.php");
		exit("Erreur");
	}
	

	if(!$mail)
	{
		$mail = "NULL";
	}

	$sql = "SELECT ID_user FROM utilisateur WHERE pseudo = '$pseudo'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$idpseudo = $row['ID_user'];

	$insert = "INSERT INTO probleme (type, id_concert, probleme, sujet, utilisateur, mail, date_envoi, artiste, date, heure, salle, ville, cp, departement, region, pays, adresse, lien_fb, lien_ticket, autre) VALUES ('$type', '$idconcert', '$probleme', '$sujet', '$idpseudo', '$mail', NOW(), '$artiste', '$date', '$heure', '$salle', '$ville', '$cp', '$departement', '$region', '$pays', '$adresse', '$lien_fb', '$lien_ticket', '$autre')"; 
	mysqli_query($con, $insert);
	echo $insert;

	$sql = "SELECT MAX(id) AS id_max FROM probleme";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
	$max = $row['id_max'];

	setcookie('contentMessage', 'Votre requête a bien été enregistrée sous le numéro #' . $max .', vous pouvez la retrouver ainsi que toutes vos autres requêtes dans la section "requête" sous votre profil', time() + 15, "/");
	header("Location: ../allconcerts.php");
	exit('Votre requête a bien été enregistrée sous le numéro #' . $max .', vous pouvez la retrouver ainsi que toutes vos autres requêtes dans la section "requête" sous votre profil');

