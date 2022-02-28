<?php
/*
	Type fichier : php
	Fonction : affiche les problèmes/messages des utilisateurs
	Emplacement : supermadmin
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : non
*/
    session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gestion des erreurs</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="contact.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />	
		<!--<script type="text/javascript" src="./jquery/jquery.min.js"></script>
		<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="./jquery/jquery-ui.css" media="screen" />-->		
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
			$user = $_GET['user'];
			$count = 1;
			if(!$hide || $hide == 'no')
			{
				if ($user) 
				{
					$sql = "SELECT id, date_envoi, resolu, lu, pseudo, type, sujet FROM probleme, utilisateur WHERE utilisateur=ID_user AND ID_user = $user";
				}
				else
				{
					$sql = "SELECT id, date_envoi, resolu, lu, pseudo, type, sujet FROM probleme, utilisateur WHERE utilisateur=ID_user";
				}
			}
			else
			{
				if ($user) 
				{
					$sql = "SELECT id, date_envoi, resolu, lu, pseudo, type, sujet FROM probleme, utilisateur WHERE utilisateur=ID_user AND resolu != 2 AND ID_user = $user";
				}
				else
				{
					$sql = "SELECT id, date_envoi, resolu, lu, pseudo, type, sujet FROM probleme, utilisateur WHERE utilisateur=ID_user AND resolu != 2";
				}
			}

			$query = mysqli_query($con ,$sql);?>

			<a href="saccueil.php">retour accueil</a>
			<br>
			<a href="contact.php">réinitialiser</a>
			<br>
			<input type="checkbox" onclick='window.location.assign(<?php echo '"'; echo 'contact.php?';
			if($hide == 'yes')
			{
				echo 'hide=no';
				if ($user) 
				{
					echo "&user=$user";
				}
			}
			else if($hide == 'no')
			{
				echo 'hide=yes';
				if ($user) 
				{
					echo "&user=$user";
				}
			}
			else
			{
				echo 'hide=yes';
				if ($user) 
				{
					echo "&user=$user";
				}
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
			<table>
				<caption>Utilisateurs</caption>
		    		<tr>
		    		<th scope="col">Numero</th>
			        <th scope="col">Type</th>
			        <th scope="col">Utilisateur</th>
			        <th scope="col">Sujet</th>
			        <th scope="col">date_soumission</th>
			        <th scope="col">resolu</th>
			        <th scope="col">lu</th>
	   				</tr><?php
	   				while($row = mysqli_fetch_array($query))
					{
						$count++;
						$pseudo = $row['pseudo'];

						//if($row['lu'] == 0){echo "<strong>";}

						?>
						<form method="post" id="connect" action="contactmodif.php">
							<tr>
								<?php 
								if($row['lu']==1)
								{
									$i = 1;
									while ($i < 8) 
									{
										$x = 7*($count-1)+$i;
										$i++;
										echo "<style> th:nth-child($x) {font-weight:normal; color:#33cc00;} </style>";
									}
								}
								?>
								<th scope="row"><?php echo $count; ?></th>
								<th> <?php if($row['type'] == 1){echo "Probleme concert";} else if($row['type'] == 2){echo "Probleme site";} else if($row['type'] == 3){echo "Contact";} ?></th>
								<th> <?php echo $pseudo; ?></th>
								<th> <?php echo $row['sujet']; ?></th>
								<th> <?php echo $row['date_envoi']; ?></th>
								<th> <?php if($row['resolu'] == 0){echo "non";}else if($row['resolu'] == 1){echo "en cours";}else{echo "oui";}?> </th>
								<th> <?php if($row['lu']==0){echo "non";} else{echo "oui";} ?></th>
								<input type="hidden" class="idcheck" name="idcheck" <?php echo 'value="' . $row['id'] . '"' ?> >
								<td><input type="submit" value="Afficher" class="valider" name="modsuppr" href=""></td>
								<?php //if($row['lu']==0){echo "<strong>";}?>
							</tr>
						</form>
					<?php
						//if($row['lu'] == 0){echo "</strong>";}
						
					}?>
			</table><?php
		}
		else
		{
			echo "accès non autorisé";
		}
		?>
	</body>
</html>