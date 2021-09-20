<?php
/*
	Type fichier : php
	Fonction : Permet de contacter l'admin du site
	Emplacement : /
	Connexion à la BDD : non
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui
*/
?>
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 

			require('php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/contact.css">
	</head>
	<header>
		<?php include('contenu/header.php'); ?> <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</header>	
	<body>
		<h1> Contactez nous ! </h1>
		<form action="action/erreursubmit.php" method="post">
			<fieldset>
				<legend>Contact</legend>
				<label for="non">De quoi souhaitez-vous nous faire part ?</label><br />
				<textarea name="probleme" id="probleme" cols="40" rows="5"></textarea>
				<?php
					if(isset($_SESSION['pseudo']))
					{?>
						<input type="hidden" id="pseudo" name="pseudo" <?php echo 'value="' . $_SESSION['pseudo'] . '"' ?>> <?php
					}
					else
					{?>
						<input type="hidden" id="pseudo" name="pseudo" value="anonyme"> <?php
					}
				?>
				<input type="hidden" id="type" name="type" value="3"> 
			</fieldset>
			<p>
					<div id=showmail>
						<?php if(isset($_SESSION['pseudo']) == null)
						{
							echo "<br>";
							echo "Il semble que vous ne soyez pas connecté, saisissez votre mail ci-dessous ou connectez-vous";?>
							<input type="mail" name="mailinput" id="mailinput" value=""><?php
						}
						?>
					</div> 
			</p>
			<p>	
				Merci pour votre contribution <br/>
			</p>
			<p>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Envoyer" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Effacer" />
			</p>
		</form>
	</body>
</html>
<script src="js/scrollnav.js"></script> 