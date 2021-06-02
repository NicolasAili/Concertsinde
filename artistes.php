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
	</head>
	<header>
		<?php include('header.php'); ?>
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
			$cnt = 0;
			$str = "SELECT * FROM artiste ORDER BY Nom_artiste";
			$result = mysqli_query($con, $str);
		?>
			<div id="lesartistes">
				<?php
				while($row = mysqli_fetch_array($result)) 
				{
				?>
					<div class = "inwhile">
						<?php
							echo $cnt;
							$cnt++;
						?>
						<div class="artiste">
							<?php 
								$artistecnt = $row['Nom_artiste'];
								echo '<img src="./image/artiste/' . $row['Nom_artiste'] . '.jpg' . '" class="imgcadenas">';
								echo '<a href="supartiste.php?artiste=' . $row['Nom_artiste'] . '">' . $artistecnt;
								echo '</a>';
							?>
						</div>
						<div class="nbconcert">
							<?php
								$nbr = "SELECT COUNT(*) FROM concert WHERE Nom_artiste = '$artistecnt'";
								$resultnbr = mysqli_query($con, $nbr);
								$rownbr = mysqli_fetch_array($resultnbr);
								echo $rownbr[0];
								mysqli_free_result($resultnbr);
								if($rownbr[0]>1)
								{
							?>
								concerts à venir
							<?php
								}
								else 
								{
							?>	
								concert à venir
							<?php		
								}
							?>
						</div>
					</div>
				<?php
				}
				?>	
			</div>
	</body>
	<?php include('footer.html'); ?>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>