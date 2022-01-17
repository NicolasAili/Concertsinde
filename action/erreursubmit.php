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
    session_start();
?>
<?php
		      
	require('../php/database.php');
	
	$type = $_POST['type'];

	$pseudo = $_POST['pseudo'];
	$probleme = $_POST['probleme'];
	$mail = $_POST['mailinput'];
	$sujet = $_POST['sujet'];
	//$mailsuivi = $_POST['mailsuivi'];

	$idconcert = $_POST['idconcert'];

	$artiste = $_POST['artiste'];
	$date = $_POST['date'];
	echo $date;
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

	$sql = "SELECT MAX(id) AS id_max FROM probleme";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
	$max = $row['id_max'];

	setcookie('contentMessage', 'Votre requête a bien été enregistrée sous le numéro #' . $max .', vous pouvez la retrouver ainsi que toutes vos autres requêtes dans le section "requête" sous votre profil', time() + 30, "/");
	header("Location: ../allconcerts.php");
	exit('Votre requête a bien été enregistrée sous le numéro #' . $max .', vous pouvez la retrouver ainsi que toutes vos autres requêtes dans le section "requête" sous votre profil');

