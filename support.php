<?php
/*
	Type fichier : php
	Fonction : affiche les problèmes envoyés par les utilisateurs
	Emplacement : supermadmin
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : non
*/
/*
	Type fichier : 
	Fonction : 
	Emplacement : 
	Connexion à la BDD :  
	Contenu HTML : 
	JS+JQuery : 
	CSS : 
*/
?>

<!DOCTYPE html>
<html>
	<head>
		<?php
			require 'php/connectcookie.php';
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'php/js.php';
			require('php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/support.css">
	</head>
	<header>
		<?php include('contenu/header.php'); ?>
	</header>
	<body>
		<?php
		$pseudo = $_SESSION['pseudo'];
		$sql = "SELECT ID_user, admin FROM utilisateur WHERE pseudo = '$pseudo'";
		$result = mysqli_query($con ,$sql);
		$row = mysqli_fetch_array($result);
		$iduser = $row['ID_user'];
		$admin = $row['admin'];
		/*echo $admin;
		echo $iduser;*/
		if($pseudo && $admin != 2)
		{
			$hide = $_GET['hide'];?>
			<h2>Mes requêtes</h2><?php
			echo '<div id="hidecheck">';
				if(!$hide || $hide == 'no')
				{
					$sql = "SELECT id, date_envoi, resolu, type, sujet FROM probleme WHERE utilisateur = $iduser ORDER BY date_envoi DESC";
				}
				else
				{
					$sql = "SELECT id, date_envoi, resolu, type, sujet FROM probleme WHERE utilisateur=$iduser AND resolu != 2 ORDER BY date_envoi DESC";
				}
				$query = mysqli_query($con ,$sql);?>


				<input type="checkbox" onclick='window.location.assign(<?php echo '"'; echo 'support.php?';
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
					echo " checked";
				}
				?>
				>
				Cacher les problèmes résolus
			</div>

			<table>
	    		<tr class="coltr">
		    		<th scope="col" class="sujetcol">Sujet</th>
		    		<th scope="col" class="idcol">ID du ticket</th>
			        <th scope="col" class="typecol">Type</th> 
			        <th scope="col" class="datecol">Date d'envoi</th>
			        <th scope="col" class="statutcol">Statut</th>
   				</tr>
   				<tr>
   					<th>ㅤ</th>
   					<th>ㅤ</th>
   					<th>ㅤ</th>
   					<th>ㅤ</th>
   					<th>ㅤ</th>
   				</tr>
   				<?php
   				while($row = mysqli_fetch_array($query))
				{
					?>
					<form method="post" id="connect" action="supportshow.php">
						<?php $newDate = date("d-m-Y", strtotime($row['date_envoi'])); ?> 
						<tr>
							<th class="sujet"> <?php echo '<a href="'; echo 'supportshow.php?idcheck='; echo $row['id']; echo '">'; echo $row['sujet']; echo "</a>";?></th>
							<th class="idth"> <?php echo '#' . $row['id']; ?></th>
							<th class="typeth"> <?php if($row['type'] == 1){echo "Probleme concert";} else if($row['type'] == 2){echo "Probleme site";} else if($row['type'] == 3){echo "Contact";} ?></th>
							<th class="dateth"> <?php echo $newDate; ?></th>
							<th class="resoluth"> <?php if($row['resolu'] == 0){echo "non résolu";}else if($row['resolu'] == 1){echo "en cours de résolution";}else{echo "résolu";}?> </th>
						</tr>
						<tr>
		   					<th>ㅤ</th>
		   					<th>ㅤ</th>
		   					<th>ㅤ</th>
		   					<th>ㅤ</th>
		   					<th>ㅤ</th>
   						</tr>
					</form>
				<?php
					if($row['lu'] == 0){echo "</strong>";}
				}?>
			</table><?php
		}
		else if($admin == 2)
		{
			header("Location: superadmin/contact.php");
		}
		else
		{
			echo "Vous devez être connecté afin d'accéder à cette page";
		}
		?>
		<?php include('contenu/scrolltop.html'); ?>
		<?php include('contenu/footer.html'); ?>
	</body>
</html>