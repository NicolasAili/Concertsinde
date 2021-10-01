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
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'php/js.php';
			require('php/database.php');
			require('php/error.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/allconcerts.css">
	</head>
	<body>	
		<header>
			<?php include('contenu/header.php'); ?>
			<script src="js/scrollnav.js"></script> 
		</header>
		<div id="main">
			<?php
			require('php/database.php');
			
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

			$page = $_POST['page'];
			$sqlquery = $_POST['sqlquery'];
			$i = 0; //compteur pour les pages
			$n = 15;

			if(!$archive)
			{
				$archive = 'no';
			}

			if(!$page)
			{
				$page = 1;
			}


			$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$testadmin = $row['admin'];

			$string = $_SERVER['QUERY_STRING'];
			
			parse_str($string);
			$finalstring = explode("&", $string);
			$filtre = " datec ASC";
			$archivesql = " AND concert.datec >= NOW()";


			if(!$add && !$modif)
			{
				?>
				<a class="filterresult" href="#" onclick="displayconcert();"> filtrer les résultats </a>
				<div class="container">
					<ul class="ul">
						<li>
							<div class="formsalle"> Salle </div>
							<ul class="formsalledepth">
								<li>
									<form action="allconcerts.php" method="get">
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
								<li>
							</ul>
						</li>
						<br>
						<li>
							<div class="formville">Ville</div>
							<ul class="formvilledepth">
								<li>
									<form action="allconcerts.php" method="get">
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
								</li>
							</ul>
						</li>
						<br>
						<li>
							<div class="formcp">Code postal</div>
							<ul class="formcpdepth">
								<li>
									<form action="allconcerts.php" method="get">
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
								</li>
							</ul>
						</li>
						<br>
						<li>
							<div class="formdpt">Département</div>
							<ul class="formdptdepth">
								<li>
									<form action="allconcerts.php" method="get">
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
								</li>
							</ul>
						</li>
						<br>
						<li>
							<div class="formnumdpt">Numero de département</div>
							<ul class="formnumdptdepth">
								<li>
									<form action="allconcerts.php" method="get">
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
								</li>
							</ul> 
						</li>
						<br>
						<li>
							<div class="formrgn">Region</div>
							<ul class="formrgndepth">
								<li>
									<form action="allconcerts.php" method="get">
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
								</li>
							</ul>
						</li>
					</ul> 
				</div>
	
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
				<div id="filtres">
					<ul>
						<li class=deroulant><a href="#"> <?php switch ($filter) {
								case 'artisteup':
									echo "nom d'artiste (A à Z)";
									break;
								case 'artistedown':
									echo "nom d'artiste (Z à A)";
									break;
								case 'dateup':
									echo "Date (du plus proche, par défaut)";
									break;
								case 'datedown':
									echo "Date (du plus éloigné)";
									break;
								
								default:
									echo "Date (du plus proche, par défaut)";
									break;
								}?></a>
							<ul class="sous">
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
								echo "<li>";
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
									echo "nom d'artiste (A à Z)"; 
									if($filter == "artisteup")
									{
										echo "</strong>";
									} 
									echo '</a>';
								echo "</li>";

								echo "<br>";
								echo "<li>";
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
									echo "nom d'artiste (Z à A)";
									if($filter == "artistedown")
									{
										echo "</strong>";
									} 
									echo '</a>';
								echo "</li>";
								
								echo "<br>";
								echo "<li>";
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
									echo "Date (du plus proche, par défaut)";
									if($filter == "dateup")
									{
										echo "</strong>";
									} 
									echo '</a>';
								echo "</li>";

								echo "<br>";
								echo "<li>";
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
									echo "Date (du plus éloigné)"; 
									if($filter == "datedown")
									{
										echo "</strong>";
									} 
									echo '</a>';
								echo "</li>";
								?>
							</ul>
						</li>
					</ul>
				</div>
				<?php
				echo "<br>";
				echo "<br>";
				echo "<br>";
				/*echo '<a href="allconcerts.php?filter=reset">'; echo "Réinitialiser les filtres"; echo '</a>';*/
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
			<div id="pages">
				<ul>
					<li> <a href="#"><?php switch (variable) {
						case 'value':
							# code...
							break;
						
						default:
							echo "10 (par défaut)";
							break;
					}?>
						
						<ul>
							<li>
								25
							</li>
							<li>
								50
							</li>
						</ul>
					</li>
				</ul>
			</div>


			<hr>
			<h1>Tous les concerts</h1>
			<img src="image/valide.png" height="50" width="50"> = Concert validé (non modifiable)
			<br>
			<img src="image/invalide.png" height="50" width="50"> = Concert non validé (modifiable)
			<?php
			$admin = 'administateur';
			if($getsalle)
			{
				$strf = sprintf("SELECT id_concert FROM concert, salle WHERE salle.id_salle = concert.fksalle AND nom_salle = '$getsalle'". $archivesql ." ORDER BY". $filtre ."");

			}
			else if ($getville) {
				$strf = sprintf("SELECT id_concert FROM concert, ville, salle WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.nom_ville = '$getville'. $archivesql .ORDER BY". $filtre ."");
			}
			else if ($getcp) {
				$strf = sprintf("SELECT id_concert FROM concert, ville, salle WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.ville_code_postal = '$getcp'. $archivesql .ORDER BY". $filtre ."");
			}
			else if ($getdepartement) {
				$strf = sprintf("SELECT id_concert FROM concert, ville, salle, departement WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.ville_departement = departement.numero AND departement.nom_departement = '$getdepartement'. $archivesql .ORDER BY". $filtre ."");
			}
			else if ($getnumdepartement) {
				$strf = sprintf("SELECT id_concert FROM concert, ville, salle, departement WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.ville_departement = departement.numero AND departement.numero = '$getnumdepartement'. $archivesql .ORDER BY". $filtre ."");
			}
			else if ($getregion) {
				$strf = sprintf("SELECT id_concert FROM concert, ville, salle, departement, region WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.ville_departement = departement.numero AND departement.id_region = region.id AND region.nom_region = '$getregion'. $archivesql .ORDER BY". $filtre ."");
			}
			else if ($add)
			{
				$strf = sprintf("SELECT id_concert FROM concert WHERE user_ajout = '$add'". $archivesql ."");
			}
			else if ($modif)
			{
				$strf = sprintf("SELECT DISTINCT id_concert FROM modification WHERE id_user = '$modif'". $archivesql ."");
			}
			else if($sqlquery)
			{
				$strf = $sqlquery;
			}
			else
			{
				$strf = sprintf("SELECT id_concert FROM concert WHERE 1". $archivesql ." ORDER BY". $filtre ."");
			}
			
			$result = mysqli_query($con, $strf);
			?>
			<div id="concertsall">
				<?php

				while($rowx = mysqli_fetch_array($result)) 
				{
					if($i >= $page*$n-$n && $i<$page*$n) 
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
									}
									?>
								</div>
							</form>
						</div>
						<?php
					}
					$i++;
	 			}
	 			?>
 				<form method="post" action="allconcerts.php" class="page" style="display: flex;">
 					<input id="un" type="submit" name="page" value="<?php if($page == 1){echo '1';}else{echo $page-1;}?>"<?php if($page == 1){echo 'style="font-weight: bold;"';;} ?>>
 					<?php if($i>$n-1)
 					{
 						?>
 						<input id="deux" type="submit" name="page" value="<?php if($page == 1){echo '2';}else{echo $page;} ?>"<?php if($page>1){echo 'style="font-weight: bold;"';;} ?>>
 						<?php
 					}
 					if($i>2*$n-1)
 					{
 						if($page == 1 && $i > 2*$n-1)
 						{?>
 							<input id="trois" type="submit" name="page" value="3"> <?php
 						}
 						else if($i >= $page*$n && $page > 1)
 						{?>
 							<input id="trois" type="submit" name="page" value="<?php echo($page+1); ?>"> <?php
 						}
 					}?>
 					<input type="hidden" id="sqlquery" name="sqlquery" <?php echo 'value="' . $strf . '"' ?> >
 				</form>
			</div>
			<?php require "action/messages.php"; ?>
		</div>
		<?php include('contenu/footer.html'); ?>
	</body>
