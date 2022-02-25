<?php
/*
	Type fichier : php
	Fonction : liens vers les réseaux sociaux
	Emplacement : contenu
	Connexion à la BDD :  non
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui
*/
	$string = $_SERVER['PHP_SELF'];

	parse_str($string);
	$finalstring = explode("/", $string);

?>
<link rel="stylesheet" type="text/css" href="css/reseaux.css">
<div id="reseaux">
	<a href="https://facebook.com" class="imgreseaux"><img class="imgfb" src="./image/facebook.png"></a>
	<a href="https://instagram.com" class="imgreseaux"><img class="imgig" src="./image/instagram.png"></a>
	<a href="https://discord.com" class="imgreseaux"><img class="imgdiscord" src="./image/discord.png"></a>
	<?php
	if($finalstring[2] == 'accueil.php')
	{?>
		<a href="contact.php" class="imgreseaux"><img class="contact" src="./image/bullewhite.png"></a><?php
	}
	else
	{?>
		<a href="contact.php" class="imgreseaux"><img class="contact" src="./image/bulle.png"></a><?php
	}?>
</div>