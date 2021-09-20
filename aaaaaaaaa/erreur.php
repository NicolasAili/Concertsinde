<?php
/*
	Type fichier : php
	Fonction : signaler une erreur
	Emplacement : /
	Connexion à la BDD : non
	Contenu HTML : oui
	JS+JQuery : non
	CSS : non
*/
?>
<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
				<title>Erreur</title>
				<meta name="Author" content="BUSQUET_TOURNU" />
				<meta name="Keywords" content="ConcertAll" />
				<meta name="Description" content="Ereur" />
				<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
				<link rel="stylesheet" type="text/css" href="css/body/erreur.css" media="screen" />	
				<script type="text/javascript" src="js/scriptform.js"></script> 	
				<!-- Script -->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
						<!-- jQuery UI -->
				<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
				<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	</head>
	<header>
		<?php include('contenu/header.php'); ?>
	</header>	
	<body>
		<?php			
			require('php/database.php');
		?>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<h1> Contactez nous ! </h1>
		<form action="action/erreursubmit.php" method="post">
			<fieldset>
				<legend>Rapporter un problème</legend>
					<p>
						<label for="probleme">Quelle est la nature du problème rencontré?</label><br />
						<textarea name="probleme" id="probleme" cols="40" rows="5" required="true"></textarea>
					</p>
					<p>
						<label for="etapes">Dans le cas d'un problème technique, pourriez-vous décrire les étapes qui ont conduit à l'apparition du problème ?</label><br />
						<textarea name="etapes" id="etapes" cols="40" rows="5"></textarea>
					</p>
					<p>
						<label for="ajout">Si vous souhaitez ajouter quoi que ce soit d'autre</label><br />
						<textarea name="ajout" id="ajout" cols="40" rows="5"></textarea>
					</p>
					<div id=showmail>
						<?php if(isset($_SESSION['pseudo']) == null)
						{
							echo "<br>";
							echo "Il semble que vous ne soyez pas connecté, saisissez votre mail ci-dessous ou connectez-vous";
							echo "<br>";?>
							<input type="mail" name="mailinput" id="mailinput" value=""><?php
						}
						?>
					</div> 
					<?php
					if(isset($_SESSION['pseudo']))
					{?>
						<input type="hidden" id="pseudo" name="pseudo" <?php echo 'value="' . $_SESSION['pseudo'] . '"' ?>> <?php
					}
					else
					{?>
						<input type="hidden" id="pseudo" name="pseudo" value="anonyme"> <?php
					}?>
					<input type="hidden" id="type" name="type" value="2"> 
					
			</fieldset>
			<p>	
				Merci pour votre contribution <br />
			</p>
			<p>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Envoyer" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Effacer" />
			</p>
		</form>
	</body>
</html>
<script src="js/scrollnav.js"></script> 

