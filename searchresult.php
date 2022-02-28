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
			include 'php/error.php';
			require 'php/connectcookie.php';
			include 'php/base.php';
			include 'php/css.php';
			include 'php/js.php';
			require 'php/database.php';
			include 'contenu/reseaux.php';

			require ('php/inject.php');
			$redirect = 'allconcerts.php';

			$searchfield = $_POST['searchfield'];
			if (strlen($searchfield) < 3) {
				 setcookie('contentMessage', 'Erreur: la recherche doit comporter au moins 3 caractères', time() + 15, "/");
		    		header("Location: $redirect");
		    		exit("Erreur: la recherche doit comporter au moins 3 caractères");
			}

			$values = array($searchfield);

			$inject = inject($values, null);
			//array_push($inject, inject($test, $regextest));

			
			$validate = validate($inject, $redirect);
			if($validate == 0)
			{
				$searchfield = mysqli_real_escape_string($con, $searchfield);
			}

			session_start();

		?>
		<link rel="stylesheet" type="text/css" href="css/body/searchresult.css">
	</head>
	<body>
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<div id="main">
			<?php	      		
			
			
			$verif = 0;

			$length = strlen($searchfield); //taille de la chaîne
			$modulo = $length % 2;

			if($modulo == 1) //string de taille impaire
			{
				$array = str_split($searchfield, ($length/2)+0.5); //met la chaine dans un tableau
			}
			else
			{
				$array = str_split($searchfield, $length/2);
			}	

			$str = "SELECT Nom_artiste FROM artiste WHERE Nom_artiste = '$searchfield'";
			$result = mysqli_query($con, $str);
			/*$row = mysqli_fetch_array($result);
			echo $row['pseudo'];*/
			?>
				<h1> Resultat de recherche pour "<?php echo $searchfield; ?>" </h1> 
				<?php
				if($row = mysqli_fetch_array($result))
				{ ?>
					<h2> Artiste </h2>
					<div class="result">  <?php
					$verif = 1;
					echo '<a href="supartiste.php?artiste=' . $row['Nom_artiste'] . '">' . $row['Nom_artiste'];
					echo '</a>';
					?>
					</div>
					<?php
				}
				else
				{
					$str = "SELECT DISTINCT Nom_artiste FROM artiste WHERE Nom_artiste LIKE '%{$array[0]}%' OR Nom_artiste LIKE '%{$array[1]}%' OR Nom_artiste LIKE '%{$searchfield}%'";
					$result = mysqli_query($con, $str);
					if ($row = mysqli_fetch_array($result)) 
					{?>
						<h2> Artiste(s) </h2>
						<div class="result"> <?php 
							$verif = 1;
							echo '<a href="supartiste.php?artiste=' . $row['Nom_artiste'] . '">' . $row['Nom_artiste'];
							echo '</a>';?>
						</div><?php
					}
					while($row = mysqli_fetch_array($result))
					{?>
						<div class="result"> <?php 
							echo '<a href="supartiste.php?artiste=' . $row['Nom_artiste'] . '">' . $row['Nom_artiste'];
							echo '</a>';?>
						</div><?php
					}
				} 
						
			$str = "SELECT Nom_salle, nom_ville, ville_code_postal FROM salle, ville WHERE Nom_salle = '$searchfield' AND salle.id_ville = ville.ville_id";
			$result = mysqli_query($con, $str);	
			if($row = mysqli_fetch_array($result))
			{ ?>
				<h2> Salle </h2>
				<div class="result"> 
					<?php 
					$verif = 1;
					echo '<a href="allconcerts.php?salle=' . $row['Nom_salle'] . '">' . $row['Nom_salle'] . " (" . $row['nom_ville'] . $row['ville_code_postal'] . ")";
					echo '</a>';?> 
				</div> 
				<?php
			}
			else
			{
				$str = "SELECT DISTINCT Nom_salle, nom_ville, ville_code_postal FROM salle, ville WHERE (Nom_salle LIKE '%{$array[0]}%' OR Nom_salle LIKE '%{$array[1]}%' OR Nom_salle LIKE '%{$searchfield}%') AND salle.id_ville = ville.ville_id";
				$result = mysqli_query($con, $str);
				if($row = mysqli_fetch_array($result))
				{ ?>
					<h2> Salle(s) </h2>
					<div class="result"> 
						<?php 
						$verif = 1;
						echo '<a href="allconcerts.php?salle=' . $row['Nom_salle'] . '">' . $row['Nom_salle'] . " (" . $row['nom_ville'] . $row['ville_code_postal'] . ")";
						echo '</a>';?> 
					</div> 
					<?php
				}
				while($row = mysqli_fetch_array($result))
				{?>
					<div class="result"> <?php
						echo '<a href="allconcerts.php?salle=' . $row['Nom_salle'] . '">' . $row['Nom_salle'] . " (" . $row['nom_ville'] . $row['ville_code_postal'] . ")";
						echo '</a>';?>
					</div> <?php
				}
			} 						
						
			$str = "SELECT nom_ville, ville_code_postal FROM ville WHERE nom_ville = '$searchfield'";
			$result = mysqli_query($con, $str);	
			if($row = mysqli_fetch_array($result))
			{ ?>
				<h2> Ville </h2>
				<div class="result"> 
					<?php 
					$verif = 1;
					echo '<a href="allconcerts.php?ville=' . $row['nom_ville'] . '">' . $row['nom_ville'] . " (" . $row['ville_code_postal'] . ")"; 
					echo '</a>';
					?> 
				</div> 
				<?php
			}
			else
			{
				$str = "SELECT DISTINCT nom_ville, ville_code_postal FROM ville WHERE nom_ville LIKE '{$array[0]}%' OR nom_ville LIKE '%{$array[1]}' OR nom_ville LIKE '%{$searchfield}%'";
				$result = mysqli_query($con, $str);
				if($row = mysqli_fetch_array($result))
				{ ?>
					<h2> Ville(s) </h2>
					<div class="result"> 
						<?php 
						$verif = 1;
						echo '<a href="allconcerts.php?ville=' . $row['nom_ville'] . '">' . $row['nom_ville'] . " (" . $row['ville_code_postal'] . ")"; 
						echo '</a>';
						?> 
					</div> 
					<?php
				}
				while($row = mysqli_fetch_array($result))
				{?>
					<div class="result"> 
						<?php 
						echo '<a href="allconcerts.php?ville=' . $row['nom_ville'] . '">' . $row['nom_ville'] . " (" . $row['ville_code_postal'] . ")"; 
						echo '</a>';
						?> 
					</div> 
					<?php
				}
			} 
						
			$str = "SELECT ville_code_postal, nom_ville FROM ville WHERE ville_code_postal = '$searchfield'";
			$result = mysqli_query($con, $str);	
			?>
				<?php
					if($row = mysqli_fetch_array($result))
					{ ?>
						<h2> CP </h2>
						<div class="result"> 
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
				<h2> Departement </h2>
				<div class="result"> 
					<?php 
					$verif = 1;
					echo  '<a href="allconcerts.php?departement=' . $row['nom_departement'] . '">' . $row['nom_departement'] . " (" . $row['numero'] . ")";  
					echo '</a>';
					?> 
				</div> 
				<?php
			}
			else
			{
				$str = "SELECT DISTINCT nom_departement, numero FROM departement WHERE nom_departement LIKE '%{$array[0]}%' OR nom_departement LIKE '%{$array[1]}%' OR nom_departement LIKE '%{$searchfield}%'";
				$result = mysqli_query($con, $str);
				if($row = mysqli_fetch_array($result))
				{ ?>
					<h2> Departement(s) </h2>
					<div class="result"> 
						<?php 
						$verif = 1;
						echo  '<a href="allconcerts.php?departement=' . $row['nom_departement'] . '">' . $row['nom_departement'] . " (" . $row['numero'] . ")";
						echo '</a>';
						?> 
					</div> 
					<?php
				}
				while($row = mysqli_fetch_array($result))
				{?>
					<div class="result"> 
						<?php 
						echo  '<a href="allconcerts.php?departement=' . $row['nom_departement'] . '">' . $row['nom_departement'] . " (" . $row['numero'] . ")"; 
						echo '</a>';
						?> 
					</div> 
					<?php
				}
			}

			$str = "SELECT nom_departement, numero FROM departement WHERE numero = '$searchfield'";
			$result = mysqli_query($con, $str);	
			if($row = mysqli_fetch_array($result))
			{ ?>
				<h2> Numero département </h2>
				<div class="result"> 
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
				<h2> Region </h2>
				<div class="result"> 
					<?php 
					$verif = 1;
					echo  '<a href="allconcerts.php?region=' . $row['nom_region'] . '">' . $row['nom_region'];  
					echo '</a>';
					?> 
				</div> 
				<?php
			}
			else
			{
				$str = "SELECT DISTINCT nom_region FROM region WHERE nom_region LIKE '%{$array[0]}%' OR nom_region LIKE '%{$array[1]}%' OR nom_region LIKE '%{$searchfield}%'";
				$result = mysqli_query($con, $str);
				if($row = mysqli_fetch_array($result))
				{ ?>
					<h2> Region(s) </h2>
					<div class="result"> 
						<?php 
						$verif = 1;
						echo  '<a href="allconcerts.php?region=' . $row['nom_region'] . '">' . $row['nom_region'];  
						echo '</a>';
						?> 
					</div> 
					<?php
				}
				while($row = mysqli_fetch_array($result))
				{?>
					<div class="result"> 
						<?php 
						echo  '<a href="allconcerts.php?region=' . $row['nom_region'] . '">' . $row['nom_region'];  
						echo '</a>';
						?> 
					</div> 
					<?php
				}
			}

			if($verif == 0)
			{
				echo "Aucun résultat pour votre recherche";
			}

			?>
		</div>
		<?php include('contenu/scrolltop.html'); ?>
		<?php include('contenu/footer.html'); ?>
	</body>	
</html>

