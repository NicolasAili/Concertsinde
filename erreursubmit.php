<?php
/*
	Type fichier : 
	Fonction : 
	Emplacement : 
	Connexion à la BDD :  
	Contenu HTML : 
	JS+JQuery : 
	CSS : 
*/
?>
<?php
    session_start();
?>
<?php
		      
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'webbd';

	//Connexion à la BDD
	$con = mysqli_connect($servername, $username, $password, $dbname);

	//Vérification de la connexion
	if(mysqli_connect_errno($con)){
	echo "Erreur de connexion" .mysqli_connect_error();
	}
	$type = $_POST['type'];

	$pseudo = $_POST['pseudo'];
	$probleme = $_POST['probleme'];
	$etapes = $_POST['etapes'];
	$ajout = $_POST['ajout'];
	$mail = $_POST['mailinput'];
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
	$autre = $_POST['autre'];

	if(!$mail)
	{
		$mail = "NULL";
	}

	$sql = "SELECT ID_user FROM utilisateur WHERE pseudo = '$pseudo'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$idpseudo = $row['ID_user'];

	$insert = "INSERT INTO probleme (type, id_concert, probleme, etapes, ajout, utilisateur, mail, date_envoi, artiste, date, heure, salle, ville, cp, departement, region, pays, adresse, lien_fb, lien_ticket, autre) VALUES ('$type', '$idconcert', '$probleme', '$etapes', '$ajout', '$idpseudo', '$mail', NOW(), '$artiste', '$date', '$heure', '$salle', '$ville', '$cp', '$departement', '$region', '$pays', '$adresse', '$lien_fb', '$lien_ticket', '$autre')"; 
	mysqli_query($con, $insert);

	setcookie('contentMessage', 'Merci pour votre contribution. Votre aide est très précieuse', time() + 30, "/");
	header("Location: ./allconcerts.php");
	exit("Merci pour votre contribution. Votre aide est très précieuse");
			

