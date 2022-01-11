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
    $key = $_GET['key'];
    $valide = 0;

    if(isset($_SESSION['pseudo']) && $key)
	{
		setcookie('contentMessage', 'Erreur: il est impossible de réinitialiser son mot de passe tout en étant connecté', time() + 30, "/");
		header("Location: profil.php");
		exit("Erreur: il est impossible de réinitialiser son mot de passe tout en étant connecté");
	}
?>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'contenu/reseaux.php';
			require('php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/resetpassword.css">
	</head>
	<header>
		<?php include('contenu/header.php'); ?> 
	</header>
	<body>
		<form action="action/modif.php" method="post" class="connect">
			<?php
			if($key)
			{
				$sql = "SELECT mail FROM oublimdp WHERE keyid = $key AND actif = 1";
				$query = mysqli_query($con, $sql);
				if($row = mysqli_fetch_array($query))
				{
					$mail = $row['mail'];
					$valide = 1;
					$sql = "UPDATE oublimdp SET actif = 0 WHERE mail = '$mail' AND actif = 1";
					$query = mysqli_query($con, $sql);
				}
				else
				{
					setcookie('contentMessage', 'Une erreur inconnue s\'est produite, merci de recliquer sur le lien ou de vous en faire renvoyer un nouveau', time() + 30, "/");
					header("Location: oubli.php");
					exit("Une erreur inconnue s\'est produite, merci de recliquer sur le lien ou de vous en faire renvoyer un nouveau");
				}
			}
			if ($valide == 0) 
			{?>
				<h1> Modifier votre mot de passe </h1>
				<div id="actual">
					<label for="password">Mot de passe actuel</label> 
					<input type="password" name="password" id="password">
				</div><?php
			}
			else
			{
				echo "<h1> Réinitialiser votre mot de passe </h1>";
				
			}?>
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
			<input id="mail" type="hidden" <?php echo 'value="' . $mail . '"' ?> name="mail">
			<input id="key" type="hidden" <?php echo 'value="' . $key . '"' ?> name="key">	
		</form>
	</body>
	<?php include('contenu/footer.html');
	require "action/messages.php"; ?>
</html>