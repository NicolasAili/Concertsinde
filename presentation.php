<?php
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

	<h1>Présentation</h1>
	<br>
L'objectif de notre site web est de permettre aux fans de rap indépendant de pouvoir être facilement au courant des concerts futurs au sein de ce milieu, et ce de manière libre et gratuite.
<br>
Ce site a pour car caractéristique principale d'être communautaire. Cela signifie que ce sont les fans qui font vivre le site, chacun peut -et ce de manière anonyme- renseigner un concert et ainsi aider l'ensemble des utilisateurs.
Nous vous invitons néanmoins à créer un compte, cela vous permettra (entre autres) de modifier les concerts qui ont déjà été renseignés mais qui pourraient comporter des erreurs. 
<br>
En étant connectés, vous pouvez en outre gagner des points permettant d’obtenir des récompenses (cd, places de concert, vêtements, bons d’achat etc…) en fonction de votre activité sur le site (voir partie « fonctionnement »).
<br>
<br>
<br>
<h1>D’où vient l’idée/pourquoi ce site</h1>
<br>
Me rendant régulièrement à des concerts de rap indé, j’ai remarqué qu’il n’existait pas de plateforme recensant tous les concerts. Il y a bien le site « info concert » mais plusieurs concerts de rap français indépendant n’y apparaissent pas. Tout comme les plus petits concerts.
De ce fait le moyen le plus simple d’être au courant des concerts est soit le bouche à oreille soit de suivre assidument les pages d’organisateur ou bien les pages d’artistes sur les réseaux. Or, tout le monde n’a pas forcément le temps de le faire et il est très facile de rater des informations. 
Le fait aussi que ce milieu dispose de peu de moyens rend la communication parfois légère voire inexistante. 
En conséquence, de nombreux concerts se retrouvent en sous-effectif du fait que tout le monde n’est pas mis au courant des concerts auxquels ils auraient pu assister.
<br>
Je me souviens par exemple d’un concert de Davodka il y a de ça quelques années, où j’avais trouvé qu’il y avait très peu de monde (un petit tiers de salle) par rapport à la popularité de l’artiste.
<br>
Voilà la raison de l’existence de ce site : faire de cette plateforme un outil gratuit où public et artistes peuvent participer librement à l’expansion du rap indépendant au plus grand nombre.
<br>
<br>
<br>



<h1>Fonctionnement</h1>
<br><br>
Le fonctionnement du site est assez simple avec trois principales utilisations :
<br>
-	Consulter la liste des concerts
<br>
-	Ajouter un concert
<br>
-	Modifier un concert
<br>
Une fois un concert ajouté, les utilisateurs peuvent le modifier et lorsque toutes informations ont vérifiées (et éventuellement corrigées) par un administrateur, le concert est validé et n’est plus modifiable. Des points sont attribués aux utilisateurs ayant participé au renseignement du concert (ajout et modifications).
<br>
Pour plus de détails et connaître les autres fonctionnalités consultez les sections ci-dessous.
<br>
<br>
<br>
<h1>Ajout d’un concert</h1>
<br><br>
Pour ajouter un concert, cliquez sur le bouton correspondant juste à droite de la barre de recherche.
<br>
Vous pouvez ajouter un concert sans être connectés mais si vous avez un compte n’hésitez pas à vous connecter afin de gagner des points (et des récompenses par la suite).<br>
Une fois sur la page, remplissez les champs que vous connaissez. Vous n’êtes pas obligés de tout remplir à l’exception des champs obligatoires qui sont les suivants :<br>
-	Nom de l’artiste/du groupe<br>
-	Date du concert<br>
-	Lieu du concert (en extérieur ou en intérieur)<br>
-	Salle (si concert intérieur)<br>
-	Ville<br>
A noter que lorsque vous remplissez (par exemple) le nom de la salle, une recherche est faite dans notre base de donnée et si la salle y existe, les champs qui suivent se remplissent automatiquement. <br>
Une fois les champs connus remplis, cliquez sur « enregistrer le concert », une fenêtre récapitulative des informations saisies va s’ouvrir. Vérifiez-les, et si tout est correct, enregistrez le concert (vous pourrez toujours le modifier par la suite), sinon modifiez les informations incorrectes.<br>
Enfin vous pourrez voir le concert que vous avez enregistré, vous pouvez pour terminer revenir en arrière et constater que votre concert a bien été ajouté (page « tous les concerts »).<br>
Note : Vous pouvez directement consulter vos concerts ajoutés si vous possédez un compte (page « mon profil », « voir mes concerts ajoutés »)<br><br><br>

