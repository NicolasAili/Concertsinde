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
			/*include 'php/error.php';
			require 'php/connectcookie.php';
			include 'php/base.php';
			include 'php/css.php';
			include 'php/js.php';
			require 'php/database.php';*/
		?>
		<link rel="stylesheet" type="text/css" href="css/body/oubli.css">
	</head>
	<?php
	/*if(isset($_SESSION['pseudo']) == null)
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
	}*/?>
	Désolé, cette fonctionnalité est encore en cours d'implémentation. Merci de <a href="contact.php">me contacter</a> en précisant votre mail (identique à celui utilisé lors de votre inscription).
</html>

<?php

/* ____________________________________


Suivi fichiers modifiés depuis dernier ftp :

modifié :         action/detectsalle.php
#       modifié :         action/getdata.php
#       modifié :         ajoutconcert.php
#       modifié :         allconcerts.php
#       modifié :         contenu/reseaux.php
#       nouveau fichier : contenu/reseauxwhite.php
#       modifié :         css/body/allconcerts.css
#       modifié :         css/body/superartiste.css
#       modifié :         index.php
#       modifié :         js/scriptform.js
#       modifié :         modifconcert.php
#       modifié :         oubli.php
#       modifié :         php/inject.php
#       modifié :         supartiste.php
#       modifié :         superadmin/salles.php
#       modifié :         superadmin/sallesmodif.php



______________________________________________

	Suivi BDD:



*/