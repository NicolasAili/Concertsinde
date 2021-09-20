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
?>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 

			require('php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/profil.css">
	</head>
	<header>
		<?php include('contenu/header.php'); ?> <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</header>
		<body>
			<?php 
			require('php/database.php');
			?>
			
			<h1>Profil de <?php echo $_SESSION['pseudo']; ?> : </h1><hr />
				<?php 
				 	if(!empty($_GET['message'])) 
				 	{
						$message = $_GET['message'];
						 echo '<p class="message"> '.$message.'</p>';
					}
				?>

			<form action="action/modif.php" method="post" class="connect">
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
		    <?php 
		    $pseudo = $_SESSION['pseudo'];
			$requestpseudo = "SELECT id_user FROM utilisateur WHERE pseudo = '$pseudo'";
			$query = mysqli_query($con, $requestpseudo);
			$row = mysqli_fetch_array($query);
			$idpseudo = $row['id_user'];
			
			$sql = "SELECT date_debut, date_fin FROM session WHERE actif = '1'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$sessiondebut = $row['date_debut'];
			$sessionfin = $row['date_fin'];

			$sql = "SELECT points_session, points FROM utilisateur WHERE ID_user = '$idpseudo'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$points_session = $row['points_session'];
			$points = $row['points'];

			$count = 0;


			?>

			<?php echo '<a href="allconcerts.php?add='; echo $idpseudo; echo '">';?> Voir mes concerts ajoutés </a>
			<?php echo '<a href="allconcerts.php?modif='; echo $idpseudo; echo '">';?> Voir mes concerts modifiés </a>
			<div id="points">
				Total des points pour la session en cours du (<?php echo $sessiondebut; echo " au "; echo $sessionfin; echo ") : "; echo $points_session; ?>
				<br>
				Total des points depuis la création du compte : <?php echo $points; ?>
			</div>
			<!--<a href="allconcerts.php?filter=reset"> Voir mes concerts favoris </a>-->
			<hr>
			<?php 
				$sql = "SELECT message, id FROM message WHERE utilisateur = '$idpseudo' ORDER BY date_envoi DESC";
				$query = mysqli_query($con, $sql);

				while ($row = mysqli_fetch_array($query)) 
				{
					$id = $row['id'];
					echo $count;
					echo " : ";
					echo $row['message'];
					echo "<br>";
					$count++;
					$sql = "UPDATE message SET lu = 1 WHERE id = '$id'";
					$querylu = mysqli_query($con, $sql);
				}
			?>
		</body>
</html>
<script src="js/scrollnav.js"></script> 
