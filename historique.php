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
		<?php include("supprimer.php"); // on appelle le fichier?>
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
	</head>
	<header>
		<?php include('header.php'); ?>
	</header>
	<body>	
		<?php echo "<br>"; ?>


		1) afficher tous les éléments modifiables d'un concert
		2) afficher l'historique de modification pour chaque élément +date/heure/user
		_____________________________________________
		page all concert 

		(création d'un compte administrateur)

		1) création d'un bouton pour valider un concert + un autre pour le dévalider (réservé admin)
		2) si concert validé > attribuer points de création et de modification 
		> réfléchir au cas où un mec modifie une information juste
		> réfléchir au cas des villes
		> réfléchir au cas où la colonne modifiée l'a été par la personne qui a créé le concert

		3) création d'une icône pour afficher si le concert a été validé ou non
		4) empêcher la modification d'un concert validé
		5) création d'un filtre pour afficher les concerts validés/non validés

		______________________________________________
		Profil:

		1) voir ses points pour la session en cours
		2) voir ses points totaux
		3) voir ses concerts ajoutés
		4) voir ses concerts modifiés
		5) détail des points

		____________________________________________________
		page hall of fame:

		1) classement session en cours (afficher session en cours)
		2) classement général

	</body>
</html>