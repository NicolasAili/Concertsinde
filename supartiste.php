<?php 
/*
	Type fichier : php
	Fonction : afficher la page d'un artiste
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

			$artiste = $_GET['artiste'];

			require ('php/inject.php'); //0) ajouter inject et définir redirect
			$redirect = 'artistes.php';

			$values = array($artiste); //1) mettre données dans un arrray
			$inject = inject($values, null); //2) les vérifier
			$validate = validate($inject, $redirect); //3)validation de tous les champs
			/*if($validate == 0) //4) si pas d'injection : ajout des variables
			{
			  $artiste = mysqli_real_escape_string($con, $artiste); 
			}*/
		?>
		<link rel="stylesheet" type="text/css" href="css/body/superartiste.css">
	</head>
	
	<body>
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<?php include 'contenu/reseaux.php'; ?>
		<div id="main">
			<?php
				$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
				$query = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($query);
				$testadmin = $row['admin'];
			?>
			<div id="partun"><?php
				$filename = 'image/artiste/' . $artiste . '.jpg';
				$artistelink = str_replace(" ", "%20", "$artiste");
				if (file_exists($filename)) 
				{
    				echo '<img alt="artiste" src="image/artiste/' . $artistelink . '.jpg' . '" class="imgartiste">';
				} 
				else 
				{
					$filename = 'image/artiste/' . $artiste . '.png';
					if (file_exists($filename)) 
					{
						echo '<img alt="artiste" src="image/artiste/' . $artistelink . '.png' . '" class="imgartiste">';
					}
					else
					{
						echo '<img alt="artiste_pas_dimage" src="image/artiste/inconnu.png" class="imgartiste">';
					}
    				
				}?>
				<div id="partunun"><?php
					echo '<h1>' . $artiste . '</h1>';
					$sql = "SELECT description FROM artiste WHERE Nom_artiste = '$artiste' ";
					$result = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($result);
					if($row[0] == NULL)
					{
						?> 
						<form method="post" class="connect" action="action/adddescr.php">
							<textarea cols="40" rows="5" name="description" id="description" placeholder="Il n'existe pas de description pour cet artiste, vous pouvez en ajouter une"></textarea> 
							<input type="hidden" id="artiste" name="artiste" <?php echo 'value="' . $artiste . '"' ?> > 
							<input type="submit" value="Enregister la description" name="concert">
						</form>
						<?php
					}
					else
					{
						echo $row[0];	
					}?>
				</div>
			</div><?php
			$sql = "SELECT DISTINCT artistes_concert.id_concert FROM concert, artistes_concert WHERE concert.id_concert = artistes_concert.id_concert AND Nom_artiste = '$artiste' AND concert.datec >= DATE_FORMAT(NOW(), '%y-%m-%d') ORDER BY datec ASC;";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result);
			?>
			<div id="bandeau">
				<span id="spanconcert" onclick="concert();">Concerts</span>
				<span id="spanarchive" onclick="archive();">Archives</span>
			</div>
			<div id="futuresconcerts">
				<?php
				echo "<h2> Concerts à venir </h2>";
				if(!$row)
				{?>
					<div id="noconcert" onclick="archive();"><?php
						echo "Aucun concert n'est prévu pour cet artiste, consultez les archives";?>
					</div><?php
				}
				else
				{?>
					<div class="concertsall"><?php
						$result = mysqli_query($con, $sql);
						while($rowx = mysqli_fetch_array($result)) 
						{
							$idconcert = $rowx['id_concert'];
							$row['ville_departement'] = NULL;
							$rowdpt['id_region'] = NULL;
							$rowdpt['nom_departement'] = NULL;
							$rowrgn['nom_pays'] = NULL;
							$rowrgn['nom_region'] = NULL;
							$str = "SELECT DISTINCT datec, heure, lien_fb, date_ajout, lien_ticket, artistes_concert.nom_artiste, user_ajout, user_modif, valide, id_salle, adresse, nom_salle, nom_ext, intext, ville_nom_reel, ville_code_postal, ville_departement FROM concert, artiste, salle, ville, artistes_concert WHERE concert.id_concert = artistes_concert.id_concert AND concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND concert.id_concert = $idconcert";
							$resultx = mysqli_query($con, $str);
							$row_cnt = mysqli_num_rows($resultx);
							$row = mysqli_fetch_array($resultx);
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
									<div style="margin-left: 2%; width: 8%;">
										<?php 
										if($row['valide'] == 0)
										{?>
											<img class="image" src="image/invalide.png" height="50" width="50" alt="invalide">
										<?php
										}
										else
										{?>
											<img class="image" src="image/valide.png" height="50" width="50" alt="valide">
										<?php
										}
										?>
									</div>
									<?php
									echo '<div class="lesartistes">';
										unset($artistes_arr);
										if($row_cnt == 1)
										{
											echo $row['nom_artiste'];
											$artistes_arr[0] = $row['nom_artiste'];
										}
										else
										{
											$i = 1;
											$str = "SELECT artistes_concert.nom_artiste FROM concert, artistes_concert WHERE concert.id_concert = artistes_concert.id_concert AND concert.id_concert = $idconcert";
											$resultx = mysqli_query($con, $str);
											while ($rowart = mysqli_fetch_array($resultx)) 
											{
												$artistes_arr[$i-1] = $rowart['nom_artiste'];
												if($artiste == $rowart['nom_artiste'])
												{
													echo $rowart['nom_artiste'];
												}
												else
												{
													echo '<a class="artistetxt" href="supartiste.php?artiste=' . $rowart['nom_artiste'] . '">'; echo $rowart['nom_artiste']; echo '</a>';
												}
												if($i < $row_cnt)
												{
													echo ' / ';
												}		
												$i++;
											}
										}		 
										?>
									</div>
									<div class="infosdiv">
										<img class="infologo" src="image/infos.png" height="50" width="50" alt="infos">
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
											<div class="salle"> <?php echo $row['nom_ext']; ?> </div><?php
										}?>
										<div class="ville"> 
											<?php 
												echo $row['ville_nom_reel'];
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
										<?php
										$nompays = $rowrgn['nom_pays'];
										$filename = 'image/flags/' . $nompays . '.jpg';
										if (file_exists($filename)) 
										{
											?>
											<img alt="drapeau" class="flag" <?php echo 'src="image/flags/' . $rowrgn['nom_pays'] . '.jpg' . '"' ?> width="50" height="30"><?php
										}
										else
										{
											$filename = 'image/flags/' . $nompays . '.png';
											if (file_exists($filename)) 
											{
												?>
												<img alt="drapeau" class="flag" <?php echo 'src="image/flags/' . $rowrgn['nom_pays'] . '.png' . '"' ?> width="50" height="30"><?php
											}
											else
											{
												?>
												<img alt="drapeau" class="flag" <?php echo 'src="image/flags/' . 'noflag' . '.png' . '"' ?> width="50" height="30"><?php
											}
										}
										if($rowdpt['id_region'])
										{
											?>
											<div class="pays"> <?php echo $rowrgn['nom_pays']; ?> </div>
											<div class="region"> <?php echo $rowrgn['nom_region']; ?> </div> 
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
											<div class="departement"> <?php echo $rowdpt['nom_departement']; ?> </div> 
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
										<img alt="lien evenement" src="image/evenement.png">
										<a <?php 
											if (!$row['lien_fb'])
											{
												echo 'onclick="nolink();"';
											}
											else
											{?>
												href="<?php echo  $row['lien_fb']; ?>"<?php
											}?>> 
											Lien vers l'événement 
										</a>
									</div> 
									<div class="ticket">
										<img alt="lien billetterie" src="image/billetterie.png">
										<a <?php 
											if (!$row['lien_ticket'])
											{
												echo 'onclick="nolink();"';
											}
											else
											{?>
												href="<?php echo  $row['lien_ticket']; ?>"<?php
											}?>> 
											Lien vers la billetterie
										</a>
									</div> 
								</div>
								<form method="post" action="modifconcert.php" class="modif">
									<?php
									$i = 0;
									foreach ($artistes_arr as &$value) 
									{
										?>
										<input type="hidden" <?php echo 'class="artistepost' . $i . '"'; echo 'name="artistepost' . $i . '"'; echo 'value="' . $artistes_arr[$i] . '"'; ?> >
										
										<?php
										$i++;
									}?>
									<input type="hidden" class="indices" name="indices" <?php echo 'value="' . $i . '"' ?> > 
									<input type="hidden" class="idpost" name="idpost" <?php echo 'value="' . $idconcert . '"' ?> > 
									<input type="hidden" class="idsallepost" name="idsallepost" <?php echo 'value="' . $row['id_salle'] . '"' ?> > 
									<input type="hidden" class="artistepost" name="artistepost" <?php echo 'value="' . $row['nom_artiste'] . '"' ?> > 
									<input type="hidden" class="datepost" name="datepost" <?php echo 'value="' . $row['datec'] . '"' ?> > 
									<input type="hidden" class="heurepost" name="heurepost" <?php echo 'value="' . $row['heure'] . '"' ?> > 
									<input type="hidden" class="payspost" name="payspost" <?php echo 'value="' . $rowrgn['nom_pays'] . '"' ?> > 
									<input type="hidden" class="regionpost" name="regionpost" <?php echo 'value="' . $rowrgn['nom_region'] . '"' ?> > 
									<input type="hidden" class="departementpost" name="departementpost" <?php echo 'value="' . $rowdpt['nom_departement'] . '"' ?> > 
									<input type="hidden" class="villepost" name="villepost" <?php echo 'value="' . $row['ville_nom_reel'] . '"' ?> > 
									<input type="hidden" class="cppost" name="cppost" <?php echo 'value="' . $row['ville_code_postal'] . '"' ?> > 
									<input type="hidden" class="intextpost" name="intextpost" <?php echo 'value="' . $row['intext'] . '"' ?> > 
									<input type="hidden" class="extpost" name="extpost" <?php echo 'value="' . $row['nom_ext'] . '"' ?> > 
									<input type="hidden" class="sallepost" name="sallepost" <?php echo 'value="' . $row['nom_salle'] . '"' ?> > 
									<input type="hidden" class="adressepost" name="adressepost" <?php echo 'value="' . $row['adresse'] . '"' ?> > 
									<input type="hidden" class="fbpost" name="fbpost" <?php echo 'value="' . $row['lien_fb'] . '"' ?> > 
									<input type="hidden" class="ticketpost" name="ticketpost" <?php echo 'value="' . $row['lien_ticket'] . '"' ?> > 

									<div class="footer">
										<?php
										if ($pseudo)
										{
											if($row['valide'] == 0 || $testadmin > 0)
											{?>
												<input class="modifier" type="submit" name="modsuppr" value="Modifier"> 
											<?php
											}
											else
											{
												?><input class="probleme" type="submit" name="probleme" value="Signaler une erreur"> <?php
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
										}
										?>
									</div>
								</form>
							</div>
						<?php
			 			}?>
			 		</div><?php
		 		}?>
		 	</div>
		 	<div id="archivesall"><?php
		 		echo "<h2> Concerts archivés </h2>";
				$sql = "SELECT DISTINCT artistes_concert.id_concert FROM concert, artistes_concert WHERE concert.id_concert = artistes_concert.id_concert AND Nom_artiste = '$artiste' AND concert.datec < DATE_FORMAT(NOW(), '%y-%m-%d') ORDER BY datec DESC";
				$result = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($result);
				if(!$row)
				{
					echo "Aucune archive pour cet artiste";
				}
				else
				{?>
					<div class="concertsall"><?php
						$result = mysqli_query($con, $sql);
						while($rowx = mysqli_fetch_array($result)) 
						{
							$idconcert = $rowx['id_concert'];
							$row['ville_departement'] = NULL;
							$rowdpt['id_region'] = NULL;
							$rowdpt['nom_departement'] = NULL;
							$rowrgn['nom_pays'] = NULL;
							$rowrgn['nom_region'] = NULL;

							$str = "SELECT DISTINCT datec, heure, lien_fb, date_ajout, lien_ticket, artistes_concert.nom_artiste, user_ajout, user_modif, valide, id_salle, adresse, nom_salle, nom_ext, intext, ville_nom_reel, ville_code_postal, ville_departement FROM concert, artiste, salle, ville, artistes_concert WHERE concert.id_concert = artistes_concert.id_concert AND concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND concert.id_concert = $idconcert";
							$resultx = mysqli_query($con, $str);
							$row_cnt = mysqli_num_rows($resultx);
							$row = mysqli_fetch_array($resultx);
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
									<div style="margin-left: 2%; width: 8%;">
										<img alt="archive" class="image" src="image/archive.png" height="50" width="50">
									</div>
									<?php
									echo '<div class="lesartistes">';
										unset($artistes_arr);
										if($row_cnt == 1)
										{
											echo $row['nom_artiste'];
										}
										else
										{
											$i = 1;
											$str = "SELECT artistes_concert.nom_artiste FROM concert, artistes_concert WHERE concert.id_concert = artistes_concert.id_concert AND concert.id_concert = $idconcert";
											$resultx = mysqli_query($con, $str);
											while ($rowart = mysqli_fetch_array($resultx)) 
											{
												if($artiste == $rowart['nom_artiste'])
												{
													echo $rowart['nom_artiste'];
												}
												else
												{
													echo '<a class="artistetxt" href="supartiste.php?artiste=' . $rowart['nom_artiste'] . '">'; echo $rowart['nom_artiste']; echo '</a>';
												}
												if($i < $row_cnt)
												{
													echo ' / ';
												}		
												$i++;
											}
										}
									echo '</div>'		 
									?>
									<div class="infosdiv">
										<img alt="infos" class="infologo" src="image/infos.png" height="50" width="50">
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
											<div class="salle"> <?php echo $row['nom_ext']; ?> </div><?php
										}?>
										<div class="ville"> 
											<?php 
												echo $row['ville_nom_reel'];
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
										<?php
										$nompays = $rowrgn['nom_pays'];
										$filename = 'image/flags/' . $nompays . '.jpg';
										if (file_exists($filename)) 
										{
											?>
											<img alt="drapeau" class="flag" <?php echo 'src="image/flags/' . $rowrgn['nom_pays'] . '.jpg' . '"' ?> width="50" height="30"><?php
										}
										else
										{
											$filename = 'image/flags/' . $nompays . '.png';
											if (file_exists($filename)) 
											{
												?>
												<img alt="drapeau" class="flag" <?php echo 'src="image/flags/' . $rowrgn['nom_pays'] . '.png' . '"' ?> width="50" height="30"><?php
											}
											else
											{
												?>
												<img alt="drapeau" class="flag" <?php echo 'src="image/flags/' . 'noflag' . '.png' . '"' ?> width="50" height="30"><?php
											}
										}
										if($rowdpt['id_region'])
										{
											?>
											<div class="pays"> <?php echo $rowrgn['nom_pays']; ?> </div>
											<div class="region"> <?php echo $rowrgn['nom_region']; ?> </div> 
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
											<div class="departement"> <?php echo $rowdpt['nom_departement']; ?> </div> 
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
										<img alt="lien evenement" src="image/evenement.png">
										<a <?php 
											if (!$row['lien_fb'])
											{
												echo 'onclick="nolink();"';
											}
											else
											{?>
												href="<?php echo  $row['lien_fb']; ?>"<?php
											}?>> 
											Lien vers l'événement 
										</a>
									</div> 
									<div class="ticket">
										<img alt="lien billetterie" src="image/billetterie.png">
										<a <?php 
											if (!$row['lien_ticket'])
											{
												echo 'onclick="nolink();"';
											}
											else
											{?>
												href="<?php echo  $row['lien_ticket']; ?>"<?php
											}?>> 
											Lien vers la billetterie
										</a>
									</div> 
								</div>
							</div>
						<?php
			 			}?>
			 		</div><?php
				}
	 		?>	
			</div>
		</div>
		<?php include('contenu/footer.html'); ?>
		<?php require "action/messages.php"; ?>
		<script>
			function concert()
			{
				$('#futuresconcerts').css('visibility', 'visible');
		        $('#futuresconcerts').css('display', 'contents');
		        $('#archivesall').css('visibility', 'hidden');
		        $('#archivesall').css('display', 'none');
		        $('#spanconcert').css('cursor', 'auto');
		        $('#spanarchive').css('cursor', 'pointer');
				$('#spanconcert').css('border-bottom', '3px solid #df1c1c');
				$('#spanarchive').css('border-bottom', '3px solid transparent');
			}

			function archive()
			{
				$('#archivesall').css('visibility', 'visible');
		        $('#archivesall').css('display', 'contents');
		        $('#futuresconcerts').css('visibility', 'hidden');
		        $('#futuresconcerts').css('display', 'none');
		        $('#spanarchive').css('cursor', 'auto');
		        $('#spanconcert').css('cursor', 'pointer');
				$('#spanarchive').css('border-bottom', '3px solid #df1c1c');
				$('#spanconcert').css('border-bottom', '3px solid transparent');
			}
		</script>

		<script> 
			$(document).delegate('.infologo','mouseenter',function(){
				var position = $(this).position();
				$('.infos').addClass('hidden');
				height = $('.hidden').height();
				width = $('.hidden').width();
				heightlogo = $('.infologo').height();
				widthlogo = $('.infologo').width();
				widthlogo = widthlogo / 2;
				heightlogo = heightlogo / 2;
				varleft = position.left + widthlogo;
				vartop = position.top - heightlogo;
				$(this).next('.infos').removeClass('hidden');
				$(this).next('.infos').css('left', varleft + "px");
				$(this).next('.infos').css('top', vartop + "px");
			});

			$(document).delegate('.infologo', 'mouseleave',function(){
				$(this).next('.infos').addClass('hidden');
			});
		</script>
	</body>
</html>