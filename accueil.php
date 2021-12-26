<?php 
/*
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
	Type fichier : php
	Fonction : page accueil
	Emplacement : /
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui

	a mettre: scrollnav et header
*/
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'php/js.php';
			require('php/database.php');
			require('php/error.php');
			include 'contenu/reseaux.php';
		?>
		<script>
			//alert($(window).width());
		</script>
		<link rel="stylesheet" type="text/css" href="css/body/accueil.css">
	</head>
	<body>
		<header>
			<h1> <a href="accueil.php" id="logo"> Arpenid <div id="com">.com</div></a> </h1>
			<div id="corps">
				<a href="presentation.php" class="li"><div class="txtli">Fonctionnement</div></a>
				<a href="news.php" class="li"><div class="txtli">Actualités</div></a>
				<a href="artistes.php" class="li"><div class="txtli">Artistes</div></a>
				<a href="allconcerts.php" class="li"><div class="txtli">Concerts</div></a>
				<a href="classement.php" class="li"><div class="txtli">Contributeurs</div></a>
			</div>
			<div id="cnx">
				<a href="./connexion.php" class="spacelink" role="button"> <span> Connexion </span> </a>
			</div>
		</header>
		<div id="main">
			<?php
				$pseudo = $_SESSION['pseudo'];
				$requestpseudo = "SELECT id_user FROM utilisateur WHERE pseudo = '$pseudo'";
				$query = mysqli_query($con, $requestpseudo);
				$row = mysqli_fetch_array($query);
				$idpseudo = $row['id_user'];
			?>
			<?xml version="1.0" encoding="UTF-8"?> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><style>.cls-1{isolation:isolate;}.cls-2{fill:url(#linear-gradient);}.cls-3,.cls-4,.cls-5,.cls-6{mix-blend-mode:overlay;}.cls-3{fill:url(#linear-gradient-2);}.cls-4,.cls-6{fill:#fff;}.cls-4{opacity:0.54;}.cls-5{fill:url(#linear-gradient-3);}</style><linearGradient id="linear-gradient" x1="289.25" y1="197.4" x2="15.39" y2="-6.82" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#3a0101"></stop><stop offset="1" stop-color="#3a0101"></stop></linearGradient><linearGradient id="linear-gradient-2" x1="112.35" y1="192.52" x2="151.95" y2="-5.48" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fff"></stop><stop offset="0" stop-color="#fcfcfc"></stop><stop offset="0.08" stop-color="#c8c8c8"></stop><stop offset="0.17" stop-color="#999"></stop><stop offset="0.26" stop-color="#707070"></stop><stop offset="0.35" stop-color="#4d4d4d"></stop><stop offset="0.45" stop-color="#313131"></stop><stop offset="0.56" stop-color="#1b1b1b"></stop><stop offset="0.67" stop-color="#0c0c0c"></stop><stop offset="0.81" stop-color="#030303"></stop><stop offset="1"></stop></linearGradient><linearGradient id="linear-gradient-3" x1="118.96" y1="-13.01" x2="91.19" y2="164.42" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fff"></stop><stop offset="0.29" stop-color="#adadad"></stop><stop offset="0.64" stop-color="#515151"></stop><stop offset="0.88" stop-color="#171717"></stop><stop offset="1"></stop></linearGradient></defs><g class="cls-1"><g id="Layer_1" data-name="Layer 1"><rect class="cls-2" width="275.75" height="169.02"></rect><path class="cls-3" d="M164.35,154.27C120.21,115.88,57.83,86.12,12.13,133V27.51H235c-4,10.13-3.15,24.76,8.72,45.83C292.16,159.4,210.67,194.55,164.35,154.27Z" transform="translate(-12.13 -27.51)"></path><path class="cls-4" d="M235,27.51q-.55,1.44-1,2.94l-.19.75c0,.12-.07.25-.09.38l-.09.37c-.05.26-.11.51-.16.76l-.14.77c0,.25-.08.51-.12.76l-.06.39,0,.19,0,.19c-.05.51-.12,1-.15,1.54-.09,1-.11,2.07-.11,3.11a49.79,49.79,0,0,0,1.77,12.25c.54,2,1.17,4,1.87,5.91l.27.73.28.72.28.73c.09.24.19.48.29.72l.59,1.43.63,1.42q1.26,2.83,2.69,5.59c.23.46.48.92.72,1.37s.49.92.74,1.37l1.51,2.71a130.49,130.49,0,0,1,10,22.7q1,3,1.73,6c.51,2,.94,4,1.31,6.07a72,72,0,0,1,1.15,12.36,61.14,61.14,0,0,1-.31,6.2,53,53,0,0,1-1,6.14c-.22,1-.49,2-.77,3-.07.25-.15.5-.23.75s-.14.49-.23.74c-.16.49-.32,1-.5,1.47a45.66,45.66,0,0,1-2.5,5.69l-.36.69-.38.67-.19.34-.2.34-.4.66c-.55.88-1.12,1.75-1.73,2.59a43.21,43.21,0,0,1-4,4.79,46.08,46.08,0,0,1-9.71,7.72,50.53,50.53,0,0,1-5.52,2.85l-.72.3c-.24.1-.47.21-.72.3-.48.19-1,.39-1.45.56-1,.37-2,.69-2.94,1a58.23,58.23,0,0,1-12.2,2.29,64,64,0,0,1-24.54-3q-3-1-5.82-2.19c-1.9-.82-3.77-1.72-5.59-2.71a69.28,69.28,0,0,1-10.33-6.89l-.6-.49-.6-.5-1.18-1-1.18-1-.59-.51-.59-.5-2.38-2-1.19-1-1.21-1q-4.83-3.92-9.83-7.58A218.39,218.39,0,0,0,126.19,127q-5.4-3.06-11-5.74c-3.73-1.78-7.53-3.42-11.4-4.89S96,113.62,92,112.54A102.63,102.63,0,0,0,79.85,110c-1-.16-2-.27-3.07-.4-.52-.07-1-.11-1.55-.16l-1.54-.14c-2.06-.14-4.13-.26-6.2-.25s-4.14.07-6.2.2-4.12.37-6.16.71-4.07.74-6.08,1.2l-1.5.4c-.5.13-1,.26-1.5.41l-1.48.45-.38.11-.36.13-.74.25a70.22,70.22,0,0,0-11.34,5,79.11,79.11,0,0,0-10.37,6.8A88.51,88.51,0,0,0,12.13,133a88.49,88.49,0,0,1,9.23-8.29,79.88,79.88,0,0,1,10.36-6.83,70.91,70.91,0,0,1,11.35-5l.73-.25.37-.13.37-.11L46,111.9c.49-.16,1-.29,1.49-.42l1.5-.4c2-.47,4-.91,6.09-1.22s4.11-.54,6.17-.72,4.14-.23,6.21-.2,4.14.1,6.21.24l1.54.14c.52.05,1,.09,1.55.16,1,.12,2.06.23,3.08.4A102.88,102.88,0,0,1,92,112.4q6,1.62,11.81,3.82a162.49,162.49,0,0,1,22.43,10.63,217.67,217.67,0,0,1,20.84,13.52q5,3.66,9.84,7.57l1.21,1,1.19,1c.8.65,1.59,1.32,2.38,2l.6.5.59.51,1.17,1,1.18,1,.6.49.6.49a68.88,68.88,0,0,0,10.3,6.87q2.73,1.49,5.58,2.7c1.9.81,3.84,1.54,5.8,2.18a63.78,63.78,0,0,0,24.46,3,57.1,57.1,0,0,0,12.16-2.28c1-.31,2-.63,2.94-1,.49-.18,1-.37,1.44-.56.25-.09.48-.2.72-.3s.48-.19.71-.3a49.42,49.42,0,0,0,5.51-2.84,46,46,0,0,0,9.67-7.68,45,45,0,0,0,4-4.77c.61-.83,1.17-1.7,1.72-2.58l.4-.66.2-.33.19-.34.38-.68.36-.68a46.85,46.85,0,0,0,2.49-5.67c.18-.48.33-1,.5-1.46.09-.25.16-.5.23-.74s.16-.5.23-.75c.28-1,.54-2,.76-3a52.56,52.56,0,0,0,1-6.11,61.09,61.09,0,0,0,.31-6.19,70.89,70.89,0,0,0-1.13-12.34c-.36-2-.79-4.06-1.3-6.06s-1.09-4-1.72-6a129.85,129.85,0,0,0-10-22.69l-1.5-2.72-.74-1.36c-.23-.46-.48-.92-.72-1.38q-1.42-2.76-2.68-5.6l-.62-1.42-.59-1.44c-.1-.24-.2-.48-.29-.72l-.28-.72c-.09-.24-.19-.48-.28-.73l-.26-.73c-.71-2-1.34-3.92-1.87-5.92a49.85,49.85,0,0,1-1.75-12.26c0-1,0-2.08.12-3.11,0-.51.1-1,.16-1.54l0-.19,0-.2.06-.38c0-.26.07-.51.12-.77l.14-.76c.05-.25.11-.5.16-.76l.09-.38.09-.37.2-.75A29.85,29.85,0,0,1,235,27.51Z" transform="translate(-12.13 -27.51)"></path><path class="cls-5" d="M91.48,99.88C51.15,77.26,26.43,74,12.13,75.81V27.51H185.24C234.48,80.26,189.42,154.81,91.48,99.88Z" transform="translate(-12.13 -27.51)"></path><path class="cls-6" d="M185.24,27.51A84.39,84.39,0,0,1,195.8,41.33a69.08,69.08,0,0,1,7.14,15.85,59.05,59.05,0,0,1,1.89,8.51c.21,1.44.36,2.88.46,4.33s.12,2.91.09,4.36-.12,2.91-.27,4.35-.39,2.89-.68,4.31a44.76,44.76,0,0,1-2.54,8.33A42.65,42.65,0,0,1,197.73,99a42.13,42.13,0,0,1-5.65,6.64,45.1,45.1,0,0,1-6.86,5.37c-1.23.77-2.5,1.49-3.79,2.16s-2.62,1.27-4,1.81-2.72,1-4.11,1.47-2.79.81-4.21,1.14-2.85.59-4.28.82l-1.08.16-1.08.14-.54.07-.55,0-1.08.11c-.73.06-1.45.13-2.18.16s-1.45.07-2.17.1c-1.46,0-2.91,0-4.37,0a84.51,84.51,0,0,1-8.69-.68c-.72-.08-1.44-.19-2.16-.29l-1.07-.17-1.08-.18c-1.43-.25-2.86-.52-4.28-.83q-4.26-.92-8.45-2.15A144.17,144.17,0,0,1,109.7,109c-5.35-2.28-10.57-4.84-15.68-7.62l-3.81-2.1c-1.27-.7-2.54-1.41-3.82-2.09l-1.92-1c-.32-.18-.64-.34-1-.51l-1-.5-1.93-1-1.94-1c-5.19-2.6-10.46-5.06-15.82-7.28l-2-.83-2-.8c-.67-.27-1.36-.52-2-.78l-1-.38-.51-.19-.52-.18-2-.73-2.06-.7-1-.35-1-.32-1-.33L47,80.12,46.47,80c-2.78-.85-5.59-1.59-8.41-2.24s-5.69-1.18-8.57-1.58a74,74,0,0,0-8.67-.74l-1.09,0c-.36,0-.72,0-1.09,0-.72,0-1.45,0-2.17,0-1.45.07-2.9.19-4.34.37,1.44-.18,2.89-.3,4.34-.38.72,0,1.45-.06,2.17-.06h1.09l1.09,0a76.38,76.38,0,0,1,8.68.72c2.88.39,5.74.92,8.57,1.56S43.72,79,46.5,79.88L47,80l.52.16,1,.33,1,.32,1,.35,2.07.69,2.05.73.52.18.51.19,1,.38c.68.26,1.36.51,2,.78l2,.8,2,.82C68.27,88,73.54,90.42,78.74,93l1.94,1,1.94,1,1,.5,1,.51,1.92,1c1.28.68,2.55,1.39,3.82,2.09s2.54,1.41,3.82,2.1c5.1,2.77,10.32,5.32,15.66,7.61a145.85,145.85,0,0,0,16.37,5.91c2.78.81,5.59,1.53,8.43,2.14,1.42.31,2.85.57,4.27.83l1.08.17,1.07.17,2.16.3c2.88.36,5.77.6,8.67.68,1.45,0,2.9,0,4.35,0,.72,0,1.45-.05,2.17-.1s1.45-.1,2.17-.16l1.08-.1.55-.06.53-.07c.36,0,.72-.08,1.08-.14l1.08-.16c1.43-.22,2.86-.49,4.27-.82s2.81-.7,4.2-1.13,2.75-.92,4.09-1.46,2.66-1.15,4-1.8,2.55-1.38,3.77-2.15a44.83,44.83,0,0,0,6.85-5.34,42.45,42.45,0,0,0,9.78-14.23A44.83,44.83,0,0,0,204.3,83c.29-1.42.51-2.85.67-4.29s.25-2.89.29-4.34,0-2.9-.09-4.35-.24-2.89-.45-4.33a58.73,58.73,0,0,0-1.87-8.49,68.91,68.91,0,0,0-7.09-15.85A84.39,84.39,0,0,0,185.24,27.51Z" transform="translate(-12.13 -27.51)"></path></g></g></svg>
			<div id="texte">
				<h1> Arpenid.com </h1>
				<h2> Le rap indé, par le public, pour le public</h2>
				<a class="ajoutconcert" href="ajoutconcert.php"> Ajouter un concert </a>
				<a class="allconcerts" href="allconcerts.php"> Liste des concerts </a>
			</div>
			<div id="bottom">
				<div id="bottomun">
					<span> Participez à l'activité du site </span>
					<img src="image/transition.png" width="50" height="50">
					<span> Gagnez des points </span>
					<img src="image/transition.png" width="50" height="50">
					<span> Obtenez des récompenses </span>
				</div>
				<!--<div id="bottomdeux">
					<span> Mais surtout...</span>
				</div>
				<div id="bottomtrois">
					<span> Soutenez </span> la scène indépendante, <span> supportez </span> les artistes et <span> aidez </span> le public
				</div>-->
			</div>
		</div>
	</body> 
</html>

<script>
	$( document ).ready(function() {
        var width = $(window).width();
		var height = $(window).height();
		var viewboxw = width/10;
		var viewboxh = height/10;
		$('svg').css('height', height);
		$('svg').css('width', width);
		$('header').css('width', width);
		$('#main').css('height', height);
		$('#main').css('width', width);
		$('svg').attr('viewBox', "0 0 " + viewboxw + " " + viewboxh);
		console.log($('svg').css('width'));
    });
</script>


