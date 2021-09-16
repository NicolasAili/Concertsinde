<?php
/*
	Type fichier : php
	Fonction : afficher tous les concerts
	Emplacement : /
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui
*/
?>

<?php
    session_start();
    ini_set('display_errors', 0);
	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tous les concerts</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/allconcerts.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />	
		<script type="text/javascript" src="./jquery/jquery.min.js"></script>
		<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="./jquery/jquery-ui.css" media="screen" />		
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
	</head>
	<header>
		<?php include('header.php'); ?>
	</header>
	<body>	
		<?php
		$add = $_GET['add'];
		$modif = $_GET['modif'];
		$filter = $_GET['filter'];
		$getsalle = $_GET['salle'];
		$getville = $_GET['ville'];
		$getcp = $_GET['cp'];
		$getdepartement = $_GET['departement'];
		$getnumdepartement = $_GET['numero'];
		$getregion = $_GET['region'];
		$pseudo = $_SESSION['pseudo'];
		$archive = $_GET['archive'];
		if(!$archive)
		{
			$archive = 'no';
		}


		$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		$testadmin = $row['admin'];

		//$get = $_GET['filtre'];
		$string = $_SERVER['QUERY_STRING'];
			
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			//echo $string;
			//echo "</br>";
			parse_str($string);
			$finalstring = explode("&", $string);
			$filtre = " datec ASC";
			$archivesql = " AND concert.datec >= NOW()";
			//echo $finalstring[0];
			//echo "</br>";
			//echo $finalstring[1];
			//echo "</br>";

		if(!$add && !$modif)
		{
			?>
			filtres...
			 <form action="allconcerts.php" method="get">
			  <label for="salle">Salle:</label>
			  <input type="text" id="salle" name="salle" <?php if($getsalle){echo 'value='; echo "$getsalle";}?> required><br><br>
			  <?php if($filter)
			  {
			  	echo '<input type="hidden" id="filter" name="filter" value="'; echo $filter; echo'">';
			  }
			  else
			  {
			  	echo '<input type="hidden" id="filter" name="filter" value="none">';
			  }
			  ?> 
			  <input type="hidden" id="archive" name="archive" <?php echo 'value='; echo $archive;?>>
			  <input type="submit" value="Filtrer">
			</form> 
			<br>
			<form action="allconcerts.php" method="get">
			  <label for="ville">Ville:</label>
			  <input type="text" id="ville" name="ville" <?php if($getville){echo 'value='; echo "$getville";}?> required><br><br>
			  <?php if($filter)
			  {
			  	echo '<input type="hidden" id="filter" name="filter" value="'; echo $filter; echo'">';
			  }
			  else
			  {
			  	echo '<input type="hidden" id="filter" name="filter" value="none">';
			  }?>
			  <input type="hidden" id="archive" name="archive" <?php echo 'value='; echo $archive;?>>
			  <input type="submit" value="Filtrer">
			</form>
			<br>
			<form action="allconcerts.php" method="get">
			  <label for="cp">CP:</label>
			  <input type="text" id="cp" name="cp" <?php if($getcp){echo 'value='; echo "$getcp";}?> required><br><br>
			  <?php if($filter)
			  {
			  	echo '<input type="hidden" id="filter" name="filter" value="'; echo $filter; echo'">';
			  }
			  else
			  {
			  	echo '<input type="hidden" id="filter" name="filter" value="none">';
			  }?>
			  <input type="hidden" id="archive" name="archive" <?php echo 'value='; echo $archive;?>>
			  <input type="submit" value="Filtrer">
			</form> 
			<br>
			<form action="allconcerts.php" method="get">
			  <label for="departement">Departement:</label>
			  <input type="text" id="departement" name="departement" <?php if($getdepartement){echo 'value='; echo "$getdepartement";}?> required><br><br>
			  <?php if($filter)
			  {
			  	echo '<input type="hidden" id="filter" name="filter" value="'; echo $filter; echo'">';
			  }
			  else
			  {
			  	echo '<input type="hidden" id="filter" name="filter" value="none">';
			  }?>
			  <input type="hidden" id="archive" name="archive" <?php echo 'value='; echo $archive;?>>
			  <input type="submit" value="Filtrer">
			</form> 
			<br>
			<form action="allconcerts.php" method="get">
			  <label for="numero">Numero de département:</label>
			  <input type="text" id="numero" name="numero" <?php if($getnumdepartement){echo 'value='; echo "$getnumdepartement";}?> required><br><br>
			  <?php if($filter)
			  {
			  	echo '<input type="hidden" id="filter" name="filter" value="'; echo $filter; echo'">';
			  }
			  else
			  {
			  	echo '<input type="hidden" id="filter" name="filter" value="none">';
			  }?>
			  <input type="hidden" id="archive" name="archive" <?php echo 'value='; echo $archive;?>>
			  <input type="submit" value="Filtrer">
			</form> 
			<br>
			<form action="allconcerts.php" method="get">
			  <label for="region">Region:</label>
			  <input type="text" id="region" name="region" <?php if($getregion){echo 'value='; echo "$getregion";}?> required><br><br>
			  <?php if($filter)
			  {
			  	echo '<input type="hidden" id="filter" name="filter" value="'; echo $filter; echo'">';
			  }
			  else
			  {
			  	echo '<input type="hidden" id="filter" name="filter" value="none">';
			  }?>
			  <input type="hidden" id="archive" name="archive" <?php echo 'value='; echo $archive;?>>
			  <input type="submit" value="Filtrer">
			</form> 
			<br>
		<?php
		}
		?>

		<input type="checkbox" onclick='window.location.assign(<?php echo '"'; echo 'allconcerts.php?'; 
		if($string)
		{
			echo $finalstring[0]; 
		}
		else
		{
			echo 'recherche=none';
		}
		if($filter)
		{
			echo '&filter=';
			echo $filter;
		}
		else
		{
			echo '&filter=none';
		}
		if($archive == 'yes')
		{
			echo '&archive=no';
		}
		else if($archive == 'no')
		{
			echo '&archive=yes';
		}
		?>
		")'
		<?php
		if($archive == 'yes')
		{
			echo "checked";
		}
		?>
		>
		Afficher les concerts archivés (cochez ou décochez)

		<?php
		if(!$add && !$modif)
		{
			echo "<br>";
			echo "<br>";
			?>
			trier par...
			<?php
			if(!$archive || $archive == 'no')
			{
				$archive = 'archive=no';
			}
			else
			{
				$archive = 'archive=yes';
			}
			echo "<br>";

			if($string && $filter != "artisteup" && $finalstring[0] != "recherche=none")
			{
				echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=artisteup&"; echo $archive; echo '">';
			}
			else /*recherche == none */ 
			{
				echo '<a href="allconcerts.php?recherche=none&filter=artisteup&'; echo $archive; echo '">';
			} 
			if($filter == "artisteup")
			{
				echo "<strong>";
			}
			echo "nom d'artiste croissant (de a à z)"; 
			if($filter == "artisteup")
			{
				echo "</strong>";
			} 
			echo '</a>';

			echo "<br>";

			if($string && $filter != "artistedown" && $finalstring[0] != "recherche=none")
			{
				echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=artistedown&"; echo $archive; echo '">';
			}
			else
			{
				echo '<a href="allconcerts.php?recherche=none&filter=artistedown&'; echo $archive; echo '">';
			} 
			if($filter == "artistedown")
			{
				echo "<strong>";
			}
			echo "nom d'artiste décroissant (de z à a)"; 
			if($filter == "artistedown")
			{
				echo "</strong>";
			} 
			echo '</a>';
			
			echo "<br>";

			if($string && $filter != "dateup" && $finalstring[0] != "recherche=none")
			{
				echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=dateup&"; echo $archive; echo '">';
			}
			else
			{
				echo '<a href="allconcerts.php?recherche=none&filter=dateup&'; echo $archive; echo '">';
			} 
			if($filter == "dateup")
			{
				echo "<strong>";
			}
			echo "Du plus proche au plus éloigné dans le temps (par défaut)"; 
			if($filter == "dateup")
			{
				echo "</strong>";
			} 
			echo '</a>';

			echo "<br>";

			if($string && $filter != "datedown" && $finalstring[0] != "recherche=none")
			{
				echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=datedown&"; echo $archive; echo '">';
			}
			else
			{
				echo '<a href="allconcerts.php?recherche=none&filter=datedown&'; echo $archive; echo '">';
			} 
			if($filter == "datedown")
			{
				echo "<strong>";
			}
			echo "Du plus éloigné au plus proche dans le temps"; 
			if($filter == "datedown")
			{
				echo "</strong>";
			} 
			echo '</a>';

			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo '<a href="allconcerts.php?filter=reset">'; echo "Réinitialiser les filtres"; echo '</a>';
		}

		switch($filter)
		{
			case "artisteup":
				$filtre = " nom_artiste ASC";
				break;
			case "artistedown":
				$filtre = " nom_artiste DESC";
				break;
			case "dateup":
				$filtre = " datec ASC";
				break;
			case "datedown":
				$filtre = " datec DESC";
				break;
		}

		switch ($_GET['archive']) 
		{
			case 'yes':
				$archivesql = "";
				break;
			
			case 'no':
				$archivesql = " AND concert.datec >= NOW()";
				break;
			default:
				$archivesql = " AND concert.datec >= NOW()";
				break;
		}
		?>



		<hr>
		<h1>Tous les concerts</h1>
		<img src="image/valide.png" height="50" width="50"> = Concert validé (non modifiable)
		<br>
		<img src="image/invalide.png" height="50" width="50"> = Concert non validé (modifiable)
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
			$admin = 'administateur';
			//echo $_SESSION['pseudo'];
			//echo $admin;
			if($getsalle)
			{
				$str = sprintf("SELECT id_concert FROM concert, salle WHERE salle.id_salle = concert.fksalle AND nom_salle = '$getsalle'". $archivesql ." ORDER BY". $filtre ."");

			}
			else if ($getville) {
				$str = sprintf("SELECT id_concert FROM concert, ville, salle WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.nom_ville = '$getville'. $archivesql .ORDER BY". $filtre ."");
			}
			else if ($getcp) {
				$str = sprintf("SELECT id_concert FROM concert, ville, salle WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.ville_code_postal = '$getcp'. $archivesql .ORDER BY". $filtre ."");
			}
			else if ($getdepartement) {
				$str = sprintf("SELECT id_concert FROM concert, ville, salle, departement WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.ville_departement = departement.numero AND departement.nom_departement = '$getdepartement'. $archivesql .ORDER BY". $filtre ."");
			}
			else if ($getnumdepartement) {
				$str = sprintf("SELECT id_concert FROM concert, ville, salle, departement WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.ville_departement = departement.numero AND departement.numero = '$getnumdepartement'. $archivesql .ORDER BY". $filtre ."");
			}
			else if ($getregion) {
				$str = sprintf("SELECT id_concert FROM concert, ville, salle, departement, region WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.ville_departement = departement.numero AND departement.id_region = region.id AND region.nom_region = '$getregion'. $archivesql .ORDER BY". $filtre ."");
			}
			else if ($add)
			{
				$str = sprintf("SELECT id_concert FROM concert WHERE user_ajout = '$add'". $archivesql ."");
			}
			else if ($modif)
			{
				$str = sprintf("SELECT DISTINCT id_concert FROM modification WHERE id_user = '$modif'". $archivesql ."");
			}
			else
			{
				$str = sprintf("SELECT id_concert FROM concert WHERE 1". $archivesql ." ORDER BY". $filtre ."");
			}
			
			$result = mysqli_query($con, $str);
			?>
			<div id="concertsall">
				<?php
				echo $str;
				while($rowx = mysqli_fetch_array($result)) 
				{
					$idconcert = $rowx['id_concert'];
					$row['ville_departement'] = NULL;
					$rowdpt['id_region'] = NULL;
					$rowdpt['nom_departement'] = NULL;
					$rowrgn['nom_pays'] = NULL;
					$rowrgn['nom_region'] = NULL;
					$str = "SELECT datec, heure, lien_fb, date_ajout, lien_ticket, concert.nom_artiste, user_ajout, user_modif, valide, id_salle, adresse, nom_salle, nom_ext, intext, nom_ville, ville_code_postal, ville_departement FROM concert, artiste, salle, ville WHERE concert.nom_artiste = artiste.Nom_artiste AND concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND id_concert = $idconcert ";
					$resultx = mysqli_query($con, $str);
					$row = mysqli_fetch_array($resultx);

					$pseudoadd = $row['user_ajout'];
					$pseudomodif= $row['user_modif'];

					$str = "SELECT pseudo FROM utilisateur, concert WHERE user_ajout = '$pseudoadd' AND concert.user_ajout = utilisateur.id_user";
					$resultx = mysqli_query($con, $str);
					$rowadd = mysqli_fetch_array($resultx);

					$str = "SELECT pseudo FROM utilisateur, concert WHERE user_modif = '$pseudomodif' AND concert.user_ajout = utilisateur.id_user";
					$resultx = mysqli_query($con, $str);
					$rowmodif = mysqli_fetch_array($resultx);

					if($row['ville_departement'])
					{
						$filter = 1;
						$str = "SELECT nom_departement, id_region FROM departement, ville, salle, concert WHERE concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND ville_departement = departement.numero AND id_concert = $idconcert ";
						$resultdpt = mysqli_query($con, $str);
						$rowdpt = mysqli_fetch_array($resultdpt);
						if($rowdpt['id_region'])
						{
							$str = "SELECT nom_region, nom_pays FROM pays, region, departement, ville, salle, concert WHERE concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND ville_departement = numero AND departement.id_region = region.id AND region.id_pays = pays.id AND id_concert = $idconcert ";
							$resultrgn = mysqli_query($con, $str);
							$rowrgn = mysqli_fetch_array($resultrgn);
						}
					}
					/*else
					{
						$filter = 0;
					}*/
				?> 

					<div class="inwhile"> 
						<div class="artiste"> 
							<?php echo '<a href="supartiste.php?artiste=' . $row['nom_artiste'] . '">'; echo $row['nom_artiste']; echo '</a>'; 
							if($row['valide'] == 0)
							{?>
								<img src="image/invalide.png" height="50" width="50">
							<?php
							}
							else
							{?>
								<img src="image/valide.png" height="50" width="50">
							<?php
							}?> 
						</div> 
							<div class="dahe">Date et heure</div>
						<div class="date"> <?php echo  $row['datec'] ?> </div>  
						<div class="heure"> <?php echo $row['heure'] ?> </div>  
							<div class="pacp">Pays, region, departement</div>
						<?php
						if($rowdpt['id_region'])
						{
							?>
							<div class="pays"> <?php echo  $rowrgn['nom_pays'] ?> </div>
							<div class="region"> <?php echo  $rowrgn['nom_region'] ?> </div> 
							<?php 
						}
						else
						{
							?>
							<div class="pays"> Pays non renseigné </div>
							<div class="region"> Région non renseignée </div> 
							<?php
						}
						if($row['ville_departement'])
						{
							?>
							<div class="departement"> <?php echo  $rowdpt['nom_departement'] ?> </div> 
							<?php
						}
						else
						{	
							?>
							<div class="departement"> Département non renseigné </div> 
							<?php
						}
							?>
							<div class="villexcp"> Ville et CP </div>
						<div class="ville"> <?php echo $row['nom_ville'] ?> </div> 
						<?php
						if($row['ville_code_postal'])
						{
							?>
							<div class="cp"> <?php echo  $row['ville_code_postal'] ?> </div>
							<?php
						}
						else
						{
							?>
								<div class="cp"> Code postal non renseigné </div>
							<?php
						}
						if($row['intext'] == 'int')
						{
						?>
							<div class="saad">Lieu, adresse et salle</div> 
							<br>
							Concert intérieur
							<br>
						<div class="salle"> <?php echo  $row['nom_salle'] ?> </div> 
						<?php
						} 
						else
						{
						?>
							<div class="saad">Lieu, adresse et salle</div> 
							<br>
							Concert extérieur
							<br>
						<div class="salle"> <?php echo  $row['nom_ext'] ?> </div>
						<?php	
						}
						?>
						<div class="adresse"> <?php echo $row['adresse'] ?> </div> 
						<div class="saad">Liens relatifs a l'evenement</div>
						<div class="fb"> <?php echo  $row['lien_fb'] ?> </div> 
						<div class="ticket"> <?php echo  $row['lien_ticket'] ?> </div> 
						<div class="saad">Autres infos</div>
						<div class="dateajout"> Concert ajouté le: <?php echo  $row['date_ajout'] ?> </div> 
						<div class="ajout"> <?php if($rowadd['pseudo']){ echo "Par : "; echo  $rowadd['pseudo'];} else{echo "Par : un anonyme";} ?> </div>
						<div class="modif"><?php if($rowmodif['pseudo']){ echo "Dernière modification par : "; echo  $rowmodif['pseudo'];} else{echo "Concert non modifié";} ?> </div>
						<form method="post" action="modifconcert.php" class="modif">
							<input type="hidden" id="idpost" name="idpost" <?php echo 'value="' . $idconcert . '"' ?> > 
							<input type="hidden" id="idsallepost" name="idsallepost" <?php echo 'value="' . $row['id_salle'] . '"' ?> > 
							<input type="hidden" id="artistepost" name="artistepost" <?php echo 'value="' . $row['nom_artiste'] . '"' ?> > 
							<input type="hidden" id="datepost" name="datepost" <?php echo 'value="' . $row['datec'] . '"' ?> > 
							<input type="hidden" id="heurepost" name="heurepost" <?php echo 'value="' . $row['heure'] . '"' ?> > 
							<input type="hidden" id="payspost" name="payspost" <?php echo 'value="' . $rowrgn['nom_pays'] . '"' ?> > 
							<input type="hidden" id="regionpost" name="regionpost" <?php echo 'value="' . $rowrgn['nom_region'] . '"' ?> > 
							<input type="hidden" id="departementpost" name="departementpost" <?php echo 'value="' . $rowdpt['nom_departement'] . '"' ?> > 
							<input type="hidden" id="villepost" name="villepost" <?php echo 'value="' . $row['nom_ville'] . '"' ?> > 
							<input type="hidden" id="cppost" name="cppost" <?php echo 'value="' . $row['ville_code_postal'] . '"' ?> > 
							<input type="hidden" id="intextpost" name="intextpost" <?php echo 'value="' . $row['intext'] . '"' ?> > 
							<input type="hidden" id="extpost" name="extpost" <?php echo 'value="' . $row['nom_ext'] . '"' ?> > 
							<input type="hidden" id="sallepost" name="sallepost" <?php echo 'value="' . $row['nom_salle'] . '"' ?> > 
							<input type="hidden" id="adressepost" name="adressepost" <?php echo 'value="' . $row['adresse'] . '"' ?> > 
							<input type="hidden" id="fbpost" name="fbpost" <?php echo 'value="' . $row['lien_fb'] . '"' ?> > 
							<input type="hidden" id="ticketpost" name="ticketpost" <?php echo 'value="' . $row['lien_ticket'] . '"' ?> > 
							<style type="text/css">
								#footer 
								{
								  display:flex;
								}
							</style>
							<div id="footer">
								<?php
								if ($pseudo)
								{
									if($row['valide'] == 0 || $testadmin > 0)
									{?>
										<input id="modifier" type="submit" name="modsuppr" value="Modifier"> 
									<?php
									}
									else
									{
										echo "Concert validé, il n'est plus modifiable";
										?><input id="probleme" type="submit" name="probleme" value="Signaler un probleme sur ce concert"> <?php
									}
									if($testadmin > 0) 
									{?>
										<input id="supprimer" type="submit" name="modsuppr" value="Supprimer"> 
										<?php 
										if($row['valide'] == 0)
										{?>
											<input id="valider" type="submit" name="modsuppr" value="Valider">
										<?php
										}
									}
								}
								else
								{
									echo "Vous devez être connectés afin de modifier un concert";
								}?>
							</div>
						</form>
					</div>
				<?php
	 			}
	 			?>
			</div>
			<?php require "./messages.php"; ?> 
	</body>
	<?php include('footer.html'); ?>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>


