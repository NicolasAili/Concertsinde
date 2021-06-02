<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Artistes</title>
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Artistes" />
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/body/artiste.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/allconcerts.css" media="screen" />	
		<script type="text/javascript" src="./js/scriptform.js"></script> 
	</head>
	<header>
		<?php /*include('header.php'); */?>
	</header>
	<body>
		<h1> Artistes </h1>

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
		$artiste = $_GET['artiste'];
		echo '<img src="./image/artiste/' . $artiste . '.jpg' . '" class="imgcadenas">';
		echo '<h1>' . $artiste . '</h1>';
		$sql = "SELECT description FROM artiste WHERE Nom_artiste = $artiste";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result);
		if(!$row)
		{
			?> 
			<form method="post" class="connect" action="adddescr.php">
				<input type="text" name="description" id="description" placeholder="Il n'existe pas de description pour cet artiste, vous pouvez en ajouter une"  >
				<input type="hidden" id="artiste" name="artiste" <?php echo 'value="' . $artiste . '"' ?> > 
				<input type="submit" value="Enregister la description" id="valider" name="concert" href="">
			</form>
			<?php
		}
		else
		{
			echo $row[0];	
		}
		$sql = "SELECT id_concert FROM concert, artiste WHERE concert.nom_artiste = artiste.Nom_artiste AND artiste.Nom_artiste = $artiste";
		$result = mysqli_query($con, $sql);
		?>
		<div id="concertsall">
				<?php
				while($rowx = mysqli_fetch_array($result)) 
				{
					$idconcert = $rowx['id_concert'];
					$row['ville_departement'] = NULL;
					$rowdpt['id_region'] = NULL;
					$rowdpt['nom_departement'] = NULL;
					$rowrgn['nom_pays'] = NULL;
					$rowrgn['nom_region'] = NULL;
					$str = "SELECT datec, heure, lien_fb, lien_ticket, id_salle, adresse, nom_salle, nom_ext, intext, nom_ville, ville_code_postal, ville_departement FROM concert, artiste, salle, ville WHERE concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND id_concert = $idconcert";
					$resultx = mysqli_query($con, $str);
					$row = mysqli_fetch_array($resultx);
					if($row['ville_departement'])
					{
						$filter = 1;
						$str = "SELECT nom_departement, id_region FROM departement, ville, salle, concert WHERE concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND ville_departement = departement.numero AND id_concert = $idconcert ";
						$resultdpt = mysqli_query($con, $str);
						$rowdpt = mysqli_fetch_array($resultdpt);
						if($rowdpt['id_region'])
						{
							$str = "SELECT nom_region, nom_pays FROM pays, region, departement, ville, salle, concert WHERE concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND ville_departement = numero AND departement.id_region = region.id AND region.id_pays = pays.id AND id_concert = $idconcert ";
							$resultrgn = mysqli_query($con, $str);
							$rowrgn = mysqli_fetch_array($resultrgn);
						}
					}
					/*else
					{
						$filter = 0;
					}*/
				?> 

					<div class="inwhile"> 
							<div class="dahe">Date et heure</div>
						<div class="date"> <?php echo  $row['datec'] ?> </div>  
						<div class="heure"> <?php echo $row['heure'] ?> </div>  
							<div class="pacp">Pays, region, departement</div>
						<?php
						if($rowdpt['id_region'])
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
						if($row['ville_departement'])
						{
							?>
							<div class="departement"> <?php echo  $rowdpt['nom_departement'] ?> </div> 
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
						if($row['ville_code_postal'])
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
<?php require "./messages.php"; ?> 
	</body>