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
			require 'php/connectcookie.php';
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'contenu/reseaux.php';
			require('php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/classement.css">
	</head>
	<body>
		<header>
			<?php include('contenu/header.php'); ?>
		</header>	
		<div id="main">
			<?php 
			$sql = "SELECT date_debut, date_fin FROM session WHERE actif = '1'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$sessiondebut = $row['date_debut'];
			$sessionfin = $row['date_fin'];

			$sessiondebut = date("d-m-Y", strtotime($sessiondebut));
			$sessionfin = date("d-m-Y", strtotime($sessionfin));

			$i = 0;
			$rank = 0;
			$rang = 0;
			$pt_user = 0;

			?>

			<h2> Classements</h2>
			<div id="display">
				<div id="allsession">
					<h3> Général </h3>
					<table>
					    <tr class="headertable">
					    	<th scope="col" class="tbunhead">Rang</th>
					        <th scope="col" class="tbdeuxhead">Pseudo</th>
					        <th scope="col" class="tbtroishead">Points</th>
					    </tr>
					    <?php
						$sql = "SELECT points, pseudo FROM utilisateur WHERE admin = 0 AND banni = 0 ORDER BY points DESC";
						$query = mysqli_query($con, $sql);
						
						while ($row = mysqli_fetch_array($query))
						{
							if($i < 10)
							{
								switch ($i) {
									case 0:
										echo "<tr style='background-color: #FFD700;'>";
										break;
									case 1:
										echo "<tr style='background-color: #C0C0C0;'>";
										break;
									case 2:
										echo "<tr style='background-color: #CD7F32;'>";
										break;
									default:
										echo "<tr style='background-color: #ededed;'>";
										break;
								}?>
								
									<th scope="row" class="tbun"> <?php if($i == 0){echo "🥇";}elseif($i == 1){echo "🥈";}elseif($i == 2){echo "🥉";}else{echo $i+1;} ?> </th>
									<td class="tbdeux"> <?php echo $row['pseudo']; ?> </td>
							        <td class="tbtrois"><?php echo $row['points']; ?></td>
							        <?php if($row['pseudo'] == $_SESSION['seudo']){$rank = 1;} ?>
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
							<tr style='background-color: #ededed;'>
								<td class="tbun"> ... </td>
								<td class="tbdeux"> ... </td>
						        <td class="tbtrois"> ... </td>
						    </tr>
							<tr style="background-color: #33cc33;">
								<th scope="row" class="tbun"> <?php echo $rang; ?> </th>
								<td class="tbdeux"> <?php echo $_SESSION['pseudo']; ?> </td>
						        <td class="tbtrois"><?php echo $pt_user; ?></td>
						    </tr>
						    <?php
						}
						?>
					</table>
				</div>
				<?php
					$i = 0;
					$rang = 0;
					$rank = 0;
					$pt_user = 0;
				?>
				<div id="currentsession">
					<h3> Session en cours <span> du <?php echo $sessiondebut; echo " au "; echo $sessionfin;?> </span> </h3>
					<table>
					    <tr class="headertable">
					    	<th scope="col" class="tbunhead">Rang</th>
					        <th scope="col" class="tbdeuxhead">Pseudo</th>
					        <th scope="col" class="tbtroishead">Points</th>
					    </tr>
					    <?php
						$sql = "SELECT points_session, pseudo FROM utilisateur WHERE admin = 0 AND banni = 0 ORDER BY points_session DESC";
						$query = mysqli_query($con, $sql);
						
						while ($row = mysqli_fetch_array($query))
						{
							if($i < 10)
							{
								switch ($i) {
									case 0:
										echo "<tr style='background-color: #FFD700;'>";
										break;
									case 1:
										echo "<tr style='background-color: #C0C0C0;'>";
										break;
									case 2:
										echo "<tr style='background-color: #CD7F32;'>";
										break;
									default:
										echo "<tr style='background-color: #ededed;'>";
										break;
								}?>
									<th scope="row" class="tbun"> <?php if($i == 0){echo "🥇";}elseif($i == 1){echo "🥈";}elseif($i == 2){echo "🥉";}else{echo $i+1;} ?> </th>
									<td class="tbdeux"> <?php echo $row['pseudo']; ?> </td>
							        <td class="tbtrois"><?php echo $row['points_session']; ?></td>
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
							<tr style='background-color: #ededed;'>
								<td class="tbun"> ... </td>
								<td class="tbdeux"> ... </td>
						        <td class="tbtrois"> ... </td>
						    </tr>
							<tr style="background-color: #33cc33;">
								<th scope="row" class="tbun"> <?php echo $rang; ?> </th>
								<td class="tbdeux"> <?php echo $_SESSION['pseudo']; ?> </td>
						        <td class="tbtrois"><?php echo $pt_user; ?></td>
						    </tr>
						    <?php
						}
						?>
					</table>
				</div>
			</div>
		</div>
		<?php include('contenu/scrolltop.html'); ?>
		<?php include('contenu/footer.html'); ?>
	</body>
</html>