<h1>Modification d’un concert</h1><br><br>
Pour modifier un concert, consultez la liste des concerts (page « tous les concerts »). Sous les concerts non validés uniquement, vous verrez un bouton « modifier ». Il est obligatoire d’avoir un compte pour modifier un concert, si vous n’êtes pas connectés vous ne verrez pas le bouton de modification.<br>
Si vous constatez une erreur sur un concert validé, n’hésitez pas à faire remonter cette erreur (bouton « signaler un problème sur ce concert »)
Une fois le bouton « modifier » cliqué, vous pourrez apercevoir le concert avec les différents champs qui ont été déjà saisi. Tout comme pour l’ajout d’un concert, lorsque vous commencez à saisir un champ, une requête dans notre base de données est effectuée et si le champ saisi y est présent, les champs qui suivent (liés au champ saisi) se remplissent automatiquement. <br>
Absolument tout est modifiable (ou ajoutable si ça n’a pas été renseigné) à l’exception des champs suivants :<br>
-	Nom de l’artiste<br>
-	Champs liés à une ville (CP, département etc…)<br>
A noter que (normalement) toutes les villes françaises sont présentes en base de données. Vous pouvez si vous le souhaitez ajouter un concert à l’étranger. Si la ville étrangère n’est pas dans notre base de données vous aurez dans ce cas la possibilité de renseigner les informations liées à la ville (département, région, pays etc…)<br>
Vous disposez enfin des boutons suivants :<br>
Enregistrer le concert : enregistre les modifications effectuées<br>
Réinitialiser le formulaire : remets les champs à leur valeur d’origine<br>
Effacer tous les champs : efface le contenu de tous les champs<br>
Annuler : retourne à la page avec tous les concerts<br><br><br>

<h1>Validation d’un concert</h1><br><br>
Lorsque tous les champs d’un concert sont corrects, un administrateur peut valider le concert. A la validation d’un concert, les points sont distribués aux utilisateurs ayant participés au renseignement du concert (voir section « système de points »).<br>
Pour l’instant je suis le seul administrateur du site mais j’espère ne pas l’être indéfiniment.<br><br><br>



<h1>Système de points</h1><br><br>
Si vous avez un compte et que vous participez à l’activité du site, vous avez la possibilité de gagner des points. Ces points vous permettront de gagner des récompenses à la fin d’une « session ». <br>
Une session est une certaine durée de temps (pas encore définie). A la fin d’une session, les utilisateurs qui ont le plus de points se verront gagner des récompenses (cd, places de concert, vêtements, bons d’achat etc…) pour les remercier de leur contribution.<br>
L’attribution des points se fait lorsqu’un concert est validé par un administrateur, elle se fait de la manière suivante :<br>
Ajout d'un concert : +5 points si aucun champ modifié, +3 points si un ou plusieurs champs modifiés<br>
Modification d'un concert: +1 point par champ modifié et validé<br>
Si vous avez modifié un champ mais qu’il n’est pas correct, ou que vous avez ajouté un concert inexistant, vous ne gagnerez aucun point.<br><br><br>

