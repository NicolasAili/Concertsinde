<?php 
/*
	Type fichier : php
	Fonction : actualités du site
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
			include 'php/js.php'; 
			require('php/database.php');
			include 'contenu/reseaux.php';
			session_start();
		?>
		<link rel="stylesheet" type="text/css" href="css/body/news.css">

		
	</head>
	<body>	
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<div id="main">

		</div>
		<?php include('contenu/footer.html'); ?>
	</body>
</html>