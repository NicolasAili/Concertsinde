<!DOCTYPE html>
<html>
	<head>
		<title>Recap</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/ajoutconcert.css" media="screen" />	
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
		<script type="text/javascript" src="./js/scriptform.js"></script> 
		<!-- Script -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<!-- jQuery UI -->
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<?php //include("concert.php"); // on appelle le fichier?>
	</head>
	<header>
		<?php include('header.php'); ?>
	</header>	
	<body>
		<div class="indentfi">
			 <h1>Ajout d'un concert</h1>
			 <form method="post" class="connect" action="concert.php">
				<label for="artiste">*Nom de l'artiste ou du groupe:  </label> 
				<input type="text" name="artiste" placeholder="Saisir l'artiste"   id="artiste" required>
				<br>
				<br>
				<label for="date">*Date : </label> 
				<input type="date" name="date" placeholder="Saisir la date du concert " id="date" required>
				<br>
				<br>
				<label for="heure">Heure : </label> 
				<input type="time" name="heure" placeholder="Saisir l'heure du concert" id="heure">
				<br>
				<br>
				<div id="ext"> Cochez la case suivante si le concert se passe en EXTERIEUR ou/et hors d'une salle de concert (festival, concert sauvage, concert en extérieur etc...):   <input type="checkbox" id="scales" name="scales" onclick="checkbox();">
				<br>
				<label for="salle">Salle : </label> 
				<input type="text" name="salle" placeholder="Salle où a lieu le concert" onblur="getleave();" onkeyup="getdata();" id="salle" required>
				<br>
				<div id="res"> </div>
				<br>
				<div id="infos">
					<label for="pays">Pays: </label> 
					<input type="text" name="pays" placeholder="Pays où a lieu le concert" id="pays">
					<br>
					<label for="region">Region: </label> 
					<input type="text" name="region" placeholder="Région où a lieu le concert" id="region">
					<br>
					<label for="departement">Departement: </label> 
					<input type="text" name="departement" placeholder="Département où a lieu le concert" id="departement">
					<br>
					<label for="adresse">Adresse: </label> 
					<input type="text" name="adresse" placeholder="Adresse où a lieu le concert" id="adresse">
					<br>
					<label for="cp">Code postal: </label> 
					<input type="text" name="cp" placeholder="Code postal où a lieu le concert" id="cp">
					<br>
					<br>
					<label for="ville">*Ville : </label> 
					<input type="text" name="ville" placeholder="Ville où a lieu le concert" id="ville">
					<br>
				</div>
				<br>
				<label for="fb">Lien de l'evenement (facebook ou autres) : </label> 
				<input type="text" name="fb" placeholder="Lien de l'événement" id="fb">
				<br>
				<label for="ticket">Lien de la billetterie : </label> 
				<input type="text" name="ticket" placeholder="Lien de l'événement" id="ticket">
				<br>
				<input  type="submit" value="Enregister le concert" name="concert" href="">
			</form>
		</div>
	</body>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>