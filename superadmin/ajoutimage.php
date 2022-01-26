<?php
/*
	Type fichier : php
	Fonction : gestion des news
	Emplacement : supermadmin
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : non
*/
    session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gestion des actualités</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="contact.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />	
		<!--<script type="text/javascript" src="./jquery/jquery.min.js"></script>
		<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="./jquery/jquery-ui.css" media="screen" />-->		
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
	</head>
	<body>
		<?php
		require('../php/database.php');
		$pseudo = $_SESSION['pseudo'];
		$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
		$result = mysqli_query($con ,$sql);
		$row = mysqli_fetch_array($result);

		if($row['admin'] == 2)
		{?>
			<a href='saccueil.php'>retour accueil</a>
			<h1> !!!!! PNG avec 1ere lettre majuscule pour les 2 !!!!! </h1>
			<h1> Ajouter une image d'artiste </h1>
			
			<form enctype="multipart/form-data" method="POST" class="ajoutimagephp" action="ajoutimagephp.php">
				<h3> Image artiste</h3>
				<input name="userfile" type="file" />
				<input type="submit" name="submit" value="ajoutartiste">
			</form>
			<hr>
			<br>
			<h1> Ajouter un drapeau </h1>
			<form enctype="multipart/form-data" method="POST" class="ajoutimagephp" action="ajoutimagephp.php">
				<h3> Image drapeau </h3>
				<input name="userfile" type="file" />
				<input type="submit" name="submit" value="ajoutdrapeau">
			</form>
			<?php
		}?>
	</body>
</html>