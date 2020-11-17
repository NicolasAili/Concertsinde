<!DOCTYPE html>
<html>
	<head>
		<title>Recap</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/concert.css" media="screen" />		
		<?php include("salle.php"); // on appelle le fichier?>
		<titleC></title>
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
	</head>
	<header>
		<?php include('header.php'); ?>
	</header>
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
				$pays = $_POST['pays'];
				$ville = $_POST['ville'];
				$salle = $_POST['salle'];
				$adresse = $_POST['adresse'];
				$cp = $_POST['cp'];
				$sql = "INSERT INTO concert (artiste, date, heure, pays, ville, salle, adresse, cp) VALUES ('$artiste', '$date', '$heure', '$pays', '$ville', '$salle', '$adresse', '$cp')";
				mysqli_query($con, $sql);
				?>
				<div id="recap">
					<div class="inwhile">
						<h1> Récapitulatif : </h1>
						<div class="artiste"> <?php echo $_POST['artiste']; ?> </div>
						<div class="dahe">Date et heure</div>
						<div class="date"> <?php echo $_POST['date']; ?> </div>
						<div class="heure"> <?php echo $_POST['heure']; ?> </div>
						<div class="pacp">Pays ville et CP</div>
						<div class="pays"> <?php echo $_POST['pays']; ?> </div>
						<div class="ville"> <?php echo $_POST['ville']; ?> </div>
						<div class="cp"> <?php echo $_POST['cp']; ?> </div>					
						<div class="saad">Salle et adresse</div>
						<div class="salle"> <?php echo $_POST['salle']; ?> </div>
						<div class="adresse"> <?php echo $_POST['adresse']; ?> </div>
					</div>
				</div>
				<?php
			}
		?>
	</body>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>