<h1>Affichage des concerts</h1><br><br>
Vous pouvez afficher les concerts dans la page « tous les concerts » (ou sur la page d’un artiste). <br>
N’hésitez pas à jouer avec les filtres afin de peaufiner votre recherche. Vous pouvez également utiliser la barre de recherche.<br><br><br>

<h1>Création d’un compte</h1><br><br>
Rendez-vous sur « inscription » afin de créer un compte. Vous devez renseigner un e-mail valide (aucun mail ne vous sera envoyé, promis)<br><br><br>

<h1>Mon profil</h1><br><br>
Sous la page « mon profil », vous pouvez modifier votre mot de passe, votre mail, afficher vos points ainsi qu’afficher vos concerts ajoutés/modifiés.<br>
Si vous avez modifié un concert mais qu’il a été modifié par la suite, il est normal que vous ne voyiez pas vos modifications.<br><br><br>


<h1>Signaler une erreur</h1><br><br>
Si vous constatez une erreur, peu importe sa nature, n’hésitez pas à faire remonter cette erreur (onglet « signaler une erreur »). Cela est une aide précieuse afin de faire évoluer le site et en rendre son utilisation plus agréable.<br><br><br>

<h1>Page artiste</h1><br><br>
Sur la page d’un artiste, vous pouvez lire sa description (ou l’ajouter si elle n’existe pas et que vous êtes connectés), ainsi que consulter ses concerts passés et futurs.<br>
Vous pouvez également ajouter un artiste s’il n’existe pas dans la base de données.<br><br><br>

<h1>Economie du site</h1><br><br>
Le site est entièrement libre, gratuit, sans publicités et cela le restera tant que le site existe. Tous les frais (hébergement du site, récompenses, publicité etc...) sont entièrement pris en charge par moi-même.<br>
Si d'aventure cela revenait trop cher, je penserai peut-être à mettre en place un système de dons pour ceux souhaitant soutenir le site.<br>
De plus je pense peut-être à faire dans le futur des partenariats avec des acteurs de la scène indépendante afin éventuellement de financer les récompenses dans une optique de soutien mutuel. Je pense par exemple à des entités comme Stoemp, lebonson, shoptonhiphop, scred connexion, give me 5 etc... <br>
Tout ceci n'est pour l'instant qu'extrapolation, pour l'instant je finance tout tout seul et tant que j'en ai les moyens cela n'est pas voué à changer. Dans le cas contraire je serai bien entendu totalement transparent sur les dépenses du site et les revenus des dons et éventuellement partenariats. <br>
Enfin, et c'est le plus important, retenez bien que ce site n'a aucunement pour but de générer un quelconque revenu, et ce ne sera <u> jamais le cas </u>. <br>
Le but est simplement de proposer au plus grand nombre un outil, gratuit, libre, interactif, communautaire, indépendant, à but non lucratif dans l'unique optique de faire progresser la scéne hip-hop, pour le public et pour les artistes. <br><br>

Faire de cette musique que nous aimons tant un moyen d'émancipation et de libre expression.<br><br><br>

<h1>Contact</h1><br><br>
N’hésitez pas à me contacter si vous avez la moindre question ou une idée d’amélioration. Vous pouvez également me contacter via facebook.
<br><br><br>
FAQ<br><br>
Comment ajouter un concert ?<br>
Comment modifier un concert ?<br>




<h1>Qui suis-je ?</h1>
<br><br>
Etudiant en école d’ingénieur, j’écoute du rap français (principalement indépendant) depuis de nombreuses années. J’ai eu l’occasion de me rendre à de nombreux concerts dans ma ville et cette ferveur au sein de ce milieu m’a donné envie d’y apporter ma modeste contribution au travers de ce site.
<br><br><br>
<h1>Historique du site</h1>
<br><br>
30 septembre 2020 – Début du développement du site<br>
X X 2021 – Mise en ligne du site en version bêta (version 1.0.0)<br>
X X 2021 – Ajout…<br>

