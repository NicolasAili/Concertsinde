<?php
/*
	Type fichier : php
	Fonction : afficher les résultats d'une recherche
	Emplacement : /
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui
*/
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 

			require('php/database.php');
			session_start();
		?>
		<script src="js/scrollnav.js"></script> 
		<link rel="stylesheet" type="text/css" href="css/body/searchresult.css">
	</head>
	<body>
		<header>
			<?php include('contenu/header.php'); ?> <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		</header>
		<div id="main">
			<?php	      
			require('php/database.php');

			$searchfield = $_POST['searchfield'];
			$verif = 0;


			$str = "SELECT Nom_artiste FROM artiste WHERE Nom_artiste = '$searchfield'";
			$result = mysqli_query($con, $str);
			?>
				<h1> Resultat de recherche pour "<?php echo $searchfield; ?>" </h1> 
				<?php
					if($row = mysqli_fetch_array($result))
						{ ?>
							<h2> Artiste </h2>
							<div class="artiste">  <?php
							$verif = 1;
							echo '<a href="supartiste.php?artiste=' . $row['Nom_artiste'] . '">' . $row['Nom_artiste'];
							echo '</a>';
							?>
							</div>
							<?php
						} 
						
			$str = "SELECT Nom_salle, nom_ville, ville_code_postal FROM salle, ville WHERE Nom_salle = '$searchfield' AND salle.id_ville = ville.ville_id";
			$result = mysqli_query($con, $str);	
			?>
			<?php
					if($row = mysqli_fetch_array($result))
						{ ?>
							<hr/>
							<h2> Salle </h2>
							<div class="salle"> 
								<?php 
								$verif = 1;
								echo '<a href="allconcerts.php?salle=' . $row['Nom_salle'] . '">' . $row['Nom_salle'] . " (" . $row['nom_ville'] . $row['ville_code_postal'] . ")";
								echo '</a>';  
							?> 
							</div> 
							<?php
						} 						
						
			$str = "SELECT nom_ville, ville_code_postal FROM ville WHERE nom_ville = '$searchfield'";
			$result = mysqli_query($con, $str);	
			?>
				<?php
					if($row = mysqli_fetch_array($result))
						{ ?>
							<hr/>
							<h2> Ville </h2>
							<div class="Ville"> 
								<?php 
								$verif = 1;
								echo '<a href="allconcerts.php?ville=' . $row['nom_ville'] . '">' . $row['nom_ville'] . " (" . $row['ville_code_postal'] . ")"; 
								echo '</a>';
								?> 
							</div> 
							<?php
						} 
						
			$str = "SELECT ville_code_postal, nom_ville FROM ville WHERE ville_code_postal = '$searchfield'";
			$result = mysqli_query($con, $str);	
			?>
				<?php
					if($row = mysqli_fetch_array($result))
						{ ?>
							<hr/>
							<h2> CP </h2>
							<div class="CP"> 
								<?php 
								$verif = 1;
								echo  '<a href="allconcerts.php?cp=' . $row['ville_code_postal'] . '">' . $row['ville_code_postal'] . " (" . $row['nom_ville'] . ")";  
								echo '</a>';
								?> 
							</div> 
							<?php
						}

			$str = "SELECT nom_departement, numero FROM departement WHERE nom_departement = '$searchfield'";
			$result = mysqli_query($con, $str);	
			if($row = mysqli_fetch_array($result))
						{ ?>
							<hr/>
							<h2> Departement </h2>
							<div class="departement"> 
								<?php 
								$verif = 1;
								echo  '<a href="allconcerts.php?departement=' . $row['nom_departement'] . '">' . $row['nom_departement'] . " (" . $row['numero'] . ")";  
								echo '</a>';
								?> 
							</div> 
							<?php
						}

			$str = "SELECT nom_departement, numero FROM departement WHERE numero = '$searchfield'";
			$result = mysqli_query($con, $str);	
			if($row = mysqli_fetch_array($result))
						{ ?>
							<hr/>
							<h2> Numero département </h2>
							<div class="numero"> 
								<?php 
								$verif = 1;
								echo  '<a href="allconcerts.php?departement=' . $row['nom_departement'] . '">' . $row['numero'] . " (" . $row['nom_departement'] . ")";  
								echo '</a>';
								?> 
							</div> 
							<?php
						}

			$str = "SELECT nom_region FROM region WHERE nom_region = '$searchfield'";
			$result = mysqli_query($con, $str);	
			if($row = mysqli_fetch_array($result))
						{ ?>
							<hr/>
							<h2> Region </h2>
							<div class="region"> 
								<?php 
								$verif = 1;
								echo  '<a href="allconcerts.php?region=' . $row['nom_region'] . '">' . $row['nom_region'];  
								echo '</a>';
								?> 
							</div> 
							<?php
						}

			if($verif == 0)
			{
				echo "Aucun résultat pour votre recherche";
			}

			?>
		</div>
		<?php include('contenu/footer.html'); ?>
	</body>	
</html>

