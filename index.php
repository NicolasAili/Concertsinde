<?php 
/*
	Type fichier : php
	Fonction : page accueil
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
			include 'php/https.php';
			include 'php/error.php';
			require 'php/connectcookie.php';
			include 'php/base.php';
			include 'php/css.php'; 
			include 'php/js.php';
			require 'php/database.php';
		?>
		<link rel="stylesheet" type="text/css" href="css/body/accueil.css">
	</head>
	<body>
		<header>
			<h1> <a href="index.php" id="logo"> Arpenid <span id="com">.com</span></a> </h1>
			<div id="corps">
				<a href="presentation.php" class="li"><div class="txtli">Fonctionnement</div></a>
				<a href="news.php" class="li"><div class="txtli">Actualités</div></a>
				<a href="artistes.php" class="li"><div class="txtli">Artistes</div></a>
				<a href="allconcerts.php" class="li"><div class="txtli">Concerts</div></a>
				<a href="classement.php" class="li"><div class="txtli">Classement</div></a>
			</div>
			<div id="cnx">
				<?php 
				if (isset($_SESSION['pseudo']) == null)
				{?>
					<a href="./connexion.php" class="spacelink" role="button"> <span class="login"> Connexion </span> </a><?php
				}
				else
				{?>
					<a href="./profil.php" class="spacelink" role="button"> <span class="login"> Profil </span> </a><?php
				}?>
			</div>
		</header>
		<?php include 'contenu/reseauxwhite.php'; ?>
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
					<img src="image/transition.png" width="50" height="50" alt="fleche">
					<span> Gagnez des points </span>
					<img src="image/transition.png" width="50" height="50" alt="fleche">
					<span> Obtenez des récompenses </span>
				</div>
			</div>
		</div>
		<script>
			$( document ).ready(function() {
		        var width = $(window).width();
				var height = $(window).height();
				$('header').css('width', width);
				$('#main').css('height', height);
				$('#main').css('width', width);
		    });
		    $( document ).ready(function() {
		        var width = $(window).width();
				var height = $(window).height();
				if (width<900)
				{
					alert('Le site mobile n\'est pas encore fonctionnel, vous pouvez néanmoins naviguer librement sur le site. Tips: allez dans les options de votre navigateur et cochez "afficher la version pour ordinateur"');
				}
		    });

		    $(window).resize(function() 
		    {
		    	var width = $(window).width();
				var height = $(window).height();
				$('header').css('width', width);
				$('#main').css('height', height);
				$('#main').css('width', width);
			});
		</script>
	</body> 
</html>


