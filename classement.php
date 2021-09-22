<?php
/*
	Type fichier : php
	Fonction : classement des points utilisateurs
	Emplacement : /
	Connexion à la BDD : oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui
*/
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 

			require('php/database.php');
			session_start();
		?>
		<link rel="stylesheet" type="text/css" href="css/body/classement.css">
	</head>
	<header>
		<?php include('contenu/header.php'); ?> <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</header>
	<body>	

		<?php 
		$sql = "SELECT date_debut, date_fin FROM session WHERE actif = '1'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		$sessiondebut = $row['date_debut'];
		$sessionfin = $row['date_fin'];


		?>

		<h1> Classement des utilisateurs </h1>
		<div id="main">
			<h2> Classement pour la session en cours (du <?php echo $sessiondebut; echo " au "; echo $sessionfin; echo ") : "?> </h2>

			<table>
			    <caption>Points session</caption>
			    <tr>
			        <th scope="col">Pseudo</th>
			        <th scope="col">Points</th>
			    </tr>
			    <?php
				$sql = "SELECT points_session, pseudo FROM utilisateur WHERE admin = 0 ORDER BY points_session DESC";
				$query = mysqli_query($con, $sql);
				
				while ($row = mysqli_fetch_array($query))
				{?>
				    <tr>
						<th scope="row"> <?php echo $row['pseudo']; ?> </th>
				        <td><?php echo $row['points_session']; ?></td>
				    </tr>

				<?php
				}
				?>
			</table>


			<h2> Classement depuis la création du site </h2>

			<table>
			    <caption>Points totaux</caption>
			    <tr>
			        <th scope="col">Pseudo</th>
			        <th scope="col">Points</th>
			    </tr>
			    <?php
				$sql = "SELECT points, pseudo FROM utilisateur WHERE admin = 0 ORDER BY points DESC";
				$query = mysqli_query($con, $sql);
				
				while ($row = mysqli_fetch_array($query))
				{?>
				    <tr>
						<th scope="row"> <?php echo $row['pseudo']; ?> </th>
				        <td><?php echo $row['points']; ?></td>
				    </tr>

				<?php
				}
				?>
			</table>
		</div>
	</body>
	<?php include('contenu/footer.html'); ?>
</html>
<script src="js/scrollnav.js"></script> 
