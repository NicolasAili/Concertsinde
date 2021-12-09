<?php
/*
	Type fichier : php
	Fonction : page profil
	Emplacement : /
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui
*/
?>
<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'contenu/reseaux.php';
			require('php/database.php');
			require('php/error.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/resetpassword.css">
	</head>
	<header>
		<?php include('contenu/header.php'); ?> 
	</header>
	<body>
		<form action="action/modif.php" method="post" class="connect">
			<h1> Modifier votre mot de passe </h1>
			<div id="actual">
				<label for="password">Mot de passe actuel</label> 
				<input type="password" name="password" id="password">
			</div>
			<div id="new">
				<label for="password">Nouveau mot de passe</label>
				<br> 
				<input type="password" name="newpassword" id="newpassword" >
			</div>
			<div id="confirm">
				<label for="password">Confirmer le nouveau mot de passe</label> 
				<br>
				<input type="password" name="cnewpassword" id="cnewpassword" >
			</div>
			<br> 
			<div id="formaction">
				<input id="confirmsub" type="submit" value="✔ Valider" name="modif_password">
			</div>		
		</form>
	</body>
	<?php include('contenu/footer.html'); ?>
</html>