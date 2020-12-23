<!DOCTYPE html>
<html>
	<head>
		<title>Recap</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/concert.css" media="screen" />		
		<title></title>
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
	</head>
	
	<body>
		<?php	      
			$servername = 'localhost';
			$username = 'root';
			$password = '';
			$dbname = 'webbd';
			//Connexion à la BDD
			$con = mysqli_connect($servername, $username, $password, $dbname);
			//Vérification de la connexion
			if(mysqli_connect_errno($con))
			{
				echo "Erreur de connexion" .mysqli_connect_error();
			}

			if (isset($_POST['concert']))
			{
				$artiste = $_POST['artiste'];
				$date = $_POST['date'];
				$heure = $_POST['heure'];
				//$pays = $_POST['pays'];
				$ville = $_POST['ville'];
				$salle = $_POST['salle'];
				$denom = $_POST['denom'];
				$fb = $_POST['fb'];
				$ticket = $_POST['ticket'];
				$adresse = $_POST['adresse'];
				$cp = $_POST['cp'];
				$departement = $_POST['departement'];
				$region = $_POST['region'];
				$result = mysqli_query($con, "SELECT Nom_artiste FROM artiste WHERE Nom_artiste = '$artiste'");
				$row_cnt = mysqli_num_rows($result);
				if($row_cnt<1) //si pas de ligne trouvée
				{
					$insertartiste = "INSERT INTO artiste VALUES ('$artiste')";
					mysqli_query($con, $insertartiste);
				}
				/* Ferme le jeu de résultats */
				mysqli_free_result($result);

				$results = mysqli_query($con,"SELECT nom_salle FROM salle WHERE nom_salle = '$salle'");
				$row_cnt = mysqli_num_rows($results);
				if($row_cnt<1) //si pas de ligne trouvée
				{
					$idville = "SELECT ville_id FROM ville WHERE ville_nom = '$ville'";
					$query = mysqli_query($con, $idville);
					$row = mysqli_fetch_array($query);
					$vle = $row['ville_id'];
					$insertsalle = "INSERT INTO salle (nom_salle, adresse, id_ville) VALUES ('$salle', '$adresse', '$vle')";
					mysqli_query($con, $insertsalle);
				}
				else //ici on teste l'adresse et la ville
				{
					$test = "SELECT adresse, nom_ville FROM salle, ville WHERE nom_salle = '$salle' AND salle.id_ville = ville.ville_id";
					$query = mysqli_query($con, $test);
					$row = mysqli_fetch_array($query);
					$test_adresse = $row['adresse'];
					$test_ville = $row['nom_ville'];
					if($test_adresse != $adresse)
					{
						$insertadresse = "UPDATE salle SET adresse = '$adresse' WHERE nom_salle = '$salle'";
						mysqli_query($con, $insertadresse);
					}
					if($test_ville != $ville)
					{
						$test = "SELECT ville_id FROM ville WHERE nom_ville = '$ville'";
						$query = mysqli_query($con, $test);
						$row = mysqli_fetch_array($query);
						$test_id = $row['ville_id'];
						$insertville = "UPDATE salle SET id_ville = '$test_id' WHERE nom_salle = '$salle'";
						mysqli_query($con, $insertville);
					}
				}
				mysqli_free_result($results);
				$idsalle = "SELECT id_salle FROM salle WHERE nom_salle = '$salle'";
				$query = mysqli_query($con, $idsalle);
				$row = mysqli_fetch_array($query);
				$sle = $row['id_salle'];
				$sql = "INSERT INTO concert (datec, heure, nom_artiste, fksalle, date_ajout, lien_fb, lien_ticket) VALUES ('$date', '$heure', '$artiste', '$sle', NOW(), '$fb', '$ticket')";
				mysqli_query($con, $sql);
				?>
				<div id="recap">
					<div class="inwhile">
						<h1> Récapitulatif : </h1>
						<div class="artiste"> <?php echo $_POST['artiste']; ?> </div>
						<div class="dahe">Date et heure </div>
						<div class="date"> <?php echo $_POST['date']; ?> </div>
						<div class="heure"> <?php echo $_POST['heure']; ?> </div>
						<div class="pacp">Pays, ville, adresse et CP </div>
						<?php
							$pvcpz = "SELECT adresse, nom_ville, ville_code_postal, nom_departement, nom_region, nom_pays FROM salle, ville, departement, region, pays WHERE salle.nom_salle = '$salle' AND salle.id_ville = ville.ville_id AND ville.ville_departement = departement.numero AND departement.id_region = region.id AND region.id_pays = pays.id";
							$result = mysqli_query($con, $pvcpz);
						?> 
						<?php $row = mysqli_fetch_array($result); ?>
						<div class="pays"><?php	echo $row['nom_pays']; ?> </div>
						<div class="region"><?php	echo $row['nom_region']; ?> </div>
						<div class="departement"><?php	echo $row['nom_departement']; ?> </div>
						<div class="ville"> <?php echo $row['nom_ville']; ?></div>
						<div class="cp"> <?php echo $row['ville_code_postal']; ?> </div>
						<div class="saad">Salle et adresse</div>
						<div class="salle"> <?php echo $_POST['salle']; ?> </div>
						<div class="adresse"> <?php echo $row['adresse'];  ?> </div>
						<div class="saad">Liens relatifs a l'evenement</div>
						<div class="fb"> <?php echo $_POST['fb']; ?> </div>
						<div class="ticket"> <?php echo $_POST['ticket']; ?> </div>
					</div>
					<a href="allconcerts.php"> retour en arriere </a>
				</div>
				<?php
			}
		?>
	</body>
	<!--<script type="text/javascript" src="./js/scrollnav.js"></script> -->
</html>

