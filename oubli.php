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

-enlever commentaire https connexion

-update la BDD sur le site en ligne
-reupload fichiers




amélioration :

	vérifier qu'un artiste a pas de conflit avec un autre concert (heure + date)
	Pouvoir cocher plusieurs concerts pour l'admin et les valider/supprimer en même temps
	- regler probleme de l'affichage en anglais des champs date et heure dans ajoutconcert //vendredi
	- réinitialisation mail vraiment laid //vendredi

_________________________________________________


Suivi fichiers modifiés depuis dernier ftp :

- database php
- concert php
	modifié :         action/concert.php
	modifié :         ajoutconcert.php
	modifié :         allconcerts.php
	modifié :         artistes.php
	modifié :         css/body/ajoutconcert.css
	modifié :         css/body/allconcerts.css
	modifié :         css/body/superartiste.css
	modifié :         oubli.php
	modifié :         supartiste.php
	modifié :         modifconcert.php
	modifié :         php/inject.php
	modifié :         contenu/reseaux.php
	modifié :         css/body/modifconcert.css
	modifié :         modifconcertvalid.php
	modifié :         css\body\modifconcertvalid.css
	modifié :		  js\scriptform.js
	modifié :         index.php
	modifié :         inscrire.php
	modifié :         inboxmsg.php
	modifié :         js/verifmodifconcert.js
	modifié :         news.php
	modifié :         newscontent.php
	modifié :         nojs.php
	modifié :         presentation.php
	modifié :         profil.php
	modifié :         resetpassword.php
	modifié :         searchresult.php
	modifié :         support.php
	modifié :         supportshow.php
	modifié :         action/getdata.php
	modifié :         classement.php
	modifié :         connexion.php 
    modifié :         contact.php
    modifié :         css/footer.css
	modifié :         css/formulaire.css
    modifié :         css/header.css
    modifié :         css/main.css
    modifié :         css/reseaux.css
    modifié :         inbox.php
	_______________________________

	Suivi BDD:

	2 tables artistes
	Dans modification ajouter champ + NULL
	Adresse dans salle : NULL



*/