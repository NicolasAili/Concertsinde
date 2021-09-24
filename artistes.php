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
?>
 

<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'php/js.php'; 
			require('php/database.php');
		?>
		<script src="js/scrollnav.js"></script> 
		<link rel="stylesheet" type="text/css" href="css/body/artistes.css">
	</head>
	
	<body>
		<header>
		<?php include('contenu/header.php'); ?> <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		</header>
		<div id="main">
			<h1> Artistes </h1>

			<?php
				require('php/database.php');
				echo "</br>";
				echo "</br>";
				echo "</br>";
				echo "</br>";
				echo "</br>";
				echo "</br>";
				echo "</br>";
				echo "</br>";
				echo "</br>";

				$page = $_POST['page'];
				$sqlquery = $_POST['sqlquery'];
				$i = 0; //compteur pour les pages
				if(!$page)
				{
					$page = 1;
				}
			?>
			<div id = "ajoutartiste" style="position: fixed; top: 50%; left: 75%;">
					Ajouter un artiste
					<form method="post" class="connect" action="action/addartiste.php">
						<input type="text" name="artisteajout" id="artisteajout" placeholder="Nom artiste">
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
					<input type="text" name="artiste" id="artiste" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="Cherchez un artiste"  >
					<input type="submit" value="Valider" id="valider" name="valider" href="">
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
							<?php
								echo $i;
							?>
							<div class="artiste">
								<?php 
									$artistecnt = $row['Nom_artiste'];
									echo '<img src="image/artiste/' . $row['Nom_artiste'] . '.jpg' . '" class="imgcadenas">';
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
				}
				if($artiste)
				{
					echo '<a href="artistes.php">'; ?> afficher tous les artistes <?php echo '</a>';
				}
				else
				{?>
					<form method="post" action="artistes.php" class="page" style="display: flex;">
 					<input id="un" type="submit" name="page" value="<?php if($page == 1){echo '1';}else{echo $page-1;}?>"<?php if($page == 1){echo 'style="font-weight: bold;"';;} ?>>
 					<?php if($i>14)
 					{
 						?>
 						<input id="deux" type="submit" name="page" value="<?php if($page == 1){echo '2';}else{echo $page;} ?>"<?php if($page>1){echo 'style="font-weight: bold;"';;} ?>>
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
			</div>
			<?php require "action/messages.php"; ?> 
		</div>
		<?php include('contenu/footer.html'); ?>
	</body>
</html>
