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
	$string_url = $_SERVER['PHP_SELF'];

	parse_str($string_url);
	$finalstring_url = explode("/", $string_url);

?>
<link rel="stylesheet" type="text/css" href="css/reseaux.css">
<div id="reseaux">
	<a href="https://facebook.com" class="imgreseaux"><img class="imgfb" src="./image/facebook.png" alt="logo facebook"></a>
	<a href="https://instagram.com" class="imgreseaux"><img class="imgig" src="./image/instagram.png" alt="logo instagram"></a>
	<a href="https://discord.com" class="imgreseaux"><img class="imgdiscord" src="./image/discord.png" alt="logo discord"></a>
	<?php
	if($finalstring_url[2] == 'index.php')
	{?>
		<a href="contact.php" class="imgreseaux"><img class="contact" src="./image/bullewhite.png" alt="logo contact"></a><?php
	}
	else
	{?>
		<a href="contact.php" class="imgreseaux"><img class="contact" src="./image/bulle.png" alt="logo contact"></a><?php
	}?>
</div>