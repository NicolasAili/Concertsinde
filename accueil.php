<?php 
/*
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
	Type fichier : php
	Fonction : page accueil
	Emplacement : /
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui

	a mettre: scrollnav et header
*/
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'php/js.php';
			require('php/database.php');
			require('php/error.php');
			include 'contenu/reseaux.php';
		?>
		<script>
			//alert($(window).width());
		</script>
		<link rel="stylesheet" type="text/css" href="css/body/accueil.css">
	</head>
	<body>
		<header>
			<h1> <a href="accueil.php" id="logo"> Arpenid <div id="com">.com</div></a> </h1>
			<div id="corps">
				<a href="presentation.php" class="li"><div class="txtli">Fonctionnement</div></a>
				<a href="news.php" class="li"><div class="txtli">Actualités</div></a>
				<a href="artistes.php" class="li"><div class="txtli">Artistes</div></a>
				<a href="allconcerts.php" class="li"><div class="txtli">Concerts</div></a>
				<a href="classement.php" class="li"><div class="txtli">Contributeurs</div></a>
			</div>
			<div id="cnx">
				<a href="./connexion.php" class="spacelink" role="button"> <span> Connexion </span> </a>
			</div>
		</header>
		<div id="main">
			<?php
				$pseudo = $_SESSION['pseudo'];
				$requestpseudo = "SELECT id_user FROM utilisateur WHERE pseudo = '$pseudo'";
				$query = mysqli_query($con, $requestpseudo);
				$row = mysqli_fetch_array($query);
				$idpseudo = $row['id_user'];
			?>
			<div id="texte">
				<h1> Arpenid.com </h1>
				<h2> Le rap indé, par le public, pour le public</h2>
				<a class="ajoutconcert" href="ajoutconcert.php"> Ajouter un concert </a>
				<a class="allconcerts" href="allconcerts.php"> Liste des concerts </a>
			</div>
			<div id="bottom">
				<div id="bottomun">
					<span> Participez à l'activité du site </span>
					<img src="image/transition.png" width="50" height="50">
					<span> Gagnez des points </span>
					<img src="image/transition.png" width="50" height="50">
					<span> Obtenez des récompenses </span>
				</div>
				<!--<div id="bottomdeux">
					<span> Mais surtout...</span>
				</div>
				<div id="bottomtrois">
					<span> Soutenez </span> la scène indépendante, <span> supportez </span> les artistes et <span> aidez </span> le public
				</div>-->
			</div>
		</div>
	</body> 
</html>

<script>
	$( document ).ready(function() {
        var width = $(window).width();
		var height = $(window).height();
		$('header').css('width', width);
		$('body').css('height', height);
		$('body').css('width', width);
    });
</script>


