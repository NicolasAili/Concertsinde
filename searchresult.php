<!DOCTYPE html>
<html>
	<head>
		<title>Recap</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/concert.css" media="screen" />		
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
			$searchfield = $_POST['searchfield'];
			$str = "SELECT Nom_artiste FROM artiste WHERE Nom_artiste = '$searchfield'";
			$result = mysqli_query($con, $str);
			?>
				<h1> Resultat de recherche pour "<?php echo $searchfield; ?>" </h1> 
				<h2> Artiste </h2>
				<?php
					if($row = mysqli_fetch_array($result))
						{ ?>
							<div class="artiste">  <?php
							echo '<a href="artiste/' . $row['Nom_artiste'] . '.php">' . $row['Nom_artiste'];
							echo '</a>';
							?>
							</div>
							<?php
						} 
						else
						{
							echo("pas de resultat");
						}	
						
			$str = "SELECT Nom_salle, Ville, CP FROM salle WHERE Nom_salle = '$searchfield'";
			$result = mysqli_query($con, $str);	
			?>
				<hr/>
				<h2> Salle </h2>
			<?php
					if($row = mysqli_fetch_array($result))
						{ ?>
							<div class="salle"> <?php echo $row['Nom_salle'] . " (" . $row['Ville'] . " " . $row['CP'] . ")";  ?> </div> <?php
						} 
						else
						{
							echo("pas de resultat");
						}	
						
			$str = "SELECT Ville, CP FROM salle WHERE Ville = '$searchfield'";
			$result = mysqli_query($con, $str);	
			?>
				<hr/>
				<h2> Ville </h2>
				<?php
					if($row = mysqli_fetch_array($result))
						{ ?>
							<div class="Ville"> <?php echo $row['Ville'] . " (" . $row['CP'] . ")"; ?> </div> <?php
						} 
						else
						{
							echo("pas de resultat");
						}	
						
			$str = "SELECT CP, Ville FROM salle WHERE CP = '$searchfield'";
			$result = mysqli_query($con, $str);	
			?>
				<hr/>
				<h2> CP </h2>
				<?php
					if($row = mysqli_fetch_array($result))
						{ ?>
							<div class="CP"> <?php echo $row['CP'] . " (" . $row['Ville'] . ")";  ?> </div> <?php
						} 
						else
						{
							echo("pas de resultat");
						}	
			?>
	</body>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>

