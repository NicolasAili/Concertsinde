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
<html>
	<head>
		<title>Tous les concerts</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/allconcerts.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />	
		<script type="text/javascript" src="jquery/jquery.min.js"></script>
		<script type="text/javascript" src="jquery/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="jquery/jquery-ui.css" media="screen" />		
		<?php include("supprimer.php"); // on appelle le fichier?>
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
	</head>
	<header>
		<?php //include('header.php'); ?>
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
