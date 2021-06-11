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

	$pseudo = $_POST['pseudo'];
	$probleme = $_POST['probleme'];
	$etapes = $_POST['etapes'];
	$ajout = $_POST['ajout'];
	$mail = $_POST['mailinput'];
	if(!$mail)
	{
		echo "ok";
		$mail = "NULL";
	}
	$pseudo = $_POST['pseudo'];

	$sql = "SELECT ID_user FROM utilisateur WHERE pseudo = '$pseudo'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$idpseudo = $row['ID_user'];

	$insert = "INSERT INTO probleme (probleme, etapes, ajout, utilisateur, mail) VALUES ('$probleme', '$etapes', '$ajout', '$idpseudo', '$mail')"; 
	mysqli_query($con, $insert);

	setcookie('contentMessage', 'Merci pour votre contribution. Votre aide est très précieuse', time() + 30, "/");
	header("Location: ./allconcerts.php");
	exit("Merci pour votre contribution. Votre aide est très précieuse");
			