</html>

<script>
	function displayconcert()
	{
		

		/*if($(".ul").children().css("display") == "block")
		{
			$( "ul.ul" ).children().css( "display", "none" );
			console.log("ok1");
		}
		else
		{*/
			$( "ul.ul" ).children().slideToggle( "slow", function()
		{
	  	});
		/*}*/
	}

	/*function displayform()
	{
		var className = $(this).attr('class');
      	console.log(className);
		/*$(".depthtwo").children().slideToggle( "slow", function()
		{
	  	});
	}*/
</script>

<script>
        $(document).ready(function () {
            $(".formsalle, .formville, .formcp, .formdpt, .formnumdpt, .formrgn").click(function () {
                var getClass = this.className;
                var getClassdepth = getClass + "depth";

                if($(".formsalledepth").children().css("display") == "list-item" && getClassdepth != 'formsalledepth')
                {
                	$(".formsalledepth").children().slideToggle( "slow", function()
					{

			  		});
                }
                if($(".formvilledepth").children().css("display") == "list-item" && getClassdepth != 'formvilledepth')
                {
                	$(".formvilledepth").children().slideToggle( "slow", function()
					{

			  		});
                } 
                if($(".formcpdepth").children().css("display") == "list-item" && getClassdepth != 'formcpdepth')
                {
                	$(".formcpdepth").children().slideToggle( "slow", function()
					{

			  		});
                } 
                if($(".formdptdepth").children().css("display") == "list-item" && getClassdepth != 'formdptdepth')
                {
                	$(".formdptdepth").children().slideToggle( "slow", function()
					{

			  		});
                } 
                if($(".formnumdptdepth").children().css("display") == "list-item" && getClassdepth != 'formnumdptdepth')
                {
                	$(".formnumdptdepth").children().slideToggle( "slow", function()
					{

			  		});
                } 
                if($(".formrgndepth").children().css("display") == "list-item" && getClassdepth != 'formrgndepth')
                {
                	$(".formrgndepth").children().slideToggle( "slow", function()
					{

			  		});
                }    

            	$("."+getClass+"depth").children().slideToggle( "slow", function()
				{

			  	});
		});
    });
</script>

