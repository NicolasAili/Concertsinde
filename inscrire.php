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
				?>
				
			<div class="indentfi">
				<form action="ident.php" method="post" class="connect">
	  			 	<label for="pseudo">Pseudo: (16 caractères maximum) </label> 
	    			<input type="text" name="pseudo" placeholder="Entrer pseudo"   id="prenom" >
	    			<br>
	    			<br>
	    			<label for="email">Email:  </label> 
	    			<input type="email" name="email" placeholder="Entrer email" id="mail" >
	    			<br>
	    			<br>
	    			<label for="password">Mot de passe: (8 caractères minimum)</label> 
	    			<input type="password" name="password" placeholder="Entrer mdp" id="password" >
	  				<br>

	    			<br>
	    			<label for="cpassword">Confirmez votre mot de passe:  </label> 
	    			<input type="password" name="cpassword" placeholder="Confirmer mdp" id="password" >
	    			<br>
	    			<br>
					<input  type="submit" value="s'inscrire" name="inscription">
				</form>
			</div>

		</body>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>