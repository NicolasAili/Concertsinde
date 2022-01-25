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
		<title>Gestion des erreurs</title>
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
			<h1> Ajouter une actu </h1>
			
			<form enctype="multipart/form-data" method="POST" class="newsajout" action="newsajout.php">
				<h3> Type </h3>
				<select id="type" name="type">
				  <option value="site">site</option>
				  <option value="scene">scene</option>
				</select>
				<h3> Image </h3>
				<input name="userfile" type="file" />
				<h3> Rubrique </h3>
				<select id="rubrique" name="rubrique">
				  <option value="Maj">Mise à jour</option>
				  <option value="Maintenance">Maintenance</option>
				  <option value="Actualité">Actualité</option>
				  <option value="Sondage">Sondage</option>
				  <option value="Clip">Clip</option>
				  <option value="Concert">Concert</option>
				  <option value="Festival">Festival</option>
				  <option value="Album">Album</option>
				  <option value="Tournée">Tournée</option>
				  <option value="Divers">Divers</option>
				</select>
				<h3> Titre </h3>
				<input type="text" name="titre">
				<h3> Sous-titre </h3>
				<textarea name="soustitre" id="soustitre"></textarea>
				<h3> Contenu </h3>
				<textarea name="contenu" id="contenu"></textarea>
				<input type="submit" name="submit" value="ajouter">
			</form><?php
		}
		else
		{
			echo "accès non autorisé";
			echo "<a href='saccueil.php'>retour accueil</a>";
		}?>
	</body>
</html>
