<?php
/*
	Type fichier : php
	Fonction : Page de login
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
			include 'contenu/reseaux.php';
			require('php/database.php');

			if(isset($_SESSION['pseudo']))
			{
				header("Location: profil.php");
			}
		?>
		<link rel="stylesheet" type="text/css" href="css/body/connexion.css">
	</head>
	<body>
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<?php
		if(isset($_SESSION['pseudo']) == null)
		{?>
			<div id="main">
				<h2>Connexion à votre espace membre</h2> 
					 <?php 
					 	if(!empty($_GET['message'])) 
					 	{
							$message = $_GET['message'];
							 echo '<p class="message"> '.$message.'</p>';
						}
					?>
				<div class="formin">
					<form action="action/connect.php" method="post" class="form-example">
		  				<div class="form">
			  			 	<label for="name">Pseudo ou mail : </label> 
			    			<input type="text" name="pseudo" placeholder="Pseudo ou mail" id="prenom" required>
			    			<br>
			    			<br>
			    			<label for="name">Mot de passe : </label> 
			    			<input type="password" name="password" placeholder="Entrer mdp" id="password" required>
		      				<br>
							<div class="connexion"> <input class="bouton" type="submit" value="Connexion" name="connexion"> </div>
						</div>
					</form>
				</div>
				<br>
				<a href="oubli.php" id="oubli">Mot de passe oublié ?</a>
				<div id="inscription">
					<div id="notmember"> 
						Vous n'êtes pas encore membre ? 
					</div>
					<div id="notmemberunder">
						Créez gratuitement votre compte  et bénéficiez de fonctionnalités supplémentaires ! 
						<br>
						<a href=inscrire.php> Inscrivez-vous maintenant ! </a>
					</div>
					<br>
					<div id="bref">
						En créant votre profil vous pourrez accéder à toute une gamme de services :
					  	<ul>
						    <li>
						    	modifier des concerts
						    </li>
						    <li>
						    	gagner des points permettant d’obtenir des récompenses (cd, places de concert, vêtements, bons d’achat etc…) en fonction de votre activité sur le site
						    </li>
						</ul>
						Mais avant tout vous permettrez l'expansion de la scéne du rap indé. Alors inscrivez-vous dès maintenant afin d'aider la communauté ! :)
					</div>
				</div>
			</div>
		<?php 
		}
		include('contenu/footer.html'); ?>
		<?php require "action/messages.php"; ?> 
	</body>	
</html>
