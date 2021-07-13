<?php
    session_start();
    ini_set('display_errors', 0);
	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
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
		<script type="text/javascript" src="./jquery/jquery.min.js"></script>
		<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="./jquery/jquery-ui.css" media="screen" />		
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
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
		?>
		<div id = "ajoutartiste" style="position: fixed; top: 50%; left: 75%;">
				Ajouter un artiste
				<form method="post" class="connect" action="addartist.php">
					<input type="text" name="artisteajout" id="artisteajout" placeholder="Ajoutez un artiste">
					<textarea cols="40" rows="5" name="description" id="description" placeholder="Ajoutez une description (facultatif)"></textarea> 
					<input type="submit" value="Ajouter" id="validajout" name="validajout" href="">
				</form>
		</div>

		<div id=tri>
			<h3>trier par...</h3>
			<hr>
			<?php
			$filter = $_GET['filter'];
			echo '<a href="artistes.php?filter=up">'; ?> ordre croissant (de a à z) <?php echo '</a>';
			echo '<a href="artistes.php?filter=down">'; ?> ordre décroissant (de z à a) <?php echo '</a>';
			/*echo '<a href="artistes.php?filter=number">'; ?> nombre de concerts futurs <?php echo '</a>';*/
			?>
			<form method="post" class="connect" action="artistes.php">
				<input type="text" name="artiste" id="artiste" placeholder="Cherchez un artiste"  >
				<input type="submit" value="Chercher un artiste" id="valider" name="valider" href="">
			</form>
		</div>
		<?php
			$artiste = $_POST['artiste'];
			$cnt = 0;
			if($filter == 'up')
			{
				$str = "SELECT * FROM artiste ORDER BY Nom_artiste ASC";
			}
			else if($filter == 'down')
			{
				$str = "SELECT * FROM artiste ORDER BY Nom_artiste DESC";
			}
			else if($artiste)
			{
				$str = "SELECT * FROM artiste WHERE Nom_artiste = '$artiste'";
			}
			/*else if($filter == 'number')
			{

			}*/
			else
			{
				$str = "SELECT * FROM artiste ORDER BY Nom_artiste";
			}
			
			
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
								$nbr = "SELECT COUNT(*) FROM concert WHERE Nom_artiste = '$artistecnt' AND datec > NOW()";
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
				if($artiste)
				{
					echo '<a href="artistes.php">'; ?> afficher tous les artistes <?php echo '</a>';
				}
				?>	
			</div>
			<?php require "./messages.php"; ?> 
	</body>
	<?php include('footer.html'); ?>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>