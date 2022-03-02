<?php
/*
	Type fichier : php 
	Fonction : inscription utilisateur
	Emplacement : /
	Connexion à la BDD :  non
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
			if(isset($_SESSION['pseudo']))
			{
				header("Location: profil.php");
			}
		?>
		<link rel="stylesheet" type="text/css" href="css/body/inscrire.css">
	</head>
	<body>
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<?php
		if(isset($_SESSION['pseudo']) == null)
		{?>
			<?php include 'contenu/reseaux.php'; ?>
			<div id="main"> 
					 <?php 
					 	if(!empty($_GET['message'])) 
					 	{
							$message = $_GET['message'];
							 echo '<p class="message"> '.$message.'</p>';
						}
						$email = $_GET['mail'];
						$pseudo = $_GET['pseudo'];
					?>
					
				<div class="indentfi">
					<form action="action/ident.php" method="post" class="connect">
						<h1>Inscription</h1> 
		  			 	<label for="pseudo">Pseudo (3 caractères minimum) <span class="star">*</span></label> 
		    			<input type="text" name="pseudo" <?php if(!$pseudo){echo 'placeholder="Entrez votre pseudo"';} else{echo 'value="' . $pseudo . '"'; }?> id="pseudo" required>
		    			<br>
		    			<br>
		    			<label for="mail">Email <span class="star">*</span></label> 
		    			<input type="email" name="email" <?php if(!$email){echo 'placeholder="Entrez votre email"';} else{echo 'value="' . $email . '"'; }?> id="mail" required>
		    			<br>
		    			<br>
		    			<label for="password">Mot de passe <span class="star">*</span></label> 
		    			<input type="password" name="password" placeholder="Mot de passe" id="password" required>
		  				<br>

		    			<br>
		    			<label for="cpassword">Confirmez votre mot de passe <span class="star">*</span></label> 
		    			<input type="password" name="cpassword" placeholder="Confirmez votre mot de passe" id="cpassword" required>
		    			<br>
		    			<br>
						<input  type="submit" value="Inscription" name="inscription" id="inscription">
					</form>
				</div>
			</div>
			<?php  
		}
		include('contenu/footer.html');
		//require "action/messages.php";?> 
	</body>
</html>
