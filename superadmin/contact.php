<?php
    session_start();
    ini_set('display_errors', 0);
	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tous les concerts</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/allconcerts.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />	
		<script type="text/javascript" src="./jquery/jquery.min.js"></script>
		<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="./jquery/jquery-ui.css" media="screen" />		
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
	</head>
	<body>
		<?php
		require('../php/database.php');
		$pseudo = $_SESSION['pseudo'];
		$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
		$result = mysqli_query($con ,$sql);
		$row = mysqli_fetch_array($result);
		if($row['admin'] == 2)
		{
			$hide = $_GET['hide'];
			$count = 0;
			if(!$hide || $hide == 'no')
			{
				$sql = "SELECT id, date_envoi, resolu, lu, pseudo FROM probleme, utilisateur WHERE utilisateur=ID_user";
			}
			else
			{
				$sql = "SELECT id, date_envoi, resolu, lu, pseudo FROM probleme, utilisateur WHERE utilisateur=ID_user AND resolu != 2";
			}
			
			$query = mysqli_query($con ,$sql);?>


			<input type="checkbox" onclick='window.location.assign(<?php echo '"'; echo 'contact.php?';
			if($hide == 'yes')
			{
				echo 'hide=no';
			}
			else if($hide == 'no')
			{
				echo 'hide=yes';
			}
			else
			{
				echo 'hide=yes';
			}
			?>
			")'
			<?php
			if($hide == 'yes')
			{
				echo "checked";
			}
			?>
			>
			Cacher les problèmes résolus

			<br>
			<br>
			
			<caption>Utilisateurs</caption>
	    		<tr>
	    		<th scope="col">Numero</th>
		        <th scope="col">Messages</th>
		        <th scope="col">Utilisateur</th>
		        <th scope="col">date_soummission</th>
		        <th scope="col">resolu</th>
   				</tr><?php
   				while($row = mysqli_fetch_array($query))
				{
					$count++;
					$pseudo = $row['pseudo'];

					if($row['lu'] == 0){echo "<strong>";}
					?>
					<form method="post" id="connect" action="contactmodif.php">
						<tr>
							<th scope="row"><?php echo $count; ?></th>
							<th>Message <?php echo $count; ?></th>
							<th> <?php echo $pseudo; ?></th>
							<th> <?php echo $row['date_envoi']; ?></th>
							<th> <?php if($row['resolu'] == 0){echo "non";}else if($row['resolu'] == 1){echo "en cours";}else{echo "oui";}?> </th>
							<input type="hidden" class="idcheck" name="idcheck" <?php echo 'value="' . $row['id'] . '"' ?> >
							<td><input type="submit" value="Afficher" class="valider" name="modsuppr" href=""></td>
						</tr>
					</form>
				<?php
					if($row['lu'] == 0){echo "</strong>";}
				}
		}
		else
		{
			echo "accès non autorisé";
		}
		?>
	</body>
</html>