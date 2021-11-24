<?php
/*
	Type fichier : php
	Fonction : présentation du site
	Emplacement : /
	Connexion à la BDD :  non
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
		<link rel="stylesheet" type="text/css" href="css/body/presentation.css">

		
	</head>
	<body>	
		<header>
			<?php include('contenu/header.php'); ?>
			<script src="js/scrollnav.js"></script> 
		</header>
		<div id="main">
			<h1>+ Présentation</h1>
			<div id="presentation">
				<br><br>
				L'objectif de notre site web est de permettre aux fans de rap indépendant de pouvoir être facilement au courant des concerts futurs au sein de ce milieu, et ce de manière libre et gratuite.
				<br><br>
				Ce site a pour car caractéristique principale d'être communautaire. Cela signifie que ce sont les fans qui font vivre le site, chacun peut -et ce de manière anonyme- renseigner un concert et ainsi aider l'ensemble des utilisateurs.<br>
				Nous vous invitons néanmoins à créer un compte, cela vous permettra (entre autres) de modifier les concerts qui ont déjà été renseignés mais qui pourraient comporter des erreurs. 
				<br><br>
				En étant connectés, vous pouvez en outre gagner des points permettant d’obtenir des récompenses (cd, places de concert, vêtements, bons d’achat etc…) en fonction de votre activité sur le site (voir partie « fonctionnement »).
				<br>
				<br>
				<br>
			</div>

			<h1>+ D’où vient l’idée/pourquoi ce site</h1>
			<div id="idee">
				<br><br>
				Me rendant régulièrement à des concerts de rap indé, j’ai remarqué qu’il n’existait pas de plateforme recensant tous les concerts. Il y a bien le site « info concert » mais plusieurs concerts de rap français indépendant n’y apparaissent pas. <br><br>
				De ce fait, le moyen le plus simple d’être au courant des concerts est soit le bouche à oreille soit de suivre assidument les pages d’organisateur ou bien les pages d’artistes sur les réseaux. Or, tout le monde n’a pas forcément le temps de le faire et il est très facile de rater des informations. <br>
				Le fait aussi que ce milieu dispose de peu de moyens rend la communication parfois légère voire inexistante. <br><br>
				En conséquence, de nombreux concerts se retrouvent en sous-effectif du fait que tout le monde n’est pas mis au courant des concerts auxquels ils auraient pu assister.
				<br>
				Je me souviens par exemple d’un concert de Davodka il y a de ça quelques années, où j’avais trouvé qu’il y avait très peu de monde (un petit tiers de salle) par rapport à la popularité de l’artiste.
				<br><br>
				Voilà la raison de l’existence de ce site : faire de cette plateforme un outil gratuit où public et artistes peuvent participer librement à l’expansion du rap indépendant au plus grand nombre.
				<br>
				<br>
				<br>
			</div>

			<h1>+ Fonctionnement</h1>
			<div id="fonctionnement">
			<br><br>
			Le fonctionnement du site est assez simple avec trois principales utilisations :
				<br>
				-	Consulter la liste des concerts
				<br>
				-	Ajouter un concert
				<br>
				-	Modifier un concert
				<br><br>
				Une fois un concert ajouté, les utilisateurs peuvent le modifier et lorsque toutes informations ont vérifiées (et éventuellement corrigées) par un administrateur, le concert est validé et n’est plus modifiable. Des points sont attribués aux utilisateurs ayant participé au renseignement du concert (ajout et modifications).
				<br><br>
				Pour plus de détails et connaître les autres fonctionnalités consultez les sections ci-dessous.
				<br>
				<br>
				<br>
			</div>

			<h1>+ Ajout d’un concert</h1>
			<div id="ajout">
				<br><br>
				Pour ajouter un concert, cliquez sur le bouton correspondant en haut du site.
				<br><br>
				Vous pouvez ajouter un concert sans être connecté mais si vous avez un compte n’hésitez pas à vous connecter afin de gagner des points (et des récompenses par la suite).<br><br>
				Une fois sur la page, remplissez les champs que vous connaissez. Vous n’êtes pas obligés de tout remplir à l’exception des champs obligatoires qui sont les suivants :<br>
				-	Nom de l’artiste/du groupe<br>
				-	Date du concert<br>
				-	Lieu du concert (en extérieur ou en intérieur)<br>
				-	Salle (si concert intérieur)<br>
				-	Ville<br><br>
				A noter que lorsque vous remplissez (par exemple) le nom de la salle, une recherche est faite dans notre base de donnée et si la salle y existe, les champs qui suivent se remplissent automatiquement. <br><br>
				Une fois les champs connus remplis, cliquez sur « enregistrer le concert », une fenêtre récapitulative des informations saisies va s’ouvrir. Vérifiez-les, et si tout est correct, enregistrez le concert (vous pourrez toujours le modifier par la suite), sinon modifiez les informations incorrectes.<br><br>
				Enfin vous pourrez voir le concert que vous avez enregistré, vous pouvez pour terminer revenir en arrière et constater que votre concert a bien été ajouté (page « tous les concerts »).<br>
				Note : Vous pouvez directement consulter vos concerts ajoutés si vous possédez un compte (page « mon profil », « voir mes concerts ajoutés »)<br><br><br>
			</div>

			<h1>+ Modification d’un concert</h1>
			<div id="modification">
				<br><br>
				Pour modifier un concert, consultez la liste des concerts (page « concerts »). Sous les concerts non validés uniquement, vous verrez un bouton « modifier ». Il est obligatoire d’avoir un compte pour modifier un concert, si vous n’êtes pas connectés vous ne verrez pas le bouton de modification.<br>
				Si vous constatez une erreur sur un concert validé, n’hésitez pas à faire remonter cette erreur via le formulaire de contact.<br><br>
				Une fois le bouton « modifier » cliqué, vous pourrez apercevoir le concert avec les différents champs qui ont été déjà saisi. <br>
				Tout comme pour l’ajout d’un concert, lorsque vous commencez à saisir un champ, une requête dans notre base de données est effectuée et si le champ saisi y est présent, les champs qui suivent (liés au champ saisi) se remplissent automatiquement. <br><br>
				Absolument tout est modifiable (ou ajoutable si ça n’a pas été renseigné) à l’exception des champs suivants :<br>
				-	Nom de l’artiste<br>
				-	Champs liés à une ville (CP, département etc…)<br><br>
				A noter que (normalement) toutes les villes françaises sont présentes en base de données. Vous pouvez si vous le souhaitez ajouter un concert à l’étranger. Si la ville étrangère n’est pas dans notre base de données vous aurez dans ce cas la possibilité de renseigner les informations liées à la ville (département, région, pays etc…)<br><br>
				Vous disposez également des boutons suivants au sein de la page "modifier":<br>
				Enregistrer le concert : enregistre les modifications effectuées<br>
				Réinitialiser le formulaire : remets les champs à leur valeur d’origine<br>
				Effacer tous les champs : efface le contenu de tous les champs<br>
				Annuler : retourne à la page avec tous les concerts<br><br><br>
			</div>

			<h1>+ Validation d’un concert</h1>
			<div id="validation">
				<br><br>
				Lorsque tous les champs d’un concert sont corrects, un administrateur peut valider le concert. A la validation d’un concert, les points sont distribués aux utilisateurs ayant participé au renseignement du concert (voir section « système de points »).<br><br><br>
			</div>

			<h1>+ Système de points</h1>
			<div id="points">
				<br><br>
				Si vous avez un compte et que vous participez à l’activité du site, vous avez la possibilité de gagner des points. Ces points vous permettront de gagner des récompenses à la fin d’une « session ». <br>
				Une session correspond à une certaine durée de temps. A la fin d’une session, les utilisateurs qui ont le plus de points se verront gagner des récompenses (cd, places de concert, vêtements, bons d’achat etc…) pour les remercier de leur contribution.<br><br>
				L’attribution des points se fait lorsqu’un concert est validé par un administrateur, elle se fait de la manière suivante :<br>
				Ajout d'un concert : +5 points si aucun champ modifié, +3 points si un ou plusieurs champs ont été modifiés après l'ajout.<br>
				Modification d'un concert: +1 point par champ modifié et validé<br><br>
				Si vous avez modifié un champ mais qu’il n’est pas correct, ou que vous avez ajouté un concert inexistant, vous ne gagnerez aucun point.<br><br><br>
			</div>

			<h1>+ Affichage des concerts</h1>
			<div id="affichage">
				<br><br>
				Vous pouvez afficher les concerts dans la page « tous les concerts » (ou sur la page d’un artiste). <br>
				N’hésitez pas à jouer avec les filtres afin de peaufiner votre recherche. Vous pouvez également utiliser la barre de recherche en cliquant sur la loupe en haut.<br><br><br>
			</div>

			<h1>+ Création d’un compte</h1>
			<div id="creation">
				<br><br>
				Rendez-vous sur « mon compte » puis "inscription" afin de créer un compte. Vous devez renseigner un e-mail valide (aucun mail ne vous sera envoyé par la suite, promis)<br><br><br>
			</div>

			<h1>+ Mon profil</h1>
			<div id="profil">
				<br><br>
				Sous la page « mon profil », vous pouvez modifier votre mot de passe, votre mail, afficher vos points, vos concerts ajoutés/modifiés et consulter vos messages.<br>
				Si vous avez modifié un concert mais qu’il a été modifié par la suite, il est normal que vous ne le voyiez pas vos modifications.<br><br><br>
			</div>

			<h1>+ Signaler une erreur</h1>
			<div id="erreur">
				<br><br>
				Si vous constatez une erreur, peu importe sa nature, n’hésitez pas à faire remonter cette erreur via le formulaire de contact à gauche (bulle) ou en cliquant <a href="contact.php"> ici</a>. Cela est une aide précieuse afin de faire évoluer le site et en rendre son utilisation plus agréable.<br><br><br>
			</div>

			<h1>+ Page artiste</h1>
			<div id="artiste">
				<br><br>
				Sur la page d’un artiste, vous pouvez lire sa description (ou l’ajouter si elle n’existe pas et que vous êtes connectés), ainsi que consulter ses concerts passés et futurs.<br>
				Vous pouvez également ajouter un artiste s’il n’existe pas dans la base de données.<br><br><br>
			</div>

			<h1>+ Economie du site</h1>
			<div id="economie">
				<br><br>
				Le site est entièrement libre, gratuit, sans publicité et cela le restera. Tous les frais du site (hébergement, récompenses, publicité etc...) sont entièrement pris en charge par moi-même.<br> <br>
				Dans tous les cas, et c'est le plus important, retenez bien que ce site n'a pas pour but de générer un quelconque revenu, et ce ne sera <u> jamais le cas </u>. <br>
				Mon objectif est simplement de proposer au plus grand nombre un outil gratuit, libre, interactif, communautaire, indépendant, à but non lucratif pour le public et pour les artistes. <br><br>

				Faire de cette musique que nous aimons tant un moyen d'émancipation et de libre expression.<br><br><br>
			</div>

			<h1>+ Contact</h1>
			<div id="contact">
				<br><br>
				N’hésitez pas à me contacter si vous avez la moindre question, une idée d’amélioration ou que vous souhaitez reporter un problème sur le site. <br> <br>
				<a href="contact.php"> Contactez-moi !</a>
				<br><br>
			</div>

			<h1>+ Qui suis-je ?</h1>
			<div id="qui">
				<br><br>
				Etudiant en école d’ingénieur, j’écoute du rap français (principalement indépendant) depuis de nombreuses années. J’ai eu l’occasion de me rendre à de nombreux concerts dans ma ville et la ferveur au sein de ce milieu m’a donné envie d’y apporter ma modeste contribution au travers de ce site.
				<br><br><br>
			</div>

			<h1>+ Historique du site</h1>
			<div id="historique">
				<br><br>
				30 septembre 2020 – Début du développement du site<br>
				X X 2021 – Mise en ligne du site en version bêta (version 1.0.0)<br>
				X X 2021 – Ajout…<br>
			</div>
		</div>
		<?php include('contenu/footer.html'); ?>
	</body>
</html>



<script>
	$( "h1" ).click(function() 
	{
		$(this).next().slideToggle( "slow", function()
		{
			
	  	});
	});
</script>