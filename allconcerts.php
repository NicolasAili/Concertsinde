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
			include 'contenu/reseaux.php';
		?>
		<link rel="stylesheet" type="text/css" href="css/body/allconcerts.css">
	</head>
	<body>	
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<div id="main">
			<?php
			require('php/database.php');

			$string = $_SERVER['QUERY_STRING'];
			
			parse_str($string);
			$finalstring = explode("&", $string);
			$filtre = " datec ASC";
			$archivesql = " AND concert.datec >= NOW()";
			
			$add = $_GET['add'];
			$modif = $_GET['modif'];
			$filter = $_GET['filter'];

			$getfiltre = '0';

			$getsalle = $_GET['salle'];
			if(!$getsalle)
			{
				$getsalle = $_POST['salle'];
				if($getsalle)
				{
					$getfiltre = '1';
					$finalstring[0] = "salle=" . $getsalle;
				}
			}
			
			$getville = $_GET['ville'];
			if(!$getville)
			{
				$getville = $_POST['ville'];
				if($getville)
				{
					$getfiltre = '1';
					$finalstring[0] = "ville=" . $getville;
				}
			}

			$getcp = $_GET['cp'];
			if(!$getcp)
			{
				$getcp = $_POST['cp'];
				if($getcp)
				{
					$getfiltre = '1';
					$finalstring[0] = "cp=" . $getcp;
				}
			}

			$getdepartement = $_GET['departement'];
			if(!$getdepartement)
			{
				$getdepartement = $_POST['departement'];
				if($getdepartement)
				{
					$getfiltre = '1';
					$finalstring[0] = "departement=" . $getdepartement;
				}
			}

			$getnumdepartement = $_GET['numero'];
			if(!$getnumdepartement)
			{
				$getnumdepartement = $_POST['numero'];
				if($getnumdepartement)
				{
					$getfiltre = '1';
					$finalstring[0] = "numero=" . $getnumdepartement;
				}
			}

			$getregion = $_GET['region'];
			if(!$getregion)
			{
				$getregion = $_POST['region'];
				if($getregion)
				{
					$getfiltre = '1';
					$finalstring[0] = "region=" . $getregion;
				}	
			}

			$pseudo = $_SESSION['pseudo'];
			$archive = $_GET['archive'];

			$page = $_POST['page'];
			$sqlquery = $_POST['sqlquery'];
			$i = 0; //compteur pour les pages
			$n = $_POST['n']; //nb concerts à afficher par page
			if(!$n)
			{
				$n = $_GET['n'];;
			}

			$tri = $_POST['tri'];
			$postfiltre;

			if(!$filter)
			{
				$filter = $tri;
			}
			else
			{
				$tri = $filter;
			}

			if($postfiltre)
			{
				$filter = $postfiltre;
			}

			if(!$n)
			{
				$n = 10;
			}

			if(!$archive)
			{
				$archive = $_POST['archive'];
				if(!$archive)
				{
					$archive = 'no';
				}
			}

			if(!$page)
			{
				$page = 1;
			}


			$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$testadmin = $row['admin'];

			



			?>
			<div id="ici">
				<div id="icifirst">Vous êtes ici :</div> Accueil > concerts
			</div>
			<div id="hcun"><h1>Tous les</h1> <h1 id=hconcert> concerts</h1></div>
			<hr id="hrun">
			<div id="mainfilter">
				<div id="filterone">
					<?php
					if(!$add && !$modif)
					{
						?>
						<div id="filteroneone">
							<a class="filterresult" onclick="displayconcert();"> filtrer les résultats ▼</a>
							<div class="container">
								<ul class="ul">
									<li>
										<div class="formsalle">► Salle</div>
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
												  <input type="hidden" id="n" name="n" <?php echo 'value='; echo $n;?>>
												  <input type="hidden" id="archive" name="archive" <?php echo 'value='; echo $archive;?>>
												  <input type="submit" value="Filtrer">
												</form>
											<li>
										</ul>
									</li>
									<br>
									<li>
										<div class="formville">► Ville</div>
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
												  <input type="hidden" id="n" name="n" <?php echo 'value='; echo $n;?>>
												  <input type="hidden" id="archive" name="archive" <?php echo 'value='; echo $archive;?>>
												  <input type="submit" value="Filtrer">
												</form>
											</li>
										</ul>
									</li>
									<br>
									<li>
										<div class="formcp">► Code postal</div>
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
												  <input type="hidden" id="n" name="n" <?php echo 'value='; echo $n;?>>
												  <input type="hidden" id="archive" name="archive" <?php echo 'value='; echo $archive;?>>
												  <input type="submit" value="Filtrer">
												</form>
											</li>
										</ul>
									</li>
									<br>
									<li>
										<div class="formdpt">► Département</div>
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
												  <input type="hidden" id="n" name="n" <?php echo 'value='; echo $n;?>>
												  <input type="hidden" id="archive" name="archive" <?php echo 'value='; echo $archive;?>>
												  <input type="submit" value="Filtrer">
												</form>
											</li>
										</ul>
									</li>
									<br>
									<li>
										<div class="formnumdpt">► Numero de département</div>
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
												  <input type="hidden" id="n" name="n" <?php echo 'value='; echo $n;?>>
												  <input type="hidden" id="archive" name="archive" <?php echo 'value='; echo $archive;?>>
												  <input type="submit" value="Filtrer">
												</form>
											</li>
										</ul> 
									</li>
									<br>
									<li>
										<div class="formrgn">► Region</div>
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
												  <input type="hidden" id="n" name="n" <?php echo 'value='; echo $n;?>>
												  <input type="hidden" id="archive" name="archive" <?php echo 'value='; echo $archive;?>>
												  <input type="submit" value="Filtrer">
												</form>
											</li>
										</ul>
									</li>
								</ul> 
							</div>
						</div>
					<?php
					}
					?>
					<div id="checkboxdiv">
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
							echo '&archive=no'; echo "&n="; echo "$n";
						}
						else if($archive == 'no')
						{
							echo '&archive=yes'; echo "&n="; echo "$n";
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
						Afficher les concerts archivés
					</div>
				</div>

				<div id="filtertwo">
					<div id="reset"><a href="allconcerts.php?filter=reset" id="txtreset">Réinitialiser les filtres</a></div>
					<?php
					if(!$add && !$modif)
					{
						?>
						<div class="trier">
							<div id="triertxtun">   Trier par: </div>
							<div class="filtres">
								<ul class="content">
									<li class=deroulant><a href="#" style="padding: 0;"> <?php 
										if($filter == 'artisteup' || $tri == 'artisteup')
										{
											echo "nom d'artiste (A à Z)";
										}
										else if($filter == 'artistedown' || $tri == 'artistedown')
										{
											echo "nom d'artiste (Z à A)";
										}
										else if($filter == 'dateup' || $tri == 'dateup')
										{
											echo "Date (du plus proche, par défaut)";
										}
										else if($filter == 'datedown' || $tri == 'datedown')
										{
											echo "Date (du plus éloigné)";
										}
										else
										{
											echo "Date (du plus proche, par défaut)";
										}
										?></a>
										<ul class="sous">
											<?php
											if(!$archive || $archive == 'no')
											{
												$archivestring = 'archive=no';
											}
											else
											{
												$archivestring = 'archive=yes';
											}
											echo "<br>";
											echo "<li>";
												if($string && $filter != "artisteup" && $finalstring[0] != "recherche=none")
												{
													echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=artisteup&"; echo $archivestring; echo "&n="; echo "$n"; echo '">';
												}
												else if($getfiltre == '1')
												{
													echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=artisteup&"; echo $archivestring; echo "&n="; echo "$n"; echo '">';
												}
												else /*recherche == none */ 
												{
													echo '<a href="allconcerts.php?recherche=none&filter=artisteup&'; echo $archivestring; echo "&n="; echo "$n"; echo '">';
												} 
												if($filter == "artisteup" || $tri == "artisteup")
												{
													echo "<strong>";
												}
												echo "nom d'artiste (A à Z)"; 
												if($filter == "artisteup" || $tri == "artisteup")
												{
													echo "</strong>";
												} 
												echo '</a>';
											echo "</li>";

											echo "<br>";
											echo "<li>";
												if($string && $filter != "artistedown" && $finalstring[0] != "recherche=none")
												{
													echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=artistedown&"; echo $archivestring; echo "&n="; echo "$n"; echo '">';
												}
												else if($getfiltre == '1')
												{
													echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=dateup&"; echo $archivestring; echo "&n="; echo "$n"; echo '">';
												}
												else
												{
													echo '<a href="allconcerts.php?recherche=none&filter=artistedown&'; echo $archivestring; echo "&n="; echo "$n"; echo '">';
												} 
												if($filter == "artistedown" || $tri == "artistedown")
												{
													echo "<strong>";
												}
												echo "nom d'artiste (Z à A)";
												if($filter == "artistedown" || $tri == "artistedown")
												{
													echo "</strong>";
												} 
												echo '</a>';
											echo "</li>";
											
											echo "<br>";
											echo "<li>";
												if($string && $filter != "dateup" && $finalstring[0] != "recherche=none")
												{
													echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=dateup&"; echo $archivestring; echo "&n="; echo "$n"; echo '">';
												}
												else if($getfiltre == '1')
												{
													echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=dateup&"; echo $archivestring; echo "&n="; echo "$n"; echo '">';
												}
												else
												{
													echo '<a href="allconcerts.php?recherche=none&filter=dateup&'; echo $archivestring; echo "&n="; echo "$n"; echo '">';
												} 
												if($filter == "dateup" || $tri == "dateup" || $filter == 'none' || !$filter || !$tri || $filter == 'reset')
												{
													echo "<strong>";
												}
												echo "Date (du plus proche, par défaut)";
												if($filter == "dateup" || $tri == "dateup" || $filter == 'none' || !$filter || !$tri || $filter == 'reset')
												{
													echo "</strong>";
												} 
												echo '</a>';
											echo "</li>";

											echo "<br>";
											echo "<li>";
												if($string && $filter != "datedown" && $finalstring[0] != "recherche=none")
												{
													echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=datedown&"; echo $archivestring; echo "&n="; echo "$n"; echo '">';
												}
												else if($getfiltre == '1')
												{
													echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=datedown&"; echo $archivestring; echo "&n="; echo "$n"; echo '">';
												}
												else
												{
													echo '<a href="allconcerts.php?recherche=none&filter=datedown&'; echo $archivestring; echo "&n="; echo "$n"; echo '">';
												} 
												if($filter == "datedown" || $tri == "datedown")
												{
													echo "<strong>";
												}
												echo "Date (du plus éloigné)"; 
												if($filter == "datedown" || $tri == "datedown")
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
						</div>
					<?php
					}?>			

					<?php
					switch($filter)
					{
						case "artisteup":
							$filtre = " nom_artiste ASC";
							$tri = 'artisteup';
							break;
						case "artistedown":
							$filtre = " nom_artiste DESC";
							$tri = 'artistedown';
							break;
						case "dateup":
							$filtre = " datec ASC";
							$tri = 'dateup';
							break;
						case "datedown":
							$filtre = " datec DESC";
							$tri = 'datedown';
							break;
					}

					switch ($_GET['archive']) 
					{
						case 'yes':
							$archivesql = " AND concert.datec <= NOW()";
							if($filter != "artisteup" && $filter != "artistedown")
							{
								if($filtre == " datec ASC")
								{
									$filtre = " datec DESC";
								}
								else
								{
									$filtre = " datec ASC";
								}
							}
							break;
						case 'no':
							$archivesql = " AND concert.datec >= NOW()";
							break;
						default:
							$archivesql = " AND concert.datec >= NOW()";
							break;
					}
					?>

					<?php
					//$admin = 'administateur';
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
						$strf = sprintf("SELECT DISTINCT modification.id_concert FROM modification, concert WHERE id_user = '$modif'". $archivesql ."");
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
					
					$search = "SELECT id_concert";
					$replace = "SELECT COUNT(id_concert) AS countrec";
					$count = str_replace($search, $replace, $strf);

					if ($count == $strf) 
					{
						$search = "SELECT DISTINCT modification.id_concert";
						$replace = "SELECT COUNT(DISTINCT modification.id_concert)";
						$count = str_replace($search, $replace, $strf);
					}
					$countresult = mysqli_query($con, $count);

					?>

					<div class="trier">
						<div id="triertxtdeux"> Résultats par page: </div>
						<div class="filtres">
							<ul class="content">
								<li class="deroulant"> <a href="#" style="padding: 0;"><?php switch ($n) {
									case '25':
										echo "25";
										break;
									case '50':
										echo "50";
										break;
									default:
										echo "10 (par défaut)";
										break;
								}?></a>
									<ul class="sous">
										<form method="post" action="allconcerts.php" class="n">
											<li>
												<input type="submit" name="n" value="10">
											</li>
											<li>
												<input type="submit" name="n" value="25">
											</li>
											<li>
												<input type="submit" name="n" value="50">
											</li>
											<?php
											if($getsalle)
											{?>
												<input type="hidden" name="salle" <?php echo 'value="' . $getsalle . '"' ?>><?php
											}
											else if($getregion)
											{?>
												<input type="hidden" name="region" <?php echo 'value="' . $getregion . '"' ?>><?php
											}
											else if($getnumdepartement)
											{?>
												<input type="hidden" name="numero" <?php echo 'value="' . $getnumdepartement . '"' ?>><?php
											}
											else if($getdepartement)
											{?>
												<input type="hidden" name="departement" <?php echo 'value="' . $getdepartement . '"' ?>><?php
											}
											else if($getcp)
											{?>
												<input type="hidden" name="cp" <?php echo 'value="' . $getcp . '"' ?>><?php
											}
											else if($getville)
											{?>
												<input type="hidden" name="ville" <?php echo 'value="' . $getville . '"' ?>><?php
											}?>
											<input type="hidden" name="archive" <?php echo 'value="' . $archive . '"' ?>>
											<input type="hidden" name="tri" <?php echo 'value="' . $tri . '"' ?>>
											<input type="hidden" id="sqlquery" name="sqlquery" <?php echo 'value="' . $strf . '"' ?> >
										</form>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			
			<?php
			$rowcount = mysqli_fetch_array($countresult);
			$calc = $rowcount[0];
			?>
			<h4> <?php echo $calc ?> concert(s) trouvé(s) </h4>
			<div id="indics">
				<div class="indication">
					<div class="center">
						<img src="image/valide.png" height="50" width="50">
						<span>
							 Concert validé
						</span>
					</div>
				</div>
				<div class="indication">
					<div class="center">
						<img src="image/invalide.png" height="50" width="50"> 
						<span>
							Concert non validé
						</span>
					</div>
				</div>
				<div class="indication">
					<div class="center">
						<img src="image/archive.png" height="50" width="50"> 
						<span>
							 Concert archivé
						</span>
					</div>
				</div>
			</div>
				
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
						?> 
						<div class="inwhile"> 
							<div class="artiste"> 
								<?php 
								if($archive == 'yes')
								{?>
									<img class="image" src="image/archive.png" height="50" width="50">
								<?php
								}
								else
								{
									if($row['valide'] == 0)
									{?>
										<img class="image" src="image/invalide.png" height="50" width="50">
									<?php
									}
									else
									{?>
										<img class="image" src="image/valide.png" height="50" width="50">
									<?php
									}
								}
								echo '<a class="artistetxt" href="supartiste.php?artiste=' . $row['nom_artiste'] . '">'; echo $row['nom_artiste']; echo '</a>'; 
								?> 
								<img class="infologo" src="image/infos.png" height="50" width="50">
								<div class="infos hidden">
									<div class="dateajout"> 
										<?php $newDate = date("d-m-Y", strtotime($row['date_ajout'])); ?>
										Concert ajouté le: <?php echo $newDate ?> 
									</div> 
									<div class="ajout"> 
										<?php if($rowadd['pseudo']){ echo "Par : "; echo  $rowadd['pseudo'];} else{echo "Par : un anonyme";} ?> 
									</div>
									<div class="modif">
										<?php if($rowmodif['pseudo']){ echo "Dernière modification par : "; echo  $rowmodif['pseudo'];} else{echo "Concert non modifié";} ?> 
									</div>
								</div>
							</div> 
							<div class="principal">
								<div class="sectionun">
									<div class="date"> 
										<?php 
										$datedisp = strtotime($row['datec']); 
										
										$day = date('l', $datedisp); 
										$nbday = date('j', $datedisp); 
										$month = date('F', $datedisp); 
										$year = date('Y', $datedisp);

										switch ($day) {
											case 'Monday':
												echo "Lundi";
												break;
											case 'Tuesday':
												echo "Mardi";
												break;
											case 'Wednesday':
												echo "Mercredi";
												break;
											case 'Thursday':
												echo "Jeudi";
												break;
											case 'Friday':
												echo "Vendredi";
												break;
											case 'Saturday':
												echo "Samedi";
												break;
											case 'Sunday':
												echo "Dimanche";
												break;
											default:
												echo "Erreur";
												break;
										}
										echo "<br>";
										?> 
										<div class="nbday">
											<?php echo $nbday; ?>
										</div>
										<?php
										switch ($month) {
											case 'January':
												echo "Janvier ";
												break;
											case 'February':
												echo "Fevrier ";
												break;
											case 'March':
												echo "Mars ";
												break;
											case 'April':
												echo "Avril ";
												break;
											case 'May':
												echo "Mai ";
												break;
											case 'June':
												echo "Juin ";
												break;
											case 'July':
												echo "Juillet ";
												break;
											case 'August':
												echo "Août ";
												break;
											case 'September':
												echo "Septembre ";
												break;
											case 'October':
												echo "Octobre ";
												break;
											case 'November':
												echo "Novembre ";
												break;
											case 'December':
												echo "Decembre ";
												break;
											default:
												echo "Erreur";
												break;
										}
										echo $year;
										?> 
									</div> 
									<div class="heure"> <?php echo $row['heure']; ?> </div> 
								</div> 
								<div class="barrex"></div>
								<div class="sectiondeux">
									<?php
									if($row['intext'] == 'int')
									{?>
										<div class="salle"> <?php echo $row['nom_salle']; ?> </div> 
									<?php
									} 
									else
									{
										?>
										<div class="salle"> <?php echo  $row['nom_ext']; ?> </div><?php
									}?>
									<div class="ville"> 
										<?php 
											echo $row['nom_ville'];
											if($row['ville_code_postal'])
											{
												?>
												<div class="cp"> (<?php echo  $row['ville_code_postal']; ?>) </div>
												<?php
											}
											else
											{
												?>
													<div class="cp"> Code postal non renseigné </div>
												<?php
											}
										?> 
									</div>
									<div class="adresse"> <?php echo $row['adresse']; ?> </div> 
								</div>
								<div class="barrex"></div>
								<div class="sectiontrois">
									<img class="flag" <?php echo 'src="image/flags/' . $rowrgn['nom_pays'] . '.png' . '"' ?> width="50" height="30">
									<?php
									if($rowdpt['id_region'])
									{
										?>
										<div class="pays"> <?php echo  $rowrgn['nom_pays']; ?> </div>
										<div class="region"> <?php echo  $rowrgn['nom_region']; ?> </div> 
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
										<div class="departement"> <?php echo  $rowdpt['nom_departement']; ?> </div> 
										<?php
									}
									else
									{	
										?>
										<div class="departement"> Département non renseigné </div> 
										<?php
									}
									?>
								</div>
							</div> 
							<div class="links">
								<div class="fb"> 
									<img src="image/evenement.png">
									<a href="<?php echo  $row['lien_fb']; ?>"> Lien vers l'événement </a>
								</div> 
								<div class="ticket">
									<img src="image/billetterie.png">
									<a href="<?php echo  $row['lien_ticket']; ?>"> Lien vers la billetterie </a>
								</div> 
							</div>
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
								<?php
								if($archivesql == " AND concert.datec >= NOW()")
								{?>
									<div class="footer"><?php
										if ($pseudo)
										{
											if($row['valide'] == 0 || $testadmin > 0)
											{?>
												<input id="modifier" type="submit" name="modsuppr" value="Modifier"> 
											<?php
											}
											else
											{
												?><input id="probleme" type="submit" name="probleme" value="Signaler une erreur"> <?php
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
											echo "Vous devez être connecté afin de modifier un concert";
										}?>
									</div><?php
								}?>
							</form>
						</div>
						<?php
					}
					$i++;
	 			}
	 			?>
 				<form method="post" action="allconcerts.php" class="page">
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
 					<?php
					if($getsalle)
					{?>
						<input type="hidden" name="salle" <?php echo 'value="' . $getsalle . '"' ?>><?php
					}
					else if($getregion)
					{?>
						<input type="hidden" name="region" <?php echo 'value="' . $getregion . '"' ?>><?php
					}
					else if($getnumdepartement)
					{?>
						<input type="hidden" name="numero" <?php echo 'value="' . $getnumdepartement . '"' ?>><?php
					}
					else if($getdepartement)
					{?>
						<input type="hidden" name="departement" <?php echo 'value="' . $getdepartement . '"' ?>><?php
					}
					else if($getcp)
					{?>
						<input type="hidden" name="cp" <?php echo 'value="' . $getcp . '"' ?>><?php
					}
					else if($getville)
					{?>
						<input type="hidden" name="ville" <?php echo 'value="' . $getville . '"' ?>><?php
					}?>
					<input type="hidden" id="n" name="n" <?php echo 'value='; echo $n;?>>
 					<input type="hidden" name="archive" <?php echo 'value="' . $archive . '"' ?>>
 					<input type="hidden" name="tri" <?php echo 'value="' . $tri . '"' ?>>
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
		position = $(".container").css("position");
		if(position == 'relative') //on ferme
		{
			$( "ul.ul" ).children().slideToggle( 500, function()
			{
			});
			setTimeout(() => {  $('.container').css("background-color", 'transparent'); $('.container').css("box-shadow", 'none');
			$('.container').css("position", 'static');
    		$('.container').css("z-index", '0'); }, 400);
			
			
		}
		else //on ouvre
		{
			$('.container').css("background-color", '#bfbfbf');
			$('.container').css("box-shadow", '5px 5px 5px #3a0101');
			$('.container').css("position", 'relative');
    		$('.container').css("z-index", '1');
    		$( "ul.ul" ).children().slideToggle( "slow", function()
			{
			});
		}
	}
</script>

<script>
        $(document).ready(function () {
            $(".formsalle, .formville, .formcp, .formdpt, .formnumdpt, .formrgn").click(function () {
                var getClass = this.className;
                var getClassdepth = getClass + "depth";

                if($(".formsalledepth").children().css("display") == "list-item" && getClassdepth != 'formsalledepth') //quand c'est ouvert et qu'on clique sur autre chose
                {
                	$(".formsalledepth").children().slideToggle( "slow", function()
					{
						$(".formsalle").html("► Salle");
			  		});
                }
                if($(".formvilledepth").children().css("display") == "list-item" && getClassdepth != 'formvilledepth')
                {
                	$(".formvilledepth").children().slideToggle( "slow", function()
					{
						$(".formville").html("► Ville");
			  		});
                } 
                if($(".formcpdepth").children().css("display") == "list-item" && getClassdepth != 'formcpdepth')
                {
                	$(".formcpdepth").children().slideToggle( "slow", function()
					{
						$(".formcp").html("► Code postal");
			  		});
                } 
                if($(".formdptdepth").children().css("display") == "list-item" && getClassdepth != 'formdptdepth')
                {
                	$(".formdptdepth").children().slideToggle( "slow", function()
					{
						$(".formdpt").html("► Département");
			  		});
                } 
                if($(".formnumdptdepth").children().css("display") == "list-item" && getClassdepth != 'formnumdptdepth')
                {
                	$(".formnumdptdepth").children().slideToggle( "slow", function()
					{
						$(".formnumdpt").html("► Numéro de département");
			  		});
                } 
                if($(".formrgndepth").children().css("display") == "list-item" && getClassdepth != 'formrgndepth')
                {
                	$(".formrgndepth").children().slideToggle( "slow", function()
					{
						$(".formrgn").html("► Région");
			  		});
                }    

            	$("."+getClass+"depth").children().slideToggle( "slow", function()
				{
					if(getClass == 'formsalle')
					{
						if($(".formsalledepth").children().css("display") != "list-item")
						{
							$(".formsalle").html("► Salle");
						}
						else
						{
							$("."+getClass).html("▼ Salle");
						}
					}
					else if(getClass == 'formville')
					{
						if($(".formvilledepth").children().css("display") != "list-item")
						{
							$(".formville").html("► Ville");
						}
						else
						{
							$("."+getClass).html("▼ Ville");
						}
					}
					else if(getClass == 'formcp')
					{
						if($(".formcpdepth").children().css("display") != "list-item")
						{
							$(".formcp").html("► Code postal");
						}
						else
						{
							$("."+getClass).html("▼ Code postal");
						}
					}
					else if(getClass == 'formdpt')
					{
						if($(".formdptdepth").children().css("display") != "list-item")
						{
							$(".formdpt").html("► Département");
						}
						else
						{
							$("."+getClass).html("▼ Département");
						}
					}
					else if(getClass == 'formnumdpt')
					{
						if($(".formnumdptdepth").children().css("display") != "list-item")
						{
							$(".formnumdpt").html("► Numéro de département");
						}
						else
						{
							$("."+getClass).html("▼ Numéro de département");
						}
					}
					else if(getClass == 'formrgn')
					{
						if($(".formrgndepth").children().css("display") != "list-item")
						{
							$(".formrgn").html("► Région");
						}
						else
						{
							$("."+getClass).html("▼ Région");
						}
					}
					
			  	});
		});
    });
</script>

<script>
	$(document).delegate('.infologo','mouseenter',function(){
		var position = $(this).position();
		$('.infos').addClass('hidden');
		$(this).next('.infos').removeClass('hidden');
		$(this).next('.infos').css('left', position.left-230 + "px");
		$(this).next('.infos').css('top', position.top-30 + "px");
	});

	$(document).delegate('.infologo', 'mouseleave',function(){
		$(this).next('.infos').addClass('hidden');
	});
</script>
