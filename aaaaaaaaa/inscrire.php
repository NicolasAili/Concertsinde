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
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Inscription</title>
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="inscription" />
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/inscrire.css" media="screen" />
	</head>
	<header>
		<?php include('header.php'); ?>
	</header>
		<body>
			 <h1>Inscription</h1>  

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
	  			 	<label for="pseudo">Pseudo: (3 caractères minimum) </label> 
	    			<input type="text" name="pseudo" <?php if(!$pseudo){echo 'placeholder="Entrez votre pseudo"';} else{echo 'value="' . $pseudo . '"'; }?> id="prenom" required>
	    			<br>
	    			<br>
	    			<label for="email">Email:  </label> 
	    			<input type="email" name="email" <?php if(!$email){echo 'placeholder="Entrez votre email"';} else{echo 'value="' . $email . '"'; }?> id="mail" required>
	    			<br>
	    			<br>
	    			<label for="password">Mot de passe: </label> 
	    			<input type="password" name="password" placeholder="Mot de passe" id="password" required>
	  				<br>

	    			<br>
	    			<label for="cpassword">Confirmez votre mot de passe:  </label> 
	    			<input type="password" name="cpassword" placeholder="Confirmez votre mot de passe" id="password" required>
	    			<br>
	    			<br>
					<input  type="submit" value="Inscription" name="inscription">
				</form>
			</div>

		</body>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>