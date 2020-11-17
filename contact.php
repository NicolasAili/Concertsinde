<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
				<title>contact</title>
				<meta name="Author" content="BUSQUET_TOURNU" />
				<meta name="Keywords" content="ConcertAll" />
				<meta name="Description" content="Contact" />
				<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
				<link rel="stylesheet" type="text/css" href="css/body/contact.css" media="screen" />		
	</head>
	<header>
		<?php include('header.php'); ?>
	</header>	
	<body>
		<h1> Contactez nous ! </h1>
		<form action="mailto:paul.tournu@orange.fr?subject=Formulaired'appréciation" method="post">
			<fieldset>
				<legend>Informations personelles</legend>
					<p>
						<label for="Nom">Pseudo : </label>
						<div class="inputx"> <input type="text" name="Nom" id="Nom" size="30" autofocus /> </div>
					</p>
					<p>
						<label for="email">Adresse E-mail : </label>
						<div class="inputx"> <input type="email" name="email" id="email" size="50" required /> </div>
					</p>
			</fieldset> <br />
			<fieldset>
				<legend>Appréciation sur le site Web</legend>
					<p>
						Appréciation globale du site: <br />
						<input type="radio" name="glo" value="Très utile" id="Très_utile" /><label for="Très_utile">Très utile</label>
						<input type="radio" name="glo" value="Utile" id="Utile" /><label for="Utile">Utile</label>
						<input type="radio" name="glo" value="Inutile" id="Inutile" /><label for="Inutile">Inutile</label>
						<br />
					</p>
					<p>
						Ce site vous a-t-il aidé à trouver un concert ? <br />
						<input type="radio" name="glo" value="Oui" id="Oui" /><label for="Oui">oui</label>
						<input type="radio" name="glo" value="Non" id="Non" /><label for="Non">non</label>
					</p>
					<label for="appréciation">Qu'avez-vous le plus apprécié sur le site wab ? </label><br />
					<select id="appréciation" multiple="multiple" name="appréciation">
						<option value="contenu">Le contenu informatif</option>
						<option value="thème">Le thème graphique du site</option>
						<option value="navigation">La navigation à l'intérieur du site </option>
					</select>
					<p>
						<label for="non">Après avoir donné votre avis sur le site, voulez-vous ajouter quelque chose ?</label><br />
						<textarea name="commentaire" id="commentaire" cols="40" rows="5"></textarea>
					</p>
			</fieldset>
			<p>	
				Merci pour votre contribution <br />
				<input type="checkbox" id="info" name="info" />
				<label for="info"> Je souhaite recevoir plus d'informations sur l'évolution de notre site web</label>
			</p>
			<p>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Envoyer" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Effacer" />
			</p>
		</form>
	</body>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>