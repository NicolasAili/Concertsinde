<?php
/*
	Type fichier : php
	Fonction : Permet de s'envoyer un nouveau mot de passe, et de rentrer son nouveau mot de passe
	Emplacement : /
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui
*/
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'contenu/reseaux.php';
			require('php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/connexion.css">
	</head>
	<body>
		<header>
			<?php include('contenu/header.php'); ?>
			<?php require "action/messages.php"; ?> 
		</header>
		<div id="reset">
			<h2> Entrez l'adresse mail liée à votre compte </h2>
			<h5> Courriel </h5>
			<form class="searchbar" action="action/sendmail.php" method="post">
				<input class="champ"  type="recherche" name="mail">
				<input class="o-search-submit" name="search" type="submit" value="Envoyez-moi un lien">
			</form>
		</div>
		<?php 
		require "action/messages.php";
		include('contenu/footer.html');
		?> 
	</body>
</html>