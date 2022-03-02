<?php
/*
	Type fichier : php
	Fonction : page profil
	Emplacement : /
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : nonx
	CSS : oui
*/
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
		include 'php/error.php';
		/*require 'php/connectcookie.php';
		include 'php/base.php';
		include 'php/css.php';
		include 'php/js.php';
		require 'php/database.php';

	    $key = $_GET['key'];

	    require ('php/inject.php'); //0) ajouter inject et définir redirect
		$redirect = 'resetpassword.php';

		$inject = array();
		$returnval = inject($key, 'num'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
		if (!is_null($returnval)) 
		{
		  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
		}
		$validate = validate($inject, $redirect); //3)validation de tous les champs
		if($validate == 0) //4) si pas d'injection : ajout des variables
		{
		  $key = mysqli_real_escape_string($con, $key); 
		}

	    $valide = 0;

	    if(isset($_SESSION['pseudo']) && $key)
		{
			setcookie('contentMessage', 'Erreur: il est impossible de réinitialiser son mot de passe tout en étant connecté', time() + 15, "/");
			header("Location: profil.php");
			exit("Erreur: il est impossible de réinitialiser son mot de passe tout en étant connecté");
		}*/
		?>
		
	</head>
	<header>
		<?php include('contenu/header.php'); ?> 
	</header>
	<body>
		<?php include 'contenu/reseaux.php'; ?>
		<div id="main">
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
						$sql = "UPDATE oublimdp SET actif = 0 WHERE mail = '$mail' AND actif = 1"; //on enlève le mode actif pour la clé qui vient dêtre utilisée
						$query = mysqli_query($con, $sql);
					}
					else
					{
						setcookie('contentMessage', 'Votre lien a expiré ou une erreur inconnue s\'est produite, merci de recliquer sur le lien ou de vous en faire renvoyer un nouveau', time() + 15, "/");
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
		</div>
	</body>
	<?php include('contenu/footer.html');
	require "action/messages.php"; ?>
</html>