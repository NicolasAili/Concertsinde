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
			include 'php/error.php';
			require 'php/connectcookie.php';
			include 'php/base.php';
			include 'php/css.php';
			include 'php/js.php';
			require 'php/database.php';
		?>
		<link rel="stylesheet" type="text/css" href="css/body/oubli.css">
	</head>
	<?php
	if(isset($_SESSION['pseudo']) == null)
	{?>
		<body>
			<header>
				<?php include('contenu/header.php'); ?>
			</header>
			<?php include 'contenu/reseaux.php'; ?>
			<div id="main">
				<div id="reset">
					<h2> Réinitialisation </h2>
					<h5> Email </h5>
					<form class="email" action="action/sendmail.php" method="post">
						<input class="emailinput" type="email" name="mail">
						<hr>
						<input class="submit" name="search" type="submit" value="✔ Envoyez-moi un lien">
					</form>
				</div>
			</div>
			<?php 
			require "action/messages.php";
			include('contenu/footer.html');
			?> 
		</body><?php
	}
	else
	{
		header("Location: profil.php");
	}?>
</html>

<?php

/* 

Page artiste :

- plusieurs artistes :

	2) afficher concert
		> page artistes //mercredi
		- revoir les filtres allconcerts //mercredi
		- affichage resultats par page //jeudi

	3) supprimer concert //jeudi
		-concert supprimé, retour avec locate sur allconcerts //jeudi
	4) modifier concert //jeudi (au moins une partie)

	- getdata sur les plusieurs artistes //vendredi
________________________________________________________________
- regler probleme de l'affichage en anglais des champs date et heure dans ajoutconcert //vendredi
- filtre: souligner //vendredi
- chercher artiste : autocomplete //vendredi
- réinitialisation mail vraiment laid //vendredi


Suivi fichiers modifiés depuis dernier ftp :

- database php
- concert php
- 

*/