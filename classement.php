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

		$i = 0;
		$rank = 0;
		$rang = 0;
		$pt_user = 0;

		?>

		<h1> Classement des utilisateurs </h1>
		<div id="main">
			<h2> Classement pour la session en cours (du <?php echo $sessiondebut; echo " au "; echo $sessionfin; echo ") : "?> </h2>

			<table>
			    <caption>Points session</caption>
			    <tr>
			    	<th scope="col">Rang</th>
			        <th scope="col">Pseudo</th>
			        <th scope="col">Points</th>
			    </tr>
			    <?php
				$sql = "SELECT points_session, pseudo FROM utilisateur WHERE admin = 0 AND banni = 0 ORDER BY points_session DESC";
				$query = mysqli_query($con, $sql);
				
				while ($row = mysqli_fetch_array($query))
				{
					if($i < 10)
					{?>
						<tr>
							<th scope="row"> <?php echo $i+1; ?> </th>
							<td> <?php echo $row['pseudo']; ?> </td>
					        <td><?php echo $row['points_session']; ?></td>
					        <?php if($row['pseudo'] == $_SESSION['pseudo']){$rank = 1;} ?>
				    	</tr>
				    	<?php
					}
					if($row['pseudo'] == $_SESSION['pseudo'] && $i > 9)
					{
						$rang = $i+1;
						$pt_user = $row['points_session'];
					}
					$i++;
				}
				if($rank == 0 && $_SESSION['pseudo'])
				{
					?>
					<tr>
						<td> ... </td>
						<td> ... </td>
				        <td> ... </td>
				    </tr>
					<tr>
						<th scope="row"> <?php echo $rang; ?> </th>
						<td> <?php echo $_SESSION['pseudo']; ?> </td>
				        <td><?php echo $pt_user; ?></td>
				    </tr>
				    <?php
				}
				?>
			</table>
			<?php
				$i = 0;
				$rang = 0;
				$rank = 0;
				$pt_user = 0;
			?>


			<h2> Classement depuis la création du site </h2>

			<table>
			    <caption>Points totaux</caption>
			    <tr>
			        <th scope="col">Pseudo</th>
			        <th scope="col">Points</th>
			    </tr>
			    <?php
				$sql = "SELECT points, pseudo FROM utilisateur WHERE admin = 0 AND banni = 0 ORDER BY points DESC";
				$query = mysqli_query($con, $sql);
				
				while ($row = mysqli_fetch_array($query))
				{
					if($i < 10)
					{?>
						<tr>
							<th scope="row"> <?php echo $i+1; ?> </th>
							<td> <?php echo $row['pseudo']; ?> </td>
					        <td><?php echo $row['points']; ?></td>
					        <?php if($row['pseudo'] == $_SESSION['pseudo']){$rank = 1;} ?>
				    	</tr>
				    	<?php
					}
					if($row['pseudo'] == $_SESSION['pseudo'] && $i > 9)
					{
						$rang = $i+1;
						$pt_user = $row['points'];
					}
					$i++;
				}
				if($rank == 0 && $_SESSION['pseudo'])
				{
					?>
					<tr>
						<td> ... </td>
						<td> ... </td>
				        <td> ... </td>
				    </tr>
					<tr>
						<th scope="row"> <?php echo $rang; ?> </th>
						<td> <?php echo $_SESSION['pseudo']; ?> </td>
				        <td><?php echo $pt_user; ?></td>
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
