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
			include 'php/base.php'; 
			include 'php/css.php'; 

			require('php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/connexion.css">
	</head>
	<header>
		<?php include('contenu/header.php'); ?> <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<?php require "action/messages.php"; ?> 	
	</header>
	<body>
		 <h1>Connexion</h1> 
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
	  			 	<label for="name">Pseudo : </label> 
	    			<input type="text" name="pseudo" placeholder="Entrer pseudo"   id="prenom" required>
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
		Pas encore inscrit? <a href=inscrire.php> Inscrivez-vous maintenant ! </a>
	</body>
</html>
<script src="js/scrollnav.js"></script> 