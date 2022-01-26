<?php 
/*
	Type fichier : php
	Fonction : actualités du site
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
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'php/js.php'; 
			require('php/database.php');
			include 'contenu/reseaux.php'; 
			session_start();
		?>
		<link rel="stylesheet" type="text/css" href="css/body/newscontent.css">

		
	</head>
	<body>	
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<div id="main">
			<?php
			$newsid = $_GET['newsid'];
			$sql = "SELECT titre, soustitre, contenu FROM actualites WHERE id = $newsid";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);?>
			<h1> <?php echo $row['titre']; ?></h1>
			<h3> <?php echo $row['soustitre']; ?></h3>
			<div id="contenu"> <?php echo nl2br($row['contenu']); ?></div>
		</div>
	</body>
</html>