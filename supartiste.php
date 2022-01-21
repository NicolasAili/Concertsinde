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
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'contenu/reseaux.php';
			require('php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/superartiste.css">
	</head>
	
	<body>
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<div id="main">
			<?php
				require('php/database.php');
			?>
			<?php
			$artiste = $_GET['artiste'];
			?>
			<div id="partun"><?php
				$filename = 'image/artiste/' . $artiste . '.jpg';
				if (file_exists($filename)) 
				{
    				echo '<img src="image/artiste/' . $artiste . '.jpg' . '" id="imgartiste">';
				} 
				else 
				{
    				echo '<img src="image/artiste/inconnu.png" id="imgartisteinconnu">';
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
							<br>
							<input type="submit" value="Enregister la description" name="concert" href="">
						</form>
						<?php
					}
					else
					{
						echo $row[0];	
					}?>
				</div>
			</div><?php
			$sql = "SELECT id_concert FROM concert, artiste WHERE concert.nom_artiste = artiste.Nom_artiste AND artiste.Nom_artiste = '$artiste' AND concert.datec >= NOW() ORDER BY datec ASC";
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
							$str = "SELECT datec, heure, lien_fb, date_ajout, lien_ticket, concert.nom_artiste, user_ajout, user_modif, valide, id_salle, adresse, nom_salle, nom_ext, intext, nom_ville, ville_code_postal, ville_departement FROM concert, artiste, salle, ville WHERE concert.nom_artiste = artiste.Nom_artiste AND concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND id_concert = $idconcert ";
							$resultx = mysqli_query($con, $str);
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
									<?php 
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
									echo "<span>";
										echo $row['nom_artiste'];
									echo "</span>";
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

									<div class="footer">
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
		 		$sql = "SELECT id_concert FROM concert, artiste WHERE concert.nom_artiste = artiste.Nom_artiste AND artiste.Nom_artiste = '$artiste' AND concert.datec < NOW() ORDER BY datec DESC";
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
							$str = "SELECT datec, heure, lien_fb, date_ajout, lien_ticket, concert.nom_artiste, user_ajout, user_modif, valide, id_salle, adresse, nom_salle, nom_ext, intext, nom_ville, ville_code_postal, ville_departement FROM concert, artiste, salle, ville WHERE concert.nom_artiste = artiste.Nom_artiste AND concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND id_concert = $idconcert ";
							$resultx = mysqli_query($con, $str);
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
									<img class="image" src="image/archive.png" height="50" width="50">
									<?php
									echo "<span>";
										echo $row['nom_artiste'];
									echo "</span>";
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
	</body>
</html>

<script>
	function concert()
	{
		$('#futuresconcerts').css('visibility', 'visible');
        $('#futuresconcerts').css('display', 'contents');
        $('#archivesall').css('visibility', 'hidden');
        $('#archivesall').css('display', 'none');
        $('#spanconcert').css('cursor', 'zoom-in');
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
        $('#spanarchive').css('cursor', 'zoom-in');
        $('#spanconcert').css('cursor', 'pointer');
		$('#spanarchive').css('border-bottom', '3px solid #df1c1c');
		$('#spanconcert').css('border-bottom', '3px solid transparent');
	}
</script>

<script>
	$(document).delegate('.infologo','mouseenter',function(){
		var position = $(this).position();
		$('.infos').addClass('hidden');
		$(this).next('.infos').removeClass('hidden');
		$(this).next('.infos').css('left', position.left-230 + "px");
		$(this).next('.infos').css('top', position.top-30 + "px");
		console.log(position.left);
		console.log(position.top);
	});

	$(document).delegate('.infologo', 'mouseleave',function(){
		$(this).next('.infos').addClass('hidden');
	});
</script>