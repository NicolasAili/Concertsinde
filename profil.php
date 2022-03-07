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
<html lang="fr">
	<head>
		<?php
			include 'php/error.php';
			require 'php/connectcookie.php';
			include 'php/base.php';
			include 'php/css.php';
			include 'php/js.php';
			require 'php/database.php';
		?>
		<link rel="stylesheet" type="text/css" href="css/body/profil.css">
	</head>
	<body>
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<?php include 'contenu/reseaux.php'; ?>
		<?php
		if(isset($_SESSION['pseudo']))
		{
			require('php/database.php');

			$currentdate = date('Y-m-d');
			$currentdate = new DateTime($currentdate);

		    $pseudo = $_SESSION['pseudo'];
			$requestpseudo = "SELECT id_user, date_inscription FROM utilisateur WHERE pseudo = '$pseudo'";
			$query = mysqli_query($con, $requestpseudo);
			$row = mysqli_fetch_array($query);
			$idpseudo = $row['id_user'];
			$dateregister = $row['date_inscription'];

			$date = new DateTime($dateregister);
			$intvl = $currentdate->diff($date);
			
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

			$sql = "SELECT COUNT(user_ajout) AS useraddsession FROM concert, session WHERE user_ajout = '$idpseudo' AND date_ajout > session.date_debut AND date_ajout < session.date_fin AND actif = 1";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$nbconcertsession = $row['useraddsession'];

			$sql = "SELECT COUNT(user_ajout) AS useradd FROM concert WHERE user_ajout = '$idpseudo'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$nbconcert = $row['useradd'];

			$sql = "SELECT COUNT(id_user) AS modifaddsession FROM modification, session WHERE id_user = '$idpseudo' AND datetime > session.date_debut AND datetime < session.date_fin AND actif = 1";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$modifaddsession = $row['modifaddsession'];

			$sql = "SELECT COUNT(id_user) AS modifadd FROM modification WHERE id_user = '$idpseudo'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$modifadd = $row['modifadd'];

			$sql = "SELECT COUNT(points_session) AS classementsession FROM utilisateur WHERE points_session > $points_session";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$classementsession = $row['classementsession']+1;

			$sql = "SELECT COUNT(points) AS classement FROM utilisateur WHERE points > $points";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$classement = $row['classement']+1;
			?>

			<div id="main">
				<div id="profil">
					<div id="top">
						<img alt="profil" src="image/profil.png">
						<h1>Profil de <?php echo $_SESSION['pseudo']; ?> </h1>
						<a href="action/deconnexion.php"><img alt="deconnexion" src="image/power.png" id="onoff"></a>
					</div>
					<?php 
					 	if(!empty($_GET['message'])) 
					 	{
							$message = $_GET['message'];
							 echo '<p class="message"> '.$message.'</p>';
						}
					?>
				</div>
				<div id="content">
					<div id="infos">
						<h2> Infos </h2>
						<?php
						$newDate = date("d-m-Y", strtotime($dateregister));?>
						<h3>Membre depuis le : </h3> <?php echo $newDate; echo " (" . $intvl->days . " jours)"; ?> <br>
						<h3>Nombre de concerts ajoutés cette session : </h3><?php echo $nbconcertsession; ?><br>
						<h3>Nombre de concerts totaux ajoutés : </h3><?php echo $nbconcert; ?><br>
						<h3>Nombre de concerts modifiés cette session : </h3><?php echo $modifaddsession; ?><br>
						<h3>Nombre de concerts totaux modifiés : </h3><?php echo $modifadd; ?><br>
					</div>
					<div id="pts">
						<h2> Points et concerts </h2>
						<h3><?php echo '<a href="allconcerts.php?add='; echo $idpseudo; echo '">';?> Voir mes concerts ajoutés </a></h3> <br>
						<h3><?php echo '<a href="allconcerts.php?modif='; echo $idpseudo; echo '">';?> Voir mes concerts modifiés </a></h3> <br>
						<div id="points">
							<h3>Total des points pour la session en cours : </h3><?php echo $points_session; ?><br>
							<h3>Total des points depuis la création du compte : </h3><?php echo $points; ?> <br>
							<h3>Classement pour la session actuelle : </h3><?php echo $classementsession; ?> <br>
							<h3>Classement général : </h3><?php echo $classement; ?> <br>
						</div>
					</div>
				</div>
			</div><?php
		}
		else
		{
			echo("erreur, vous n'êtes pas connecté");
		}?>
		<?php include('contenu/footer.html');
		require "action/messages.php"; ?>
	</body>
</html>

