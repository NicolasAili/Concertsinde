<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Mon site web concert</title>
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="page d'acceuil" />
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/accueil.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />	
	</head>
	<header>
		<?php include('header.php'); ?>
	</header>
	<body>
		<div class="maintxt">
			<div class="blocun">
				<h1> Objectifs du site </h1>
				<p> L'objectif de notre site web est de permettre aux fans de rap indépendant de pouvoir être facilement au courant des concerts futurs au sein de ce milieu.</p>
				<p>Ce site a pour caractéristique principale d'être communautaire. Cela signifie que ce sont les fans qui font vivre le site, chacun peut -et ce de manière anonyme- renseigner un concert et ainsi aider l'ensemble des utilisateurs.</p>
				<p>Nous vous invitons néanmoins à créer un compte, cela vous permettra de modifier les annonces qui ont déjà été passées mais qui comportent des erreurs. </p>
				<p>Bien que le site soit administré, nous faisons entièrement confiance à la communauté. 
				</p>
			</div>
			<div class="blocdeux"> 				
				<h1>Fonctionnement du site</h1> 
				<h2>Informations sur un concert</h2> 
				<p>Depuis la page d'accueil (mais pas que) vous pouvez vous balader sur les différentes rubriques du site, comme afficher les concerts par ville, par pays, par artiste, ou par date.</p> 
				<h2>Consulter tous les concerts</h2>
				<p>Vous pouvez aussi accéder à la page "Tous les concerts", qui, comme son nom l'indique, fait référence à tous les concerts qui ont été ajoutés par la communauté. </p>
			</div>
			<div class="bloctrois">
				<h2>Comment ajouter un concert</h2>
				<p>Pour ajouter un concert il suffit de cliquer sur le bouton du même nom dans la barre en haut du site. Vous serez redirigés vers un formulaire qui vous permettra d'ajouter un concert en renseignant les informations souhaitées</p>
				<h2>Inscription et connexion au site</h2>
				<p> L'inscription est simple: il vous suffit de cliquer sur le bouton inscription et remplir le formulaire demandé en respectant les paramètres (exemple : le mot de passe doit contenir au moins 8 caractères). <br>Une fois inscrits, vous serez redirigés vers la page de connexion et il vous suffira alors de vous connecter avec les informations renseignées précédemment.
				Si vous êtes déjà inscrits, cliquez sur le bouton "connexion" et entrez vos identifiants. </p>
			</div>	
			<div class="blocquatre">
				<h2> A savoir </h2>
				<p> Seul une personne connectée pourra supprimer des concerts qui ont été annulés, repportés, ou seulement mal référencés.</p>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
	<?php include('footer.html'); ?>
</html>