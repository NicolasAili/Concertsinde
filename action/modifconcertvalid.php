<?php
/*
	Type fichier : php
	Fonction : permet de modifier un concert
	Emplacement : action
	Connexion à la BDD : oui  
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui
*/
	session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include '../php/base.php'; 
			include '../php/css.php'; 
			include '../contenu/reseaux.php';
			require('../php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="../css/body/superartiste.css">
	</head>
	
	<body>
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<?php	
		function test_empty($input)
		{
			if ($input == NULL)
			{
				echo("pas d'ancienne valeur (ajout)");
			}
			else
			{
				echo $input;
			}
			echo '<br>';
		}      
			
			$idconcert = $_POST['idpost'];

			$intext = $_POST['intext'];
			$intextpost = $_POST['intextpost'];

			$artiste = $_POST['artistepost'];			

			$testartiste = 0;
			$date = $_POST['date'];
			$datepost = $_POST['datepost'];

			$testdate = 0;
			$heure = $_POST['heure'];
			$heurepost = $_POST['heurepost'];

			$testheure = 0;
			$pays = $_POST['pays'];
			$payspost = $_POST['payspost'];

			$testpays = 0;
			$region = $_POST['region'];
			$regionpost = $_POST['regionpost'];

			$testregion = 0;
			$departement = $_POST['departement'];
			$departementpost = $_POST['departementpost'];

			$testdepartement = 0;
			$ville = $_POST['ville'];
			$villepost = $_POST['villepost'];


			$testville = 0;
			$cp = $_POST['cp'];
			$cppost = $_POST['cppost'];

			$testcp = 0;

			if($intext == "int")
			{
				$salle = $_POST['salle'];
				$ext = NULL;
			}
			else if($intext == "ext")
			{
				$ext = $_POST['extval'];
				$salle = NULL;
			}
			else
			{
				if($intextpost == "int")
				{
					$salle = $_POST['salle'];
					$ext = NULL;
				}
				else if($intextpost == "ext")
				{
					$ext = $_POST['extval'];
					$salle = NULL;
				}
			}
			$sallepost = $_POST['sallepost'];
			$testsalle = 0;
			$extpost = $_POST['extpost'];
			$testext = 0;

			$adresse = $_POST['adresse'];

			$testadresse = 0;
			$adressepost = $_POST['adressepost'];

			$fb = $_POST['fb'];
			$fbpost = $_POST['fbpost'];
			$testfb = 0;
			
			$ticket = $_POST['ticket'];
			$ticketpost = $_POST['ticketpost'];
			$testticket = 0;

			$pseudo = $_SESSION['pseudo'];

			if($_POST['artiste'])
			{
				setcookie('contentMessage', 'Erreur: il est interdit de modifier un artiste', time() + 30, "/");
				header("Location: ../allconcerts.php");
				exit("Erreur: il est interdit de modifier un artiste");
			}

			if($date != $datepost)
			{
				if($date < date("Y-m-d"))
				{
					setcookie('contentMessage', 'Erreur: la date saisie est inférieure à la date courante', time() + 30, "/");
					header("Location: ../allconcerts.php");
					exit("Erreur: la date saisie est inférieure à la date courante");
				}
				$testdate = 1;
				$sqldat = "UPDATE concert SET datec = '$date' WHERE ID_concert = $idconcert";
    			mysqli_query($con, $sqldat);
			}

			$testmodif = 0;

			$sql = "SELECT adresse FROM salle WHERE nom_salle = '$salle'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$modifadresse = $row['adresse'];

			$sql = "SELECT nom_ville FROM ville, salle WHERE nom_salle = '$salle' AND salle.id_ville = ville.ville_id ";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$modifville = $row['nom_ville'];

			/*echo "_______________________";
			echo "<br>";
			echo $intext;
			echo $modifadresse;
			echo "<br>";
			echo $adresse;
			echo "<br>";
			echo "<br>";
			echo $modifville;
			echo "<br>";
			echo "_______________________";*/



			$requestpseudo = "SELECT id_user FROM utilisateur WHERE pseudo = '$pseudo'";
			$query = mysqli_query($con, $requestpseudo);
			$row = mysqli_fetch_array($query);
			$idpseudo = $row['id_user'];

			$idville = "SELECT ville_id FROM ville WHERE nom_ville = '$ville'";
			$query = mysqli_query($con, $idville);
			$row = mysqli_fetch_array($query);
			$vle = $row['ville_id'];

			$iddpt = "SELECT numero FROM departement WHERE nom_departement = '$departement'"; //Verifier si le departement existe
			$query = mysqli_query($con, $iddpt);
			$row = mysqli_fetch_array($query);
			$dpt = $row['numero'];

			$idrgn = "SELECT id FROM region WHERE nom_region = '$region'"; //Verifier si la region existe
			$query = mysqli_query($con, $idrgn);
			$row = mysqli_fetch_array($query);
			$rgn = $row['id'];
			if(!$vle) //si la ville n'existe pas en BDD
			{
				$testvle = 1;
				if($departement)
				{
					if(!$dpt) //le departement n'existe pas
					{
						$insertdpt = "INSERT INTO departement (nom_departement) VALUES ('$departement')"; //ajout département en BDD
						mysqli_query($con, $insertdpt);
						if($region) //la region est renseignée
						{
							$selectpays = "SELECT id FROM pays WHERE nom_pays = '$pays' "; //selectionner pays_id
							$query = mysqli_query($con, $selectpays);
							$row = mysqli_fetch_array($query);
							$idpays = $row['id'];
							if(!$rgn)
							{
								$insertrgn = "INSERT INTO region (nom_region, id_pays) VALUES ('$region', '$idpays') "; //ajout de la région en BDD et lien de la région avec le pays
								mysqli_query($con, $insertrgn);
							}
							$query = mysqli_query($con, $idrgn);
							$row = mysqli_fetch_array($query);
							$rgn = $row['id'];
							$updatedpt = "UPDATE departement SET id_region = '$rgn' WHERE nom_departement = '$departement' "; //lien du departement avec la région
							mysqli_query($con, $updatedpt);
						}
						$query = mysqli_query($con, $iddpt);
						$row = mysqli_fetch_array($query);
						$nodpt = $row['numero'];
						if($cp)
						{
							$insertvle = "INSERT INTO ville (nom_ville, ville_departement, ville_code_postal) VALUES ('$ville', '$nodpt', '$cp')"; //ajout de la ville en BDD + lien avec dpt
						}
						else if(!$cp)
						{

							$insertvle = "INSERT INTO ville (nom_ville, ville_departement) VALUES ('$ville', '$nodpt')"; //ajout de la ville en BDD + lien avec dpt
						}
						mysqli_query($con, $insertvle);
					}
					else if($dpt)
					{
						if($region)
						{
							$selectpays = "SELECT id FROM pays WHERE nom_pays = '$pays' "; //selectionner pays_id
							$query = mysqli_query($con, $selectpays);
							$row = mysqli_fetch_array($query);
							$idpays = $row['id'];
							if(!$rgn)
							{
								$insertrgn = "INSERT INTO region (nom_region, id_pays) VALUES ('$region', '$idpays') "; //ajout de la région en BDD et lien de la région avec le pays
								mysqli_query($con, $insertrgn);
							}
							$updatedpt = "UPDATE departement SET id_region = '$rgn' WHERE nom_departement = '$departement' "; //lien du departement avec la région
							mysqli_query($con, $updatedpt);
						}
						if($cp)
						{
							$insertvle = "INSERT INTO ville (nom_ville, ville_departement, ville_code_postal) VALUES ('$ville', '$dpt', '$cp')"; //ajout de la ville en BDD + lien avec dpt
							mysqli_query($con, $insertvle);
						}
						else if(!$cp)
						{
							$insertvle = "INSERT INTO ville (nom_ville, ville_departement) VALUES ('$ville', '$dpt')"; //ajout de la ville en BDD + lien avec dpt
							mysqli_query($con, $insertvle);
						}
					}
				}
				else if(!$departement)
				{
					if($cp)
					{
						$insertvle = "INSERT INTO ville (nom_ville, ville_code_postal) VALUES ('$ville', '$cp')"; //ajout de la ville en BDD + lien avec dpt
						mysqli_query($con, $insertvle);
					}
					else if(!$cp)
					{
						$insertvle = "INSERT INTO ville (nom_ville) VALUES ('$ville')"; //ajout de la ville en BDD + lien avec dpt
						mysqli_query($con, $insertvle);
					}
				}
			}
			else if($vle) //la ville existe
			{
				if($departement) //le departement est renseigne
				{
					if(!$dpt) //... et il n'existe pas en BDD
					{
						$insertdpt = "INSERT INTO departement (nom_departement) VALUES ('$departement')"; //ajout département en BDD
						mysqli_query($con, $insertdpt);

						$query = mysqli_query($con, $iddpt); //SELECT numero FROM departement WHERE nom_departement = '$departement'
						$row = mysqli_fetch_array($query);
						$nodpt = $row['numero'];

						$updatedpt = "UPDATE ville SET ville_departement = '$nodpt' WHERE ville_id = '$vle' "; 
						mysqli_query($con, $updatedpt);
						if($region) //la région (et le pays) sont renseignés
						{
							$selectpays = "SELECT id FROM pays WHERE nom_pays = '$pays' "; //selectionner pays_id
							$query = mysqli_query($con, $selectpays);
							$row = mysqli_fetch_array($query);
							$idpays = $row['id'];
							if(!$rgn)
							{
								$insertrgn = "INSERT INTO region (nom_region, id_pays) VALUES ('$region', '$idpays') "; //ajout de la région en BDD et lien de la région avec le pays
								mysqli_query($con, $insertrgn);
							}
							$query = mysqli_query($con, $idrgn);
							$row = mysqli_fetch_array($query);
							$rgn = $row['id'];
							$updatedpt = "UPDATE departement SET id_region = '$rgn' WHERE nom_departement = '$departement' "; //lien du departement avec la région
							mysqli_query($con, $updatedpt);
						}
					}
					else if($dpt) //le dpt existe en BDD
					{
						$updatedpt = "UPDATE ville SET ville_departement = '$dpt' WHERE ville_id = '$vle' "; 
						mysqli_query($con, $updatedpt);
						if($region)
						{
							$selectpays = "SELECT id FROM pays WHERE nom_pays = '$pays' "; //selectionner pays_id
							$query = mysqli_query($con, $selectpays);
							$row = mysqli_fetch_array($query);
							$idpays = $row['id'];

							if(!$rgn)
							{
								$insertrgn = "INSERT INTO region (nom_region, id_pays) VALUES ('$region', '$idpays') "; //ajout de la région en BDD et lien de la région avec le pays
								mysqli_query($con, $insertrgn);
							}

							$query = mysqli_query($con, $idrgn);
							$row = mysqli_fetch_array($query);
							$rgn = $row['id'];
							$updatedpt = "UPDATE departement SET id_region = '$rgn' WHERE nom_departement = '$departement' "; //lien du departement avec la région
							mysqli_query($con, $updatedpt);
						}
						/*else if(!$region)
						{
							$xxx = "SELECT id FROM departement, ville WHERE ville_departement = numero AND id_region = id AND nom_ville = '$ville' ";
							$query = mysqli_query($con, $xxx);
							$row = mysqli_fetch_array($query);
							$yyy = $row['id'];
							if($yyy)
							{

							}
						}*/
					}
				}
				else if(!$departement)
				{
					if($region)
					{
						$selectpays = "SELECT id FROM pays WHERE nom_pays = '$pays' "; //selectionner pays_id
						$query = mysqli_query($con, $selectpays);
						$row = mysqli_fetch_array($query);
						$idpays = $row['id'];

						if(!$rgn)
						{
							$insertrgn = "INSERT INTO region (nom_region, id_pays) VALUES ('$region', '$idpays') "; //ajout de la région en BDD et lien de la région avec le pays
							mysqli_query($con, $insertrgn);
						}

						$query = mysqli_query($con, $idrgn);
						$row = mysqli_fetch_array($query);
						$rgn = $row['id'];

						$xxx = "SELECT ville_departement FROM ville WHERE nom_ville = '$ville'";
						$query = mysqli_query($con, $xxx);
						$row = mysqli_fetch_array($query);
						$yyy = $row['ville_departement'];

						$updatedpt = "UPDATE departement SET id_region = '$rgn' WHERE numero = '$yyy' "; //lien du departement avec la région
						mysqli_query($con, $updatedpt);
					}
					else if(!$region)
					{
						$xxx = "SELECT id FROM departement, ville WHERE ville_departement = numero AND id_region = id AND nom_ville = '$ville' ";
						$query = mysqli_query($con, $xxx);
						$row = mysqli_fetch_array($query);
						$yyy = $row['id'];
						if($yyy)
						{

						}
					}
				}
				if($cp)
				{
					$updatevle = "UPDATE ville SET ville_code_postal = '$cp' WHERE ville_id = '$vle' ";
				}
			}
		

			if($intext != $intextpost) //si il y a eu changement de lieu
			{
				if($intext == "ext")
				{
					if($ville != $villepost)
					{
						$vleid = "SELECT ville_id FROM ville WHERE nom_ville = '$ville'";
					}
					else
					{
						$vleid = "SELECT ville_id FROM ville WHERE nom_ville = '$villepost'";
					}
					$result = mysqli_query($con, $vleid);
					$row = mysqli_fetch_array($result);
					$idvle = $row['ville_id'];
					$sql = "INSERT INTO salle (id_ville, adresse, nom_ext, intext) VALUES ('$idvle', '$adresse', '$ext', 'ext')";
					mysqli_query($con, $sql);
					$sql = "UPDATE concert, salle SET fksalle = salle.id_salle WHERE salle.nom_ext = '$ext' AND ID_concert = '$idconcert'";
					mysqli_query($con, $sql);
				}
			}
			if($salle != $sallepost && $salle != NULL)
			{
				$testsalle = 1;
				$result = mysqli_query($con, "SELECT Nom_salle FROM salle WHERE nom_salle = '$salle'");
				$row_cnt = mysqli_num_rows($result);
				if($row_cnt<1) //si pas de ligne trouvée
				{
					$insertsalle = "INSERT INTO salle (nom_salle) VALUES ('$salle')";
					mysqli_query($con, $insertsalle);
				}
				/* Ferme le jeu de résultats */
				mysqli_free_result($result);
				$sqlsal = "UPDATE concert, salle SET fksalle = salle.id_salle WHERE salle.nom_salle = '$salle' AND ID_concert = '$idconcert'";
    			mysqli_query($con, $sqlsal);
			}
			else if($ext)
			{
				$testext = 1;
				$sqlext = "UPDATE concert, salle SET nom_ext = '$ext' WHERE salle.id_salle = concert.fksalle AND concert.id_concert = '$idconcert'";
				mysqli_query($con, $sqlext);
			}

			if($heure != $heurepost)
			{
				$sqlheu = "UPDATE concert SET heure = '$heure' WHERE ID_concert = $idconcert";
    			mysqli_query($con, $sqlheu);
			}
			if($ville != $villepost)
			{
				$testville = 1;
				if(!$ext)
				{
					if($testsalle == 1)
					{
						$sqlville = "UPDATE salle, ville SET id_ville = ville.ville_id WHERE salle.nom_salle = '$salle' AND ville.nom_ville = '$ville'";
	    				mysqli_query($con, $sqlville);
	    			}
	    			else if($testsalle == 0)
					{
						$sqlvilleex = "UPDATE salle, ville SET id_ville = ville.ville_id WHERE salle.nom_salle = '$sallepost' AND ville.nom_ville = '$ville'";
	    				mysqli_query($con, $sqlvilleex);
	    			}
    			}
    			else if($ext)
    			{
    				$sqlville = "UPDATE salle, ville SET id_ville = ville.ville_id WHERE salle.nom_ext = '$ext' AND ville.nom_ville = '$ville'";
    				mysqli_query($con, $sqlville);
    			}
			}
			if($cp != NULL)
			{
				$testcp = 1;
				if($testsalle == 1)
				{
					$sqlcp = "UPDATE salle SET CP = '$cp' WHERE Nom_salle = '$salle'";
    				mysqli_query($con, $sqlcp);
    			}
    			else if($testsalle == 0)
				{
					$sqlcpex = "UPDATE salle SET CP = '$cp' WHERE Nom_salle = '$sallepost'";
    				mysqli_query($con, $sqlcpex);
    			}
			}

			if($adresse != $adressepost)
			{
				$testadresse = 1;
				if($salle)
				{
					if($testsalle == 1)
					{
						$sqladr = "UPDATE salle SET adresse = '$adresse' WHERE Nom_salle = '$salle'";
	    				mysqli_query($con, $sqladr);
	    			}
	    			else if($testsalle == 0)
					{
						$sqladrex = "UPDATE salle SET adresse = '$adresse' WHERE Nom_salle = '$sallepost'";
	    				mysqli_query($con, $sqladrex);
	    			}
	    		}
	    		else
	    		{
	    			$sqladr = "UPDATE salle SET adresse = '$adresse' WHERE nom_ext = '$ext'";
	    			mysqli_query($con, $sqladr);
	    		}
			}
			else if($adresse == $adressepost && $salle != $sallepost)
			{
					if($testsalle == 1)
					{
						$sqladr = "UPDATE salle SET adresse = '$adresse' WHERE Nom_salle = '$salle'";
	    				mysqli_query($con, $sqladr);
	    			}
	    			else if($testsalle == 0)
					{
						$sqladrex = "UPDATE salle SET adresse = '$adresse' WHERE Nom_salle = '$sallepost'";
	    				mysqli_query($con, $sqladrex);
	    			}
			}

			if($fb != $fbpost)
			{
				$testfb = 1;
				$sqlfbu = "UPDATE concert SET lien_fb  = '$fb' WHERE  ID_concert = $idconcert";
    			mysqli_query($con, $sqlfbu);
			}
			if($ticket != $ticketpost)
			{
				$testticket = 1;
				$sqltic = "UPDATE concert SET lien_ticket = '$ticket' WHERE ID_concert = $idconcert";
    			mysqli_query($con, $sqltic);
			}
			
			$sql = "UPDATE concert SET user_modif = '$idpseudo', date_modif = NOW() WHERE id_concert = $idconcert";
    		mysqli_query($con, $sql);
	?>
		<h1> Récapitulatif du concert modifié </h1>
		<?php
	$str = "SELECT datec, heure, lien_fb, lien_ticket, concert.nom_artiste, id_salle, adresse, nom_salle, nom_ext, intext, nom_ville, ville_code_postal, ville_departement FROM concert, artiste, salle, ville WHERE concert.nom_artiste = artiste.Nom_artiste AND concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND id_concert = $idconcert";
			$result = mysqli_query($con, $str);
			$row = mysqli_fetch_array($result);
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
			<div id="concertsall">
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
										<a href="<?php echo  $row['lien_fb']; ?>"> Lien vers l'événement </a>
									</div> 
									<div class="ticket">
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
			</div>
			<div class="champs">
				<h2> Champ(s) modifié(s) : </h2>
				<a href="../allconcerts.php"> retour en arriere </a>
				<br>
				<?php
				if($date == $datepost)
				{
					//echo "1ok";
					if ($heure == $heurepost) 
					{
						//echo "2ok";
						if ($ville == $villepost) 
						{
							//echo "3ok";
							if ($testcp != 1) 
							{
								//echo "4ok";
								if ($testadresse != 1) 
								{
									//echo "5ok";
									if ($testfb != 1) 
									{
										//echo "6ok";
										if ($ticket == $ticketpost) 
										{
											//echo "7ok";
											if ($testsalle != 1) 
											{
												//echo "8ok";
												if ($ext == $extpost) 
												{
													//echo "9ok";
													//echo "<br>";
													//echo $intext;
													//echo "<br>";
													//echo $intextpost;
													if ($departement == $departementpost || $departement == NULL) 
													{
														//echo "10ok";
														if ($region == $regionpost || $region == NULL) 
														{
															//echo "11ok";
															if ($intext == $intextpost || $intext == NULL) 
															{
																setcookie('contentMessage', 'Erreur: aucun champ modifié', time() + 30, "/");
																header("Location: ./allconcerts.php");
																exit("Erreur: aucun champ modifié");
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}

				$sql = "INSERT INTO modification (id_concert, id_user, datetime) VALUES ('$idconcert', '$idpseudo', NOW())";
				mysqli_query($con, $sql);


				$sql = "SELECT MAX(id) AS id_max FROM modification"; //on recupere l'ID le plus haut 
  				$query = mysqli_query($con, $sql);
  				$row = mysqli_fetch_array($query);
				$idmodif = $row['id_max'];

				if($date != $datepost)
				{
					echo "date modifiée";
					echo '<br>';
					echo "ancienne valeur : ";
					echo $datepost;

					echo '<br>';
					echo "nouvelle valeur : ";
					echo $date;
					echo '<br>';
					echo '<br>';
					$sql = "UPDATE modification SET datec = '$date' WHERE id = $idmodif"; 
   					$query = mysqli_query($con, $sql);
				}
				if ($heure != $heurepost)
				{
					echo "heure modifiée";
					echo '<br>';
					echo "ancienne valeur : ";
					echo $heurepost;
					echo '<br>';
					echo "nouvelle valeur : ";
					echo $heure;
					echo '<br>';
					echo '<br>';
					$sql = "UPDATE modification SET heurec = '$heure' WHERE id = $idmodif"; 
   					$query = mysqli_query($con, $sql);
				}

				if($ville != $villepost)
				{
					if($ville != $modifville)
					{
						echo "ville modifiée";
						echo '<br>';
						echo "ancienne valeur : ";
						echo $villepost;
						echo '<br>';
						echo "nouvelle valeur : ";
						echo $ville;
						echo '<br>';
						echo '<br>';
						$sql = "UPDATE modification SET ville = '$ville' WHERE id = $idmodif"; 
	   					$query = mysqli_query($con, $sql);
	   				}
				}
				if($testcp == 1)
				{
					echo "code postal modifié";
					echo '<br>';
					echo "ancienne valeur : ";
					test_empty($cppost);
					echo "nouvelle valeur : ";
					echo $cp;
					echo '<br>';
					echo '<br>';
					$sql = "UPDATE modification SET code_postal = '$cp' WHERE id = $idmodif"; 
   					$query = mysqli_query($con, $sql);
				}	
				if($adresse != $adressepost)
				{
					if($adresse != $modifadresse)
					{
						echo "adresse modifiée";
						echo '<br>';
						echo "ancienne valeur : ";
						test_empty($adressepost);
						echo "nouvelle valeur : ";
						echo $adresse;
						echo '<br>';
						echo '<br>';
						$sql = "UPDATE modification SET adresse = '$adresse' WHERE id = $idmodif"; 
	   					$query = mysqli_query($con, $sql);
	   				}
				}
				if($testfb == 1)
				{
					echo "lien événement modifié";
					echo '<br>';
					echo "ancienne valeur : ";
					test_empty($fbpost);
					echo "nouvelle valeur : ";
					echo $fb;
					echo '<br>';
					echo '<br>';
					$sql = "UPDATE modification SET lien_fb = '$fb' WHERE id = $idmodif"; 
   					$query = mysqli_query($con, $sql);
				}
				if($ticket != $ticketpost)
				{
					echo "lien billetterie modifié";
					echo '<br>';
					echo "ancienne valeur : ";
					test_empty($ticketpost);
					echo "nouvelle valeur : ";
					echo $ticket;
					echo '<br>';
					echo '<br>';
					$sql = "UPDATE modification SET lien_ticket = '$ticket' WHERE id = $idmodif"; 
   					$query = mysqli_query($con, $sql);
				}				
				/*if($artiste != $artistepost)
				{
					echo "artiste modifié";
					echo '<br>';
					echo "ancienne valeur : ";
					echo $artistepost;
					echo '<br>';
					echo "nouvelle valeur : ";
					echo $artiste;
					echo '<br>';
					echo '<br>';
				}*/		
				if($testsalle == 1 && $salle != NULL)
				{
					if($intext)
					{
						echo "Salle ajoutée (passage d'exterieur à intérieur) ";
					}
					else
					{
						echo "salle modifiée";
						echo '<br>';
						echo "ancienne valeur : ";
						echo $sallepost;
					}
					echo '<br>';
					echo "nouvelle valeur : ";
					echo $salle;
					echo '<br>';
					echo '<br>';
					$sql = "UPDATE modification SET salle = '$salle' WHERE id = $idmodif"; 
   					$query = mysqli_query($con, $sql);
				}
				if($ext != $extpost && $ext != NULL)
				{
					if($intext)
					{
						echo "Denomination ajoutée (passage d'intérieur à exterieur) ";
					}
					else
					{
						echo "denomination modifiée";
						echo '<br>';
						echo "ancienne valeur : ";
						echo $extpost;
					}
					echo '<br>';
					echo "nouvelle valeur : ";
					echo $ext;
					echo '<br>';
					$sql = "UPDATE modification SET denomination = '$ext' WHERE id = $idmodif"; 
   					$query = mysqli_query($con, $sql);
				}
				if($intext != $intextpost && $intext != NULL)
				{
					/*if($intext == "int")
					{
						echo "passage du concert d'exterieur en interieur";
					}
					else
					{
						echo "passage du concert d'interieur en exterieur";
					}*/
					$sql = "UPDATE modification SET intext = '$intext' WHERE id = $idmodif"; 
   					$query = mysqli_query($con, $sql);
				}

				if($departement != $departementpost && $departement != NULL) //modification
				{
					if($departementpost == NULL) //ajout
					{
						echo "departement ajouté";
						echo '<br>';
						echo "nouvelle valeur : ";
						echo $departement;
						echo '<br>';
						echo '<br>';
					}
					else
					{
						echo "departement modifié";
						echo '<br>';
						echo "ancienne valeur : ";
						echo $departementpost;
						echo '<br>';
						echo "nouvelle valeur : ";
						echo $departement;
						echo '<br>';
						echo '<br>';
					}
					$sql = "UPDATE modification SET departement = '$departement' WHERE id = $idmodif"; 
   					$query = mysqli_query($con, $sql);
				}
				if($region != $regionpost && $region != NULL)
				{
					if($regionpost == NULL)
					{
						echo "région ajoutée";
						echo '<br>';
						echo "nouvelle valeur : ";
						echo $region;
					}
					else
					{
						echo "région modifiée";
						echo '<br>';
						echo "ancienne valeur : ";
						echo $regionpost;
						echo '<br>';
						echo "nouvelle valeur : ";
						echo $region;
					}
					echo '<br>';
					echo "pays associé : ";
					echo $pays;
					echo '<br>';
					echo '<br>';
					$sql = "UPDATE modification SET region = '$region', pays = '$pays' WHERE id = $idmodif"; 
   					$query = mysqli_query($con, $sql);
				}
				?>
			</div>
	</body>
	<!--<script type="text/javascript" src="./js/scrollnav.js"></script> -->
</html>

