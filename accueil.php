<?php
/*
	Type fichier : php
	Fonction : page accueil
	Emplacement : /
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui
*/
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include 'contenu/base.php'; 
			include 'contenu/css.php'; 
			include 'contenu/js.php'; 
				
			require('php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/accueil.css">
	</head>
	<header>
		<?php 
			include('header.php'); 
		?>
	</header>
	<body>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br><br>

		<?php
			$pseudo = $_SESSION['pseudo'];
			$requestpseudo = "SELECT id_user FROM utilisateur WHERE pseudo = '$pseudo'";
			$query = mysqli_query($con, $requestpseudo);
			$row = mysqli_fetch_array($query);
			$idpseudo = $row['id_user'];

			$sql = "SELECT message FROM message, utilisateur WHERE message.utilisateur = utilisateur.ID_user AND utilisateur = '$idpseudo' AND alerte = 0";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$message = $row['message'];
			
			if($message)
			{
				echo "<script> alert('Nouveau(x) message(s) disponible(s), consultez votre profil pour les afficher'); </script>";
			}

			$sql = "UPDATE message, utilisateur SET alerte = '1' WHERE message.utilisateur = utilisateur.ID_user AND utilisateur = '$idpseudo' AND alerte = 0";
			$query = mysqli_query($con, $sql);
		?>
		<div class="maintxt">
			<div class="blocun">
				<h1> Objectif du site </h1>
				<p> L'objectif de ce site web est de permettre au public de rap indépendant de pouvoir être facilement au courant des concerts futurs au sein de ce milieu, et ce de manière libre et gratuite. </p>
				<p>Ce site a pour caractéristique principale d'être communautaire. Cela signifie que ce sont les fans qui font vivre le site, chacun peut -et ce de manière anonyme- renseigner un concert et ainsi aider l'ensemble des utilisateurs. Nous vous invitons néanmoins à créer un compte, cela vous permettra (entre autres) de modifier les concerts qui ont déjà été renseignés mais qui pourraient comporter des erreurs. </p>
				<p>En étant connectés, vous pouvez en outre gagner des points permettant d’obtenir des récompenses (cd, places de concert, vêtements, bons d’achat etc…) en fonction de votre activité sur le site (plus de détails dans l'onglet « présentation et fonctionnement »).</p>
			</div>
			<div class="blocdeux"> 				
				<h1>D’où vient l’idée/pourquoi ce site</h1>
				<p>Me rendant régulièrement à des concerts de rap indépendant, j’ai remarqué qu’il n’existait pas de plateforme recensant tous les concerts. Il y a bien le site « info concert » (par exemple) mais plusieurs concerts de rap indépendant n’y apparaissent pas, à l'instar de concerts de petite taille.</p>
				<p>
					De ce fait le moyen le plus simple d’être au courant des concerts est soit le bouche à oreille soit de suivre assidument les pages des organisateurs ou bien les pages des artistes sur les réseaux sociaux. Or, tout le monde n’a pas forcément le temps de le faire et il est très facile de rater des informations.
				</p>
				<p>
					Le fait aussi que ce milieu dispose de peu de moyens rend la communication souvent légère, voire parfois inexistante. En conséquence, de nombreux concerts se retrouvent en "sous-effectif" du fait que l'ensemble du public n’est pas forcément mis au courant des différents concerts.
				</p>
				<p>
					Voilà la raison de l’existence de ce site : faire de cette plateforme un outil gratuit où public et artistes peuvent participer librement à l’expansion du rap indépendant au plus grand nombre.
				</p>
			</div>
			<div class="bloctrois">
				<h1>Fonctionnement général du site</h1> 
				<p>
				Le fonctionnement du site est assez simple avec trois principales utilisations :
				</p>
				<p>
				-	Consulter la liste des concerts
				</p>
				<p>
				-	Ajouter un concert
				</p>
				<p>
				-	Modifier un concert
				</p>
				<p>
				Une fois un concert ajouté, les utilisateurs peuvent le modifier et lorsque toutes informations d'un concert ont été vérifiées (et éventuellement corrigées) par un administrateur, le concert est validé et n’est plus modifiable. Des points sont attribués aux utilisateurs ayant participé au renseignement du concert (ajout et modifications).
				</p>
				<p>
				Pour plus de détails sur le fonctionnement et sur le système de points, consultez l'onglet <a href="./presentation.php"> « présentation et fonctionnement ». </a>
				</p>
			</div>	
		</div>
	</body>
	<!--<script type="text/javascript" src="./js/scrollnav.js"></script> -->
	<?php include('footer.html'); ?>
</html>



