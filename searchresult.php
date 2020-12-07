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
			$str = "SELECT * FROM artiste WHERE Nom_artiste = '$searchfield'";
			$result = mysqli_query($con, $str);
			$row = mysqli_fetch_array($result); ?>
			<div class="adresse"> <?php echo $row['Nom_artiste'];  ?> </div>
			<?php		echo "success"; 
			
		?>
	</body>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>

