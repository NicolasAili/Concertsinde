<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Profil</title>
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="profil" />
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/body/profil.css" media="screen" />	
	</head>
	<header>
		<?php include('header.php'); ?>
	</header>
		<body>
			<h1>Profil de <?php echo $_SESSION['pseudo']; ?> : </h1><hr />
				<?php 
				 	if(!empty($_GET['message'])) 
				 	{
						$message = $_GET['message'];
						 echo '<p class="message"> '.$message.'</p>';
					}
				?>

			<form action="modif.php" method="post" class="connect">
			<p>Votre pseudo est : <?php echo $_SESSION['pseudo']; ?>, voulez-vous le modifier? </p>
			</br>
			<label for="pseudo">Nouveau pseudo:  </label> 
			<input type="text" name="chpseudo" placeholder="Entrer nouveau pseudo"   id="pseudo" >
			<input  type="submit" value="Modifier" name="modif_pseudo">
			</br>
			</br>
			<p>Souhaitez vous modifier votre mot de passe ? </p>
			<label for="password">Mot de passe actuel:  </label> 
			<input type="password" name="password" placeholder="Mot de passe actuel"   id="password" >
			</br>
			<label for="password">Nouveau mot de passe :  </label> 
			<input type="password" name="newpassword" placeholder="Nouveau mot de passe"   id="newpassword" >
			</br>
			<label for="password">Confirmer nouveau mot de passe :  </label> 
			<input type="password" name="cnewpassword" placeholder="Confirmer ouveau mot de passe"   id="cnewpassword" >
			<input  type="submit" value="Modifier" name="modif_password">
			</br>		
			</form>

	
		</body>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>
