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

/* ____________________________________

-ajouter les concerts
-reset oubli php
-github
-upload oubli php

_________________________________________________


Suivi fichiers modifiés depuis dernier ftp :

	modifié :         ajoutconcert.php
	modifié :         allconcerts.php
	modifié :         artistes.php
	modifié :         classement.php
	modifié :         connexion.php 
    modifié :         contact.php
    modifié :         inbox.php
	modifié :         inboxmsg.php
	modifié :         index.php
	modifié :         inscrire.php
	modifié :         modifconcert.php
	modifié :         modifconcert.php
	modifié :         news.php
	modifié :         newscontent.php
	modifié :         nojs.php
	modifié :         oubli.php
	modifié :         presentation.php
	modifié :         profil.php
	modifié :         searchresult.php
	modifié :         supartiste.php
	modifié :         support.php
	modifié :         supportshow.php
	modifié :         resetpassword.php

	modifié :         css/body/ajoutconcert.css
	modifié :         css/body/allconcerts.css
	modifié :         css/body/superartiste.css
    modifié :         css/footer.css
	modifié :         css/formulaire.css
    modifié :         css/header.css
    modifié :         css/main.css
    modifié :         css/reseaux.css
	modifié :         css/body/modifconcert.css
	modifié :         css\body\modifconcertvalid.css


	modifié :         php/inject.php
    modifié :         php/base.php
	nouveau fichier : php/https.php

	modifié :         action/concert.php
	modifié :         action/getdata.php

	modifié :		  js\scriptform.js
	modifié :         js/verifmodifconcert.js

	modifié :         contenu/reseaux.php

	nouveau fichier : image/favicon.png

	modifié :         superadmin/contact.php

	_______________________________

	Suivi BDD:

	2 tables artistes
	Dans modification ajouter champ + NULL
	Adresse dans salle : NULL



*/