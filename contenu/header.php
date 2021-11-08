<?php
/*
	Type fichier : php
	Fonction : affiche le header
	Emplacement : contenu
	Connexion à la BDD : oui 
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui
*/
?>
<link rel="stylesheet" type="text/css" href="css/header.css">
<div id="recherche">
	<div class="nav">
		<a href="accueil.php" id="logo">
			<img src="./image/logo.png" class="imglogo">
		</a>
		<a href="presentation.php" class="li"><div class="txtli">Fonctionnement</div></a>
		<a href="news.php" class="li"><div class="txtli">Actualités</div></a>
		<a href="artistes.php" class="li"><div class="txtli">Artistes</div></a>
		<a href="allconcerts.php" class="li"><div class="txtli">Concerts</div></a>
		<a href="classement.php" class="li"><div class="txtli">Contributeurs</div></a>
		<div class="ajoutconcert">
			<a href="./ajoutconcert.php" class="button" role="button">Ajouter un concert</a>
		</div>
		
		<div id="loupe">
			<img src="./image/loupe.png" id="loupeimg" onclick="recherche();">
		</div>
		<?php

		require('php/database.php');
	
		$pseudo = $_SESSION['pseudo'];
		$sql = "SELECT admin, id_user FROM utilisateur WHERE pseudo = '$pseudo'";
		$result = mysqli_query($con ,$sql);
		$row = mysqli_fetch_array($result);
		$pseudoid = $row['id_user'];

		$count = 0;
		$sql = "SELECT id FROM message WHERE utilisateur = '$pseudoid' AND lu = 0";
		$querymsg = mysqli_query($con, $sql);
		while ($rowmsg = mysqli_fetch_array($querymsg)) 
		{
			$count++;
		}						
			if (isset($_SESSION['pseudo']) == null)
			{
				?>
				<div class="barre"></div>
				<div class="space">							
					<a href="./connexion.php" class="spacelink" role="button"><img src="./image/cadenas.png" class="imgcadenas"> <div id="txtspace">Connexion</div></a>
				</div>
				<?php
			}
			else 
			{
				?>
				<div class="barre"></div>
				<div class="space">							
					<a href="./profil.php" class="spacelink" role="button"><img src="./image/cadenasopen.png" class="imgcadenas"> <div id="txtspace">Profil</div></a>
				</div>
				<?php
				switch ($count) {
					case '0':
						# rien à faire
						break;
					case '1':
						?> <img src="./image/notifun.png" id="notifun"> <?php
						break;
					case '2':
						?> <img src="./image/notifdeux.png" id="notifun"> <?php
						break;					
					default:
						?> <img src="./image/notiftrois.png" id="notifun"> <?php
						break;
				}?>
				<?php
			}
		?>
	</div>
</div>	
<!--<div id=recherche-hidden>
	<div class=logo-hidden>
		<a href="./accueil.php">
			<img src="./image/logo-hidden.png" class="imglogo-hidden">
		</a>
	</div>
	<div class="lowernav-hidden">
		<a href=".\presentation.php" class="li">Fonctionnement</a>
		<a href=".\news.php" class="li">Actualités</a>
		<a href=".\artistes.php" class="li">Artistes</a>
		<a href=".\allconcerts.php" class="li">Concerts</a>
		<a href=".\classement.php" class="li">Contributeurs</a>
	</div>
	<div class=logos>
		<?php 
			if (isset($_SESSION['pseudo']) == null)
			{ ?>
				<div class="space-hidden">
					<a href="./connexion.php"><img src="./image/cadenas.png" class="imgcadenas-hidden"></a>
				</div>
			<?php
			}
			else 
			{
				?>
				<div class="space-hidden">
					<a href = "./profil.php"><img src="./image/cadenasopen.png" class="imgcadenas-hidden"></a>
				</div>
				<?php
			}
		?>
		<div class=contact-hidden>
			<a href = "contact.php"><img src="./image/bulle.png" class="imgbulle-hidden"></a>
		</div>
		<div class="haut-hidden">
			<a href="#top"><img src="./image/up.png" class="up-hidden"></a>
		</div>
	</div>
</div>-->
<div id="bar">
	<img src="./image/loupe.png" id="loupebar">
	<form class="searchbar" action="searchresult.php" method="post">
		<input class="champ"  type="recherche" name="searchfield" placeholder="Artiste/Salle/Festival/Ville/CP/Departement/Num departement/Région">
		<input class="o-search-submit" name="search" type="submit" value="OK">
	</form>
	<div>
		<img src="./image/close.png" id="closebar" onclick="fermer();">
	</div>
</div>