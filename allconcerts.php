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
			$str = "SELECT * FROM `concert`, `artiste`, `salle` WHERE concert.Nom_artiste = artiste.Nom_artiste AND concert.Nom_salle = salle.Nom_salle";
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
							<div class="artiste"> <?php echo $row['Nom_artiste'] ?> </div> 
								<div class="dahe">Date et heure</div>
							<div class="date"> <?php echo  $row['datec'] ?> </div>  
							<div class="heure"> <?php echo $row['heure'] ?> </div>  
								<div class="pacp">Pays ville et CP</div>
							<div class="pays"> <?php echo  $row['Pays'] ?> </div> 
							<div class="ville"> <?php echo $row['Ville'] ?> </div> 
							<div class="cp"> <?php echo  $row['CP'] ?> </div>
								<div class="saad">Salle et adresse</div> 
							<div class="salle"> <?php echo  $row['Nom_salle'] ?> </div> 
							<div class="adresse"> <?php echo $row['adresse'] ?> </div> 
							<?php
							if (isset($_SESSION['pseudo']) != null)
							{
								?> 
								<form method="post" class="modif">
								<input class="modifier" type="submit" value="Modifier une entrée "> 
								<input type="text" name="artiste" placeholder="Saisir l'artiste"   id="artiste" required>
								<?php
		 					}
		 					?>
						</div>
						<?php
					}
					
				?>
						
			</div>
	</body>
	<?php include('footer.html'); ?>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>


