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

	effacer tous les champs probleme dans modifconcert


	gérer les modfis points etc...

	- getdata sur les plusieurs artistes //vendredi
	-getdata sur 
________________________________________________________________
- regler probleme de l'affichage en anglais des champs date et heure dans ajoutconcert //vendredi
- mettre (1) dans titre de la page (onglet) si notification
- filtre: souligner //vendredi
- chercher artiste : autocomplete //vendredi
- réinitialisation mail vraiment laid //vendredi
- dans ajoutconcert, si salle pas en BDD mettre placeholder dans ville "veuillez renseigner la ville"
-concerts ajoutés depuis profil ne fonctionne pas
-update la BDD sur le site en ligne
-enlever commentaire https connexion
-editer marche pas?
trier tickets superadmin par ordre decroissant

amélioration :

	vérifier qu'un artiste a pas de conflit avec un autre concert (heure + date)

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

*/