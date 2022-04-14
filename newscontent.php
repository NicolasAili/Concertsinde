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
			include 'php/error.php';
			require 'php/connectcookie.php';
			include 'php/base.php';
			include 'php/css.php';
			include 'php/js.php';
			require 'php/database.php';

			$newsid = $_GET['newsid'];

			require ('php/inject.php'); //0) ajouter inject et définir redirect
			$redirect = 'news.php';

			$inject = array(); 
			$returnval = inject($newsid, 'identifier'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
			if (!is_null($returnval)) 
			{
			  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
			}
			$validate = validate($inject, $redirect); //3)validation de tous les champs
			if($validate == 0) //4) si pas d'injection : ajout des variables
			{
			  $newsid = mysqli_real_escape_string($con, $newsid); 
			}
			session_start();
		?>
		<link rel="stylesheet" type="text/css" href="css/body/newscontent.css">

		
	</head>
	<body>	
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<?php include 'contenu/reseaux.php'; ?>
		<div id="main">
			<?php
			
			$sql = "SELECT titre, soustitre, contenu FROM actualites WHERE id = $newsid";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);?>
			<h1> <?php echo $row['titre']; ?></h1>
			<h3> <?php echo $row['soustitre']; ?></h3>
			<div id="contenu"> <?php echo nl2br($row['contenu']); ?></div>
		</div>
	</body>
</html>