<?php
    session_start();
    ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
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
			$admin = 'administateur';
			//echo $_SESSION['pseudo'];
			//echo $admin;
			$str = "SELECT id_concert FROM concert";
			$result = mysqli_query($con, $str);
			?>
			<div id="concertsall">
				<?php
				while($rowx = mysqli_fetch_array($result)) 
				{
					$idconcert = $rowx['id_concert'];
					$str = "SELECT datec, heure, lien_fb, lien_ticket, concert.nom_artiste, id_salle, adresse, nom_salle, nom_ext, intext, nom_ville, ville_code_postal, ville_departement FROM concert, artiste, salle, ville WHERE concert.nom_artiste = artiste.Nom_artiste AND concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND id_concert = $idconcert ";
					$resultx = mysqli_query($con, $str);
					$row = mysqli_fetch_array($resultx);
					if($row[ville_departement])
					{
						$str = "SELECT nom_departement, id_region FROM departement, ville, salle, concert WHERE oncert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND ville_departement = departement.numero AND id_concert = $idconcert ";
						$resultdpt = mysqli_query($con, $str);
						$rowdpt = mysqli_fetch_array($resultdpt);
						if($rowdpt[id_region])
						{
							$str = "SELECT nom_region, nom_pays FROM pays, region, departement, ville, salle, concert WHERE concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND ville_departement = numero AND departement.id_region = region.id AND region.id_pays = pays.id AND id_concert = $idconcert ";
							$resultrgn = mysqli_query($con, $str);
							$rowrgn = mysqli_fetch_array($resultrgn);
						}
					}
				?> 

					<div class="inwhile"> 
						<div class="artiste"> <?php echo $row['nom_artiste'] ?> </div> 
							<div class="dahe">Date et heure</div>
						<div class="date"> <?php echo  $row['datec'] ?> </div>  
						<div class="heure"> <?php echo $row['heure'] ?> </div>  
							<div class="pacp">Pays, region, departement</div>
						<?php
						if($rowdpt[id_region])
						{
							?>
							<div class="pays"> <?php echo  $rowrgn['nom_pays'] ?> </div>
							<div class="region"> <?php echo  $rowrgn['nom_region'] ?> </div> 
							<?php 
						}
						else
						{
							?>
							<div class="pays"> Pays non renseigné </div>
							<div class="region"> Région non renseignée </div> 
							<?php
						}
						if($row[ville_departement])
						{
							?>
							<div class="departement"> <?php echo  $row['nom_departement'] ?> </div> 
							<?php
						}
						else
						{	
							?>
							<div class="departement"> Département non renseigné </div> 
							<?php
						}
							?>
							<div class="villexcp"> Ville et CP </div>
						<div class="ville"> <?php echo $row['nom_ville'] ?> </div> 
						<?php
						if($row[ville_code_postal])
						{
							?>
							<div class="cp"> <?php echo  $row['ville_code_postal'] ?> </div>
							<?php
						}
						else
						{
							?>
								<div class="cp"> Code postal non renseigné </div>
							<?php
						}
						if($row['intext'] == 'int')
						{
						?>
							<div class="saad">Lieu, adresse et salle</div> 
							<br>
							Concert intérieur
							<br>
						<div class="salle"> <?php echo  $row['nom_salle'] ?> </div> 
						<?php
						} 
						else
						{
						?>
							<div class="saad">Lieu, adresse et salle</div> 
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
							<input type="hidden" id="idpost" name="idpost" <?php echo 'value="' . $idconcert . '"' ?> > 
							<input type="hidden" id="idsallepost" name="idsallepost" <?php echo 'value="' . $row['id_salle'] . '"' ?> > 
							<input type="hidden" id="artistepost" name="artistepost" <?php echo 'value="' . $row['nom_artiste'] . '"' ?> > 
							<input type="hidden" id="datepost" name="datepost" <?php echo 'value="' . $row['datec'] . '"' ?> > 
							<input type="hidden" id="heurepost" name="heurepost" <?php echo 'value="' . $row['heure'] . '"' ?> > 
							<input type="hidden" id="payspost" name="payspost" <?php echo 'value="' . $rowrgn['nom_pays'] . '"' ?> > 
							<input type="hidden" id="regionpost" name="regionpost" <?php echo 'value="' . $rowrgn['nom_region'] . '"' ?> > 
							<input type="hidden" id="departementpost" name="departementpost" <?php echo 'value="' . $rowdpt['nom_departement'] . '"' ?> > 
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


