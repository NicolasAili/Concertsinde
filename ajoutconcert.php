<!DOCTYPE html>
<html>
	<head>
		<title>Recap</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/ajoutconcert.css" media="screen" />	
		<?php include("salle.php"); // on appelle le fichier?>
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
		<?php include("concert.php"); // on appelle le fichier?>
	</head>
	<header>
		<?php include('header.php'); ?>
	</header>	
	<body>
		<div class="indentfi">
			 <h1>Ajout d'un concert</h1>
			 <form action="concert.php" method="post" class="connect">
				<label for="artiste">Nom de l'artisite ou du groupe:  </label> 
				<input type="text" name="artiste" placeholder="Saisir l'artiste"   id="artiste" required>
				<br>
				<br>
				<label for="date">Date:  </label> 
				<input type="date" name="date" placeholder="Saisir la date du concert " id="date" required>
				<br>
				<br>
				<label for="heure">Heure</label> 
				<input type="time" name="heure" placeholder="Saisir l'heure du concert" id="heure" required>
				<br>
				<br>
				<label for="pays">Pays: </label> 
				<input type="text" name="pays" placeholder="Pays ou a lieu le concert" id="pays" required>
				<br>
				<label for="ville">Ville: </label> 
				<input type="text" name="ville" placeholder="Ville ou a lieu le concert" id="ville" required>
				<br>
				<label for="salle">Salle: </label> 
				<input type="text" name="salle" placeholder="Salle ou a lieu le concert" id="salle" require>
				<br>
				<label for="adresse">Adresse: </label> 
				<input type="text" name="adresse" placeholder="Adresse ou a lieu le concert" id="adresse" required>
				<br>
				<label for="cp">Code postal: </label> 
				<input type="text" name="cp" placeholder="Code postal ou a lieu le concert" id="cp" required>
				<br>
				<br>
				<input  type="submit" value="Enregister le concert" name="concert" href="">
			</form>
		</div>
	</body>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>