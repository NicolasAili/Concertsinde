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

	Présentation
L'objectif de notre site web est de permettre aux fans de rap indépendant de pouvoir être facilement au courant des concerts futurs au sein de ce milieu, et ce de manière libre et gratuite.
Ce site a pour car caractéristique principale d'être communautaire. Cela signifie que ce sont les fans qui font vivre le site, chacun peut -et ce de manière anonyme- renseigner un concert et ainsi aider l'ensemble des utilisateurs.
Nous vous invitons néanmoins à créer un compte, cela vous permettra (entre autres) de modifier les concerts qui ont déjà été renseignés mais qui pourraient comporter des erreurs. 
En étant connectés, vous pouvez en outre gagner des points permettant d’obtenir des récompenses (cd, places de concert, vêtements, bons d’achat etc…) en fonction de votre activité sur le site (voir partie « fonctionnement »).

D’où vient l’idée/pourquoi ce site
Me rendant régulièrement à des concerts de rap indé, j’ai remarqué qu’il n’existait pas de plateforme recensant tous les concerts. Il y a bien le site « info concert » mais plusieurs concerts de rap français indépendant n’y apparaissent pas. Tout comme les plus petits concerts.
De ce fait le moyen le plus simple d’être au courant des concerts est soit le bouche à oreille soit de suivre assidument les pages d’organisateur ou bien les pages d’artistes sur les réseaux. Or, tout le monde n’a pas forcément le temps de le faire et il est très facile de rater des informations. 
Le fait aussi que ce milieu dispose de peu de moyens rend la communication parfois légère voire inexistante. 
En conséquence, de nombreux concerts se retrouvent en sous-effectif du fait que tout le monde n’est pas mis au courant des concerts auxquels ils auraient pu assister.
Je me souviens par exemple d’un concert de Davodka il y a de ça quelques années, où j’avais trouvé qu’il y avait très peu de monde (un petit tiers de salle) par rapport à la popularité de l’artiste.
Voilà la raison de l’existence de ce site : faire de cette plateforme un outil gratuit où public et artistes peuvent participer librement à l’expansion du rap indépendant au plus grand nombre.




Fonctionnement
Le fonctionnement du site est assez simple avec trois principales utilisations :
-	Consulter la liste des concerts
-	Ajouter un concert
-	Modifier un concert
Une fois un concert ajouté, les utilisateurs peuvent le modifier et lorsque toutes informations ont vérifiées (et éventuellement corrigées) par un administrateur, le concert est validé et n’est plus modifiable. Des points sont attribués aux utilisateurs ayant participé au renseignement du concert (ajout et modifications).
Pour plus de détails et connaître les autres fonctionnalités consultez les sections ci-dessous.

Ajout d’un concert
Pour ajouter un concert, cliquez sur le bouton correspondant juste à droite de la barre de recherche.
Vous pouvez ajouter un concert sans être connectés mais si vous avez un compte n’hésitez pas à vous connecter afin de gagner des points (et des récompenses par la suite).
Une fois sur la page, remplissez les champs que vous connaissez. Vous n’êtes pas obligés de tout remplir à l’exception des champs obligatoires qui sont les suivants :
-	Nom de l’artiste/du groupe
-	Date du concert
-	Lieu du concert (en extérieur ou en intérieur)
-	Salle (si concert intérieur)
-	Ville
A noter que lorsque vous remplissez (par exemple) le nom de la salle, une recherche est faite dans notre base de donnée et si la salle y existe, les champs qui suivent se remplissent automatiquement. 
Une fois les champs connus remplis, cliquez sur « enregistrer le concert », une fenêtre récapitulative des informations saisies va s’ouvrir. Vérifiez-les, et si tout est correct, enregistrez le concert (vous pourrez toujours le modifier par la suite), sinon modifiez les informations incorrectes.
Enfin vous pourrez voir le concert que vous avez enregistré, vous pouvez pour terminer revenir en arrière et constater que votre concert a bien été ajouté (page « tous les concerts »)
Note : Vous pouvez directement consulter vos concerts ajoutés si vous possédez un compte (page « mon profil », « voir mes concerts ajoutés »)
Modification d’un concert
Pour modifier un concert, consultez la liste des concerts (page « tous les concerts »). Sous les concerts non validés uniquement, vous verrez un bouton « modifier ». Il est obligatoire d’avoir un compte pour modifier un concert, si vous n’êtes pas connectés vous ne verrez pas le bouton de modification.
Si vous constatez une erreur sur un concert validé, n’hésitez pas à faire remonter cette erreur (bouton « signaler un problème sur ce concert »)
Une fois le bouton « modifier » cliqué, vous pourrez apercevoir le concert avec les différents champs qui ont été déjà saisi. Tout comme pour l’ajout d’un concert, lorsque vous commencez à saisir un champ, une requête dans notre base de données est effectuée et si le champ saisi y est présent, les champs qui suivent (liés au champ saisi) se remplissent automatiquement. 
Absolument tout est modifiable (ou ajoutable si ça n’a pas été renseigné) à l’exception des champs suivants :
-	Nom de l’artiste
-	Champs liés à une ville (CP, département etc…)
A noter que (normalement) toutes les villes françaises sont présentes en base de données. Vous pouvez si vous le souhaitez ajouter un concert à l’étranger. Si la ville étrangère n’est pas dans notre base de données vous aurez dans ce cas la possibilité de renseigner les informations liées à la ville (département, région, pays etc…)
Vous disposez enfin des boutons suivants :
Enregistrer le concert : enregistre les modifications effectuées
Réinitialiser le formulaire : remets les champs à leur valeur d’origine
Effacer tous les champs : efface le contenu de tous les champs
Annuler : retourne à la page avec tous les concerts

Validation d’un concert
Lorsque tous les champs d’un concert sont corrects, un administrateur peut valider le concert. A la validation d’un concert, les points sont distribués aux utilisateurs ayant participés au renseignement du concert (voir section « système de points »).
Pour l’instant je suis le seul administrateur du site mais j’espère ne pas l’être indéfiniment.



Système de points
Si vous avez un compte et que vous participez à l’activité du site, vous avez la possibilité de gagner des points. Ces points vous permettront de gagner des récompenses à la fin d’une « session ». 
Une session est une certaine durée de temps (pas encore définie). A la fin d’une session, les utilisateurs qui ont le plus de points se verront gagner des récompenses (cd, places de concert, vêtements, bons d’achat etc…) pour les remercier de leur contribution.
L’attribution des points se fait lorsqu’un concert est validé par un administrateur, elle se fait de la manière suivante :
Ajout d'un concert : +5 points si aucun champ modifié, +3 points si un ou plusieurs champs modifiés
Modification d'un concert: +1 point par champ modifié et validé
Si vous avez modifié un champ mais qu’il n’est pas correct, ou que vous avez ajouté un concert inexistant, vous ne gagnerez aucun point.

Affichage des concerts
Vous pouvez afficher les concerts dans la page « tous les concerts » (ou sur la page d’un artiste). 
N’hésitez pas à jouer avec les filtres afin de peaufiner votre recherche. Vous pouvez également utiliser la barre de recherche.

Création d’un compte
Rendez-vous sur « inscription » afin de créer un compte. Vous devez renseigner un e-mail valide (aucun mail ne vous sera envoyé, promis)
Mon profil
Sous la page « mon profil », vous pouvez modifier votre mot de passe, votre mail, afficher vos points ainsi qu’afficher vos concerts ajoutés/modifiés.
Si vous avez modifié un concert mais qu’il a été modifié par la suite, il est normal que vous ne voyiez pas vos modifications.


Signaler une erreur
Si vous constatez une erreur, peu importe sa nature, n’hésitez pas à faire remonter cette erreur (onglet « signaler une erreur »). Cela est une aide précieuse afin de faire évoluer le site et en rendre son utilisation plus agréable.
Page artiste
Sur la page d’un artiste, vous pouvez lire sa description (ou l’ajouter si elle n’existe pas et que vous êtes connectés), ainsi que consulter ses concerts passés et futurs.
Vous pouvez également ajouter un artiste s’il n’existe pas dans la base de données.

Contact
N’hésitez pas à me contacter si vous avez la moindre question ou une idée d’amélioration. Vous pouvez également me contacter via facebook.

FAQ
Comment ajouter un concert ?
Comment modifier un concert ?




Qui suis-je ?

Etudiant en école d’ingénieur, j’écoute du rap français (principalement indépendant) depuis de nombreuses années. J’ai eu l’occasion de me rendre à de nombreux concerts dans ma ville et cette ferveur au sein de ce milieu m’a donné envie d’y apporter ma modeste contribution au travers de ce site.

Historique du site
30 septembre 2020 – Début du développement du site
X X 2021 – Mise en ligne du site en version bêta (version 1.0.0)
X X 2021 – Ajout…

