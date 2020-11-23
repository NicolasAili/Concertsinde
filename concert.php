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
		<?php //include('header.php'); ?>
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
				echo "<script>alert(\" bitetest\")</script>";
				$testartiste = mysqli_query($con, "SELECT Nom_artiste FROM artiste WHERE Nom_artiste = $artiste");
				//$insertartiste = "INSERT INTO artiste VALUES ('$artiste')";
				//mysqli_query($con, $insertartiste);
				$row_cnt = mysqli_num_rows($testartiste);
				if($row_cnt>0)
				{
					echo "<script>alert(\" correspondance trouvee\")</script>";
				 
				}
				else
				{
					echo "<script>alert(\"pas de correspondance trouveee\")</script>";
				}
				/* Ferme le jeu de résultats */
				mysqli_free_result($testartiste);
				//echo "<script>alert(\"pas de correspondance trouveee\")</script>";
			}

				//else
				//{
				//	echo "<script>alert(\" correspondance trouvee\")</script>";
				//}
				$testsalle = "SELECT Nom_salle FROM salle WHERE Nom_salle = $salle";
				if ($salle==0)
				{
					//$insertsalle = "INSERT INTO salle (Nom_salle) VALUES ('$salle)";
					//mysqli_query($con, $insertsalle);
				}
				//$sql = "INSERT INTO concert (datec, heure, Nom_artiste, Nom_salle, ID_user, Date_ajout) VALUES ('$date', '$heure', $artiste, '$salle', '$artiste', , NOW())";
				//mysqli_query($con, $sql);
				?>
				<div id="recap">
					<div class="inwhile">
						<h1> Récapitulatif : </h1>
						<div class="artiste"> <?php //echo $_POST['artiste']; ?> </div>
						<div class="dahe">Date et heure</div>
						<div class="date"> <?php //echo $_POST['date']; ?> </div>
						<div class="heure"> <?php //echo $_POST['heure']; ?> </div>
						<div class="pacp">Pays ville et CP</div>
						<div class="pays"> <?php //echo $_POST['pays']; ?> </div>
						<div class="ville"> <?php //echo $_POST['ville']; ?> </div>
						<div class="cp"> <?php //echo $_POST['cp']; ?> </div>					
						<div class="saad">Salle et adresse</div>
						<div class="salle"> <?php //echo $_POST['salle']; ?> </div>
						<div class="adresse"> <?php //echo $_POST['adresse']; ?> </div>
					</div>
				</div>-->
				<?php
			
		?>
	</body>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>

