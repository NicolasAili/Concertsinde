<?php
/*
	Type fichier : php
	Fonction : afficher les artistes
	Emplacement : /
	Connexion à la BDD : oui
	Contenu HTML : oui 
	JS+JQuery : oui
	CSS : oui
*/
/* *******************CHECKING********************
V1 : oui
Support(s) : pc perso et ecran perso
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

			$artiste = $_POST['artiste'];
			if(isset($artiste))
			{
				require ('php/inject.php'); //0) ajouter inject et définir redirect
				$redirect = 'artistes.php';

				$values = array($artiste); //1) mettre données dans un arrray
				$inject = inject($values, null); //2) les vérifier
				$validate = validate($inject, $redirect); //3)validation de tous les champs
				if($validate == 0) //4) si pas d'injection : ajout des variables
				{
				  $artiste = mysqli_real_escape_string($con, $artiste); 
				}
			}	
		?>
		 
		<link rel="stylesheet" type="text/css" href="css/body/artistes.css">
	</head>
	<body>
		<header>
			<?php include('contenu/header.php'); ?>
			<script src="js/scrollnav.js"></script> 
		</header>
		<?php include 'contenu/reseaux.php'; ?>
		<div id="main">
			<h2> Liste des artistes </h2>
			<?php

				$page = $_POST['page'];
				$sqlquery = $_POST['sqlquery'];
				$i = 0; //compteur pour les pages
				if(!$page)
				{
					$page = 1;
				}
				$count = 0;
			?>
			<div id = "ajoutartiste">
					<h3> Ajouter un artiste </h3>
					<form method="post" class="connect" action="action/addartist.php">
						<input type="text" name="artisteajout" id="artisteajout" placeholder="Nom artiste">
						<textarea name="description" id="description" placeholder="Ajoutez une description (facultatif)"></textarea> 
						<input type="submit" value="Ajouter" id="validajout" name="validajout" href="">
					</form>
			</div>
			<h3 onclick="displayfilter();">Filtres ▼</h3>
			<div id=tri>
				<?php
				$filter = $_GET['filter'];
				?>
				<div id="tripar"><?php
					echo "<h4> Trier par </h4>";
					echo '<a href="artistes.php?filter=up">'; ?> ordre croissant <?php echo '</a>';
					echo "<br>";
					echo '<a href="artistes.php?filter=down">'; ?> ordre décroissant <?php echo '</a>';
				?>
				</div>
				<div id="filtrepar">
					<h4> Filtrer </h4>
					<form method="post" class="connect" action="artistes.php">
						<input type="text" name="artiste" id="artiste" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="Cherchez un artiste"  >
						<input type="submit" value="Valider" id="valider" name="valider" href="">
					</form>
				</div>
			</div>
			<?php
				
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
				else if ($sqlquery) 
				{
					$str = $sqlquery;
				}
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
					if($i >= $page*15-15 && $i<$page*15) 
					{
					?>
						<div class = "inwhile">
							<div class="artiste">
								<?php 
									$artistecnt = $row['Nom_artiste'];
									$filename = 'image/artiste/' . $artistecnt . '.jpg';
									if (file_exists($filename)) 
									{
					    				echo '<img alt="artiste" src="image/artiste/' . $row['Nom_artiste'] . '.jpg' . '" class="imgartiste">';
									} 
									else 
									{
					    				echo '<img alt="artiste_pas_dimage" src="image/artiste/inconnu.png" class="imgartiste">';
									}
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
					$i++;
					$count++;
				}
				if(!$artiste)
				{?>
					<form method="post" action="artistes.php" class="page" style="display: flex;">
 					<input id="un" type="submit" name="page" value="<?php if($page == 1){echo '1';}else{echo $page-1;}?>"<?php if($page == 1){echo ' style="font-weight: bold;"';;} ?>>
 					<?php if($i>14)
 					{
 						?>
 						<input id="deux" type="submit" name="page" value="<?php if($page == 1){echo '2';}else{echo $page;} ?>"<?php if($page>1){echo ' style="font-weight: bold;"';;} ?>>
 						<?php
 					}
 					if($i>29)
 					{
 						if($page == 1 && $i > 29)
 						{?>
 							<input id="trois" type="submit" name="page" value="3"> <?php
 						}
 						else if($i >= $page*15 && $page > 1)
 						{?>
 							<input id="trois" type="submit" name="page" value="<?php echo($page+1); ?>"> <?php
 						}
 					}?>
 					<input type="hidden" id="sqlquery" name="sqlquery" <?php echo 'value="' . $str . '"' ?> >
 					</form><?php
				}
				?>	
			</div><?php
			if($artiste)
			{
				if ($count<1) 
				{
					echo "Pas de résultat";
					echo "<br>";
					echo "<br>";
				}
				echo '<a href="artistes.php" id="displayartistes">'; ?> Revenir à tous les artistes <?php echo '</a>';
			}?>
			<?php require "action/messages.php"; ?> 
		</div>
		<?php include('contenu/scrolltop.html'); ?>
		<?php include('contenu/footer.html'); ?>
		<script>
			function displayfilter()
			{
				$("#tri").slideToggle( "slow", function()
				{
					if($("#tri").css("display") != "none")
					{
						$("#tri").css('display', 'flex');
					}
					$("h3").css('margin-bottom', '10');
				});
			}
		</script>
	</body>
</html>