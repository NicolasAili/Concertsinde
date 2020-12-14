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
				$fb = $_POST['fb'];
				$ticket = $_POST['ticket'];
				//$adresse = $_POST['adresse'];
				//$cp = $_POST['cp'];

				$result = mysqli_query($con, "SELECT Nom_artiste FROM artiste WHERE Nom_artiste = '$artiste'");
				$row_cnt = mysqli_num_rows($result);
				if($row_cnt<1) //si pas de ligne trouvée
				{
					$insertartiste = "INSERT INTO artiste VALUES ('$artiste')";
					mysqli_query($con, $insertartiste);
				}
				/* Ferme le jeu de résultats */
				mysqli_free_result($result);

				$results = mysqli_query($con,"SELECT Nom_salle FROM salle WHERE Nom_salle = '$salle'");
				$row_cnt = mysqli_num_rows($results);
				if($row_cnt<1) //si pas de ligne trouvée
				{
					$insertsalle = "INSERT INTO salle (Nom_salle, Ville) VALUES ('$salle', '$ville')";
					mysqli_query($con, $insertsalle);
				}
				mysqli_free_result($results);

				$sql = "INSERT INTO concert (datec, heure, Nom_artiste, Nom_salle, Date_ajout, lien_fb, lien_ticket) VALUES ('$date', '$heure', '$artiste', '$salle', NOW(), '$fb', '$ticket')";
				mysqli_query($con, $sql);
				?>
				<div id="recap">
					<div class="inwhile">
						<h1> Récapitulatif : </h1>
						<div class="artiste"> <?php echo $_POST['artiste']; ?> </div>
						<div class="dahe">Date et heure</div>
						<div class="date"> <?php echo $_POST['date']; ?> </div>
						<div class="heure"> <?php echo $_POST['heure']; ?> </div>
						<div class="pacp">Pays, ville, adresse et CP</div>
						<?php
							$str = "SELECT adresse, pays, ville, cp, Region, Departement FROM salle WHERE Nom_salle = '$salle'";
							$result = mysqli_query($con, $str);
						?> 
						<?php $row = mysqli_fetch_array($result); ?>
						<div class="pays"><?php	echo $row['pays']; ?> </div>
						<div class="region"><?php	echo $row['Region']; ?> </div>
						<div class="departement"><?php	echo $row['Departement']; ?> </div>
						<div class="ville"> <?php echo $row['ville']; ?></div>
						<div class="cp"> <?php echo $row['cp']; ?> </div>
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
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>

