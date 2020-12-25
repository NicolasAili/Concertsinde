<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tous les concerts</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/allconcerts.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />		
		<?php include("supprimer.php"); // on appelle le fichier?>
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
	</head>
	<header>
		<?php include('header.php'); ?>
	</header>
	<body>
		<h1>Tous les concerts</h1>
		<?php
			//echo $_SESSION['pseudo'];
			echo "</br>";
			echo "</br>";
		?>
	 	<?php
			$servername = 'localhost';
			$username = 'root';
			$password = '';
			$dbname = 'webbd';

			//Connexion à la BDD
			$con = mysqli_connect($servername, $username, $password, $dbname);

			//Vérification de la connexion
			if(mysqli_connect_errno($con)){
			echo "Erreur de connexion" .mysqli_connect_error();
			}
		?>
		<?php
			$str = "SELECT id_concert, datec, heure, lien_fb, lien_ticket, concert.nom_artiste, adresse, nom_salle, nom_ext, intext, nom_ville, ville_code_postal, nom_departement, nom_region, nom_pays FROM concert, artiste, salle, ville, departement, region, pays WHERE concert.nom_artiste = artiste.Nom_artiste AND concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND ville.ville_departement = departement.numero AND departement.id_region = region.id AND region.id_pays = pays.id";
			$result = mysqli_query($con, $str);
			$admin = 'administateur';
			//echo $_SESSION['pseudo'];
			//echo $admin;
			?>
			<div id="concertsall">
				<?php
				while($row = mysqli_fetch_array($result)) 
				{
				?> 
					<div class="inwhile"> 
						<div class="artiste"> <?php echo $row['nom_artiste'] ?> </div> 
							<div class="dahe">Date et heure</div>
						<div class="date"> <?php echo  $row['datec'] ?> </div>  
						<div class="heure"> <?php echo $row['heure'] ?> </div>  
							<div class="pacp">Pays ville et CP</div>
						<div class="pays"> <?php echo  $row['nom_pays'] ?> </div> 
						<div class="region"> <?php echo  $row['nom_region'] ?> </div> 
						<div class="departement"> <?php echo  $row['nom_departement'] ?> </div> 
						<div class="ville"> <?php echo $row['nom_ville'] ?> </div> 
						<div class="cp"> <?php echo  $row['ville_code_postal'] ?> </div>
						<?php
						if($row['intext'] == 'int')
						{
						?>
							<div class="saad">Salle et adresse</div> 
							<br>
							Concert intérieur
							<br>
						<div class="salle"> <?php echo  $row['nom_salle'] ?> </div> 
						<?php
						} 
						else
						{
						?>
							<div class="saad">Lieu et adresse</div> 
							<br>
							Concert extérieur
							<br>
						<div class="salle"> <?php echo  $row['nom_ext'] ?> </div>
						<?php	
						}
						?>
						<div class="adresse"> <?php echo $row['adresse'] ?> </div> 
						<div class="saad">Liens relatifs a l'evenement</div>
						<div class="fb"> <?php echo  $row['lien_fb'] ?> </div> 
						<div class="ticket"> <?php echo  $row['lien_ticket'] ?> </div> 
						<form method="post" action="modifconcert.php" class="modif">
							<input type="hidden" id="idpost" name="idpost" <?php echo 'value="' . $row['id_concert'] . '"' ?> > 
							<input type="hidden" id="artistepost" name="artistepost" <?php echo 'value="' . $row['nom_artiste'] . '"' ?> > 
							<input type="hidden" id="datepost" name="datepost" <?php echo 'value="' . $row['datec'] . '"' ?> > 
							<input type="hidden" id="heurepost" name="heurepost" <?php echo 'value="' . $row['heure'] . '"' ?> > 
							<input type="hidden" id="payspost" name="payspost" <?php echo 'value="' . $row['nom_pays'] . '"' ?> > 
							<input type="hidden" id="regionpost" name="regionpost" <?php echo 'value="' . $row['nom_region'] . '"' ?> > 
							<input type="hidden" id="departementpost" name="departementpost" <?php echo 'value="' . $row['nom_departement'] . '"' ?> > 
							<input type="hidden" id="villepost" name="villepost" <?php echo 'value="' . $row['nom_ville'] . '"' ?> > 
							<input type="hidden" id="cppost" name="cppost" <?php echo 'value="' . $row['ville_code_postal'] . '"' ?> > 
							<input type="hidden" id="intextpost" name="intextpost" <?php echo 'value="' . $row['intext'] . '"' ?> > 
							<input type="hidden" id="extpost" name="extpost" <?php echo 'value="' . $row['nom_ext'] . '"' ?> > 
							<input type="hidden" id="sallepost" name="sallepost" <?php echo 'value="' . $row['nom_salle'] . '"' ?> > 
							<input type="hidden" id="adressepost" name="adressepost" <?php echo 'value="' . $row['adresse'] . '"' ?> > 
							<input type="hidden" id="fbpost" name="fbpost" <?php echo 'value="' . $row['lien_fb'] . '"' ?> > 
							<input type="hidden" id="ticketpost" name="ticketpost" <?php echo 'value="' . $row['lien_ticket'] . '"' ?> > 
							<style type="text/css">
								#footer 
								{
								  display:flex;
								}
							</style>
							<div id="footer">
								<input id="modifier" type="submit" name="modsuppr" value="Modifier"> 
								<input id="supprimer" type="submit" name="modsuppr" value="Supprimer"> 
							</div>
						</form>
					</div>
				<?php
	 			}
	 			?>
			</div>
	</body>
	<?php include('footer.html'); ?>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>


