<div id="recherche">
	<div class="logo">
		<a href="./accueil.php">
			<img src="./image/logo.png" class="imglogo">
		</a>
	</div>
	<div class="nav">
		<div class="uppernav">
			<form class="searchbar" action="searchresult.php" method="post">
					<input class="champ"  type="recherche" name="searchfield" placeholder="Artiste/Salle/Festival/Ville/CP/Departement/Num departement/Région">
					<input class="o-search-submit" name="search" type="submit">
			</form>
			<?php 
				if (isset($_SESSION['pseudo']) == null)
				{
					?>
					<div class="identification">
						<div class="ajoutconcert">
							<img src="./image/concert.png" class="imgconcert">
							<a href="./ajoutconcert.php" class="button" role="button">Ajouter un concert</a>
						</div>
						<div class="barre"></div>
						<div class="memberspace">
							<div class="space">							
								<img src="./image/cadenas.png" class="imgcadenas">
								<a href="./connexion.php" class="spacelink" role="button">Mon espace</a>
							</div>
							<div class="inscription">
								<div class="mv"></div>
								<a href="./inscrire.php" class="inscrlink" role="button">Inscription </a>
							</div>
							<div class=contactimg>
								<img src="./image/bulle.png" class="imgbulle">
								<a href="./contact.php" class="contact" role="button">Contact</a>
							</div>
						</div>
					</div>
					<?php
				}
				else 
				{
					?>
					<div class="identification">
						<div class="ajoutconcert">
							<img src="./image/concert.png" class="imgconcert">
							<a href="./ajoutconcert.php" class="button" role="button">Ajouter un concert</a>
						</div>
						<div class="barre"></div>
						<div class="memberspace">
							<div class="space">							
								<img src="./image/cadenasopen.png" class="imgcadenas">
								<a href="./deconnexion.php" class="spacelink" role="button">Deconnexion</a>
							</div>
							<div class="inscription">
								<div class="mv"></div>
								<a href="./profil.php" class="inscrlink" role="button">Mon profil</a>
							</div>
							<div class=contactimg>
								<img src="./image/bulle.png" class="imgbulle">
								<a href="./contact.php" class="contact" role="button">Contact</a>
							</div>
						</div>
					</div>
					<?php
				}
			?>
		</div>
		<div class="lowernav">
			<a href=".\accueil.php" class="liun"><img class="imgmaison" src="./image/maison.png"></a>
			<a href=".\news.php" class="licinq">Nouveautés/Actualités</a>
			<a href=".\artistes.php" class="lideux">Tous les artistes</a>
			<a href=".\allconcerts.php" class="licinq">Tous les concerts</a>
			<a href=".\classement.php" class="licinq">Meilleurs contributeurs</a>
			<a href=".\presentation.php" class="lisix">Présentation/Fonctionnement</a>
			<a href=".\erreur.php" class="lisept">Signaler une erreur</a>
			<div class="reseaux">
				<a href="facebook.com"><img class="imgfb" src="./image/facebook.png"></a>
				<a href="instagram.com"><img class="imgig" src="./image/instagram.png"></a>
			</div>
		</div>
	</div>
</div>	
<div id=recherche-hidden>
	<div class=logo-hidden>
		<a href="./accueil.php">
			<img src="./image/logo-hidden.png" class="imglogo-hidden">
		</a>
	</div>
	<div class="lowernav-hidden">
		<a href=".\news.php" class="licinq">Nouveautés/Actualités</a>
		<a href=".\artistes.php" class="lideux">Tous les artistes</a>
		<a href=".\allconcerts.php" class="licinq">Tous les concerts</a>
		<a href=".\classement.php" class="licinq">Meilleurs contributeurs</a>
		<a href=".\presentation.php" class="lisix">Présentation/Fonctionnement</a>
		<a href=".\erreur.php" class="lisept">Signaler une erreur</a>
		<div class="reseaux-hidden">
			<a href="facebook.com"><img class="imgfb" src="./image/facebook.png"></a>
			<a href="instagram.com"><img class="imgig" src="./image/instagram.png"></a>
		</div>
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
			<a href = "contact.php"> <img src="./image/bulle.png" class="imgbulle-hidden"></a>
		</div>
		<div class="haut-hidden">
			<a href="#top"><img src="./image/up.png" class="up-hidden"></a>
		</div>
	</div>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</div>