<?php
/*
	Type fichier : php
	Fonction : supprimer, valider ou modifier un concert
	Emplacement : /
	Connexion à la BDD : oui
	Contenu HTML : oui
	JS+JQuery : oui
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

			$idconcert = $_POST['idpost'];

			require ('php/inject.php'); //0) ajouter inject et définir redirect
			$redirect = 'allconcerts.php';

			$inject = array(); 
			$returnval = inject($idconcert, 'identifier'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
			if (!is_null($returnval)) 
			{
			  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
			}
			$validate = validate($inject, $redirect); //3)validation de tous les champs
			if($validate == 0) //4) si pas d'injection : ajout des variables
			{
			  $idconcert = mysqli_real_escape_string($con, $idconcert); 
			}
			$action = $_POST['modsuppr'];
			if ($action != 'Valider' && $action != 'Supprimer' && $action != 'Modifier' && $action != 'probleme') 
			{
				if($action)
				{
					setcookie('contentMessage', 'Erreur inconnue, merci de contacter le support', time() + 15, "/");
					header("Location: allconcerts.php");
					exit("Erreur inconnue, merci de contacter le support");
				}
			}
		?>
		<script src="js/verifmodifconcert.js"></script> 
		
		<link rel="stylesheet" type="text/css" href="css/body/modifconcert.css">
	</head>
	<body>
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<?php include 'contenu/reseaux.php'; ?>
		<div id="main">
			<?php	      
			
			$idsalle = $_POST['idsallepost'];
			$indices = $_POST['indices'];

			for ($i=0; $i < $indices; $i++) //on va de 0 au nombre d'artistes ajoutés
			{ 
				$postartiste = 'artistepost' . $i;
				$artiste[$i] = $_POST[$postartiste]; //on range dans un tableau qui contiendra la liste des artistes
			}

			$date = $_POST['datepost'];
			$heure = $_POST['heurepost'];
			$pays = $_POST['payspost'];
			$region = $_POST['regionpost'];
			$departement = $_POST['departementpost'];
			$ville = $_POST['villepost'];
			$cp = $_POST['cppost'];
			$salle = $_POST['sallepost'];
			$ext = $_POST['extpost'];
			$intext = $_POST['intextpost'];
			$adresse = $_POST['adressepost'];
			$fb = $_POST['fbpost'];
			$ticket = $_POST['ticketpost'];
			$pseudo = $_SESSION['pseudo'];

			
			$heure = str_replace(":00", "", "$heure");

			$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$testadmin = $row['admin'];

			$sql = "SELECT valide FROM concert WHERE id_concert = '$idconcert'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$valide = $row['valide'];
			
			if(isset($_SESSION['pseudo']) == null)
			{
				if($action == 'Supprimer' || $action == 'Valider')
				{
					setcookie('contentMessage', 'Erreur: cette action est réservée aux administrateurs', time() + 15, "/");
					header("Location: allconcerts.php");
					exit("Erreur: cette action est réservée aux administrateurs");
				}
				else if($action == 'Modifier')
				{
					setcookie('contentMessage', 'Erreur: vous devez être connectés afin de pouvoir modifier un concert', time() + 15, "/");
					header("Location: allconcerts.php");
					exit("Erreur: vous devez être connectés afin de pouvoir modifier un concert");
				}
				else
				{
					setcookie('contentMessage', 'Erreur inconnue, merci de contacter le support', time() + 15, "/");
					header("Location: allconcerts.php");
					exit("Erreur inconnue, merci de contacter le support");
				}
			}
			else if($testadmin < 1 AND $action == 'Valider' || $action == 'Supprimer')
			{
				setcookie('contentMessage', 'Erreur: cette action est réservée aux administrateurs', time() + 15, "/");
				header("Location: allconcerts.php");
				exit("Erreur: cette action est réservée aux administrateurs");
			}
			else
			{
				if($action == 'Modifier')
				{
					if($valide == 1 && $testadmin < 1)
					{
						setcookie('contentMessage', 'Erreur: il est interdit de modifier un concert validé', time() + 15, "/");
						header("Location: allconcerts.php");
						exit("Erreur: il est interdit de modifier un concert validé");
					}
					?>
					<form method="post" id="connect" action="modifconcertvalid.php">
						<h1 class="titre"> Modifier un concert </h1>
						<div id="artistediv">
							<label for="artiste">Nom de l'artiste ou du groupe<span class="star">*</span></label>
							<?php
							for ($i=0; $i < $indices; $i++) //on va de 0 au nombre d'artistes ajoutés
							{ 
							?>
								<div <?php if($i == 0){echo 'class="art';}else{echo 'class="artisteadddiv';} echo ' artisteadddiv' . $i .'"';?>>
									<?php
									if ($i == 0) 
									{
										?>
										<input type="text" <?php echo 'name="artiste' . $i . '"';?> onkeyup="getdata(this.id);" <?php echo 'value="' . $artiste[$i] . '"'; echo 'class="artiste"'; echo 'id="row' . $i . '"';?>>
										<button type="button" name="add" id="add">Artiste supplémentaire</button>
										<input type="hidden" id=indicepost name=indicepost <?php echo 'value="' . $indices . '"'; ?> ><?php
										for ($j=0; $j < $indices; $j++) 
										{ ?>
											<input type="hidden" <?php echo 'class="artistepost' . $j . '"'; echo 'name="artistepost' . $j . '"'; echo 'value="' . $artiste[$j] . '"'; ?> >
											<?php
										}
									}
									else {?>
										<input type="text" <?php echo 'name="artiste' . $i . '"';?> onkeyup="getdata(this.id);" <?php echo 'value="' . $artiste[$i] . '"'; echo 'class="artisteadd ui-autocomplete-input"'; echo 'id="row' . $i . '"';?>><button type="button" name="remove" <?php  echo 'id="' . $i . '"';?> class="btn btn-danger btn_remove">X</button>
									<?php
									}?>
								</div>
							<?php
							}?>	
							
						</div>
						<div id="dateheure">
							<div id="datediv">
								<label for="date">Date<span class="star">*</span></label> 
								<input type="date" name="date" <?php echo 'value="' . $date . '"' ?> id="date">
								<input type="hidden" id="datepost" name="datepost" <?php echo 'value="' . $date . '"' ?> >
							</div>
							<div id="heurediv">
								<label for="heure">Heure <?php if($lang == 'en')
								{
									echo ' (mm:hh AM/PM)';
								}?></label> 
								<input type="time" name="heure" <?php echo 'value="' . $heure . '"' ?>  id="heure">
								<input type="hidden" id="heurepost" name="heurepost" <?php echo 'value="' . $heure . '"' ?> >
							</div>
						</div>
						<div id="extint"> 
							<label> Lieu du concert<span class="star">*</span></label>
							<?php
							if($intext == 'int')
							{
								?>
								<div id="extintcontent">
									<div>
										<input type="checkbox" id="int" name="int" onclick="checkboxmodif(this.id);" checked disabled>
										en intérieur (salle)
									</div>
									<div>
										<input type="checkbox" id="ext" name="ext" onclick="checkboxmodif(this.id);"> 
										en extérieur (festival, concert sauvage, rue etc...)
									</div>
								</div>
								<div id="intdiv">
									<label for="salle">Salle<span class="star">*</span></label> 
									<input type="text" name="salle" id="salle" onblur="getleave(this.id);" onkeyup="getdata(this.id);" <?php echo 'value="' . $salle . '"' ?> required>
									<div class="res"> </div>
									<input type="hidden" id="sallepost" name="sallepost" <?php echo 'value="' . $salle . '"' ?>>
								</div>
								<div id="exthiddiv">
									<label for="ext">Denomination<span class="star">*</span></label> 
									<input type="text" name="extval" id="extval" <?php echo 'value="' . $ext . '"' ?> >
									<div class="res"> </div>
									<input type="hidden" id="extpost" name="extpost" value=""> 
								</div>
								<?php
							}
							else
							{
								?>	
								<div id="extintcontent">
									<div>
										<input type="checkbox" id="int" name="int" onclick="checkboxmodif(this.id);"> 
										en intérieur (salle)
									</div>
									<div>
										<input type="checkbox" id="ext" name="ext" onclick="checkboxmodif(this.id);" checked disabled> 
										en extérieur (festival, concert sauvage, rue etc...)
									</div>
								</div>
								<div id="extdiv">
									<label for="ext">Denomination<span class="star">*</span></label> 
									<input type="text" name="extval" id="extval" <?php echo 'value="' . $ext . '"' ?> required>
									<div class="res"> </div>
									<input type="hidden" id="extpost" name="extpost" <?php echo 'value="' . $ext . '"' ?>> 
								</div>
								<div id="inthiddiv">
									<label for="salle">Salle<span class="star">*</span></label> 
									<input type="text" name="salle" id="salle" onblur="getleave(this.id);" onkeyup="getdata(this.id);" <?php echo 'value="' . $salle . '"' ?> >
									<div class="res"> </div>
									<input type="hidden" id="sallepost" name="sallepost" value=""> 
								</div>
								<?php
							}
							?>
						</div>
						<div id="infos">
							<div id="adressdiv">
								<label for="adresse">Adresse </label> 
								<input type="text" name="adresse" <?php echo 'value="' . $adresse . '"' ?> id="adresse">
								<input type="hidden" id="adressepost" name="adressepost" <?php echo 'value="' . $adresse . '"' ?> >
							</div>
							<div id="villediv">
								<label for="ville">Ville<span class="star">*</span></label> 
								<input type="text" name="ville" onblur="getleave(this.id);" onkeyup="getdata(this.id);" <?php echo 'value="' . $ville . '"' ?> id="ville">
							</div>
							<div id="cpdiv">
								<label for="cp">Code postal </label> 
								<?php
								if($cp)
								{
									?>
									<input type="text" name="cp" <?php echo 'placeholder="' . $cp . '"' ?> id="cp" disabled>
									<?php
								}
								else
								{
									?>
									<input type="text" name="cp" placeholder="CP non renseigné pour cette ville" id="cp">
									<?php
								}?>
								<input type="hidden" id="cppost" name="cppost" <?php echo 'value="' . $cp . '"' ?> >
							</div>
							<div id="departementdiv">
								<label for="departement">Département </label>
								<?php
								if($departement)
								{ 
									?>
									<input type="text" name="departement" onblur="getleave(this.id);" onkeyup="getdata(this.id);" <?php echo 'placeholder="' . $departement . '"' ?> id="departement" disabled>
									<?php
								}
								else
								{
									?>
									<input type="text" name="departement" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="departement non renseigne" id="departement">
									<?php
								}
								?>
								<input type="hidden" id="departementpost" name="departementpost" <?php echo 'value="' . $departement . '"' ?> > 
							</div>
							<div id="regiondiv">
								<label for="region">Région </label>
								<?php
								if($region) //region + departement
								{ 
									?>
									<input type="text" name="region" onblur="getleave(this.id);" onkeyup="getdata(this.id);" <?php echo 'placeholder="' . $region . '"' ?> id="region" disabled>							 
									<?php	
									$paystest = 1;
								}
								else if($departement && !$region) //seulement le departement
								{
									?>
									<input type="text" name="region" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="région non renseignée" id="region" >
									<label for="pays">Pays </label> 
									<input type="text" name="pays" onkeyup="getdata(this.id);" placeholder="pays non renseignée" id="pays" disabled="">
									<?php
									$paystest = 0;
								}
								else //ni region ni departement
								{
									?>
									<input type="text" name="region" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="région non renseignée" id="region" disabled>							 
									<?php
									$paystest = 0;
								}
								?>
							</div>
							<div id="paysdiv">
								<label for="pays">Pays </label> 
								<?php
								if ($paystest == 1) 
								{?>
									<input type="text" name="pays" onkeyup="getdata(this.id);" <?php echo 'placeholder="' . $pays . '"' ?> id="pays" disabled>
									<?php
								}
								else
								{?>
									<input type="text" name="pays" onkeyup="getdata(this.id);" placeholder="pays non renseignée" id="pays" disabled>
									<?php
								}?>
							</div>	
						</div>
						<input type="hidden" id="regionpost" name="regionpost" <?php echo 'value="' . $region . '"' ?> >
						<input type="hidden" id="payspost" name="payspost" <?php echo 'value="' . $pays . '"' ?>> 
						
						<label for="fb">Lien de l'evenement (facebook ou autres) </label> 
						<input type="text" name="fb" <?php echo 'value="' . $fb . '"' ?> id="fb">
						<input type="hidden" id="fbpost" name="fbpost" <?php echo 'value="' . $fb . '"' ?> > 

						<label for="ticket">Lien de la billetterie </label> 
						<input type="text" name="ticket" <?php echo 'value="' . $ticket . '"' ?> id="ticket">
						<input type="hidden" id="ticketpost" name="ticketpost" <?php echo 'value="' . $ticket . '"' ?> > 

						<input type="hidden" id="idpost" name="idpost" <?php echo 'value="' . $idconcert . '"' ?> > 
						<input type="hidden" id="intextpost" name="intextpost" <?php echo 'value="' . $intext . '"' ?> > 
						<input type="hidden" id="intext" name="intext" value=""> 
						<input type="hidden" id="villepost" name="villepost" <?php echo 'value="' . $ville . '"' ?> >

						<input type="hidden" value="" name="indice" id="indice">
						<div id="submit">
							<input type="button" value="Enregister le concert" id="valider" name="concert">
							<input type="button" value="Reinitialiser le formulaire" id="reinitialiser" onclick="reinitForm()">
							<input type="button" value="Effacer tous les champs" onclick="erase();">
    						<input type="button" value="Annuler" onclick="redirect();">
						</div>
						<input type="hidden" id="resetform">
					</form>
				<?php
				}
				else if($action == 'Supprimer')
				{
					$sql = "DELETE FROM concert WHERE id_concert = '$idconcert'"; 
					mysqli_query($con, $sql);
					$sql = "DELETE FROM artistes_concert WHERE id_concert = '$idconcert'";
					mysqli_query($con, $sql);
					?>Concert supprimé avec succès 
					<br>
					<a href="allconcerts.php"> retour en arriere </a>
					<?php
				}
				else if($action == 'Valider')
				{
					$testmodif = 0;

					$sql = "SELECT user_ajout FROM concert WHERE id_concert = '$idconcert'";
					$query = mysqli_query($con, $sql);
  					$row = mysqli_fetch_array($query);
					$userajout = $row['user_ajout']; //personne qui a ajouté le concert

					$sql = "SELECT pseudo FROM utilisateur WHERE ID_user = '$userajout'";
					$query = mysqli_query($con, $sql);
  					$row = mysqli_fetch_array($query);
					$pseudoajout = $row['pseudo'];

					$sql = "SELECT points_session, points FROM utilisateur WHERE ID_user = '$userajout'";
					$query = mysqli_query($con, $sql);
  					$row = mysqli_fetch_array($query);
					$pointssession = $row['points_session'];
					$points = $row['points'];

					$sql = "SELECT datec, heure, intext, nom_salle, nom_ext, adresse, ville_nom_reel, ville_code_postal, nom_departement, nom_region, nom_pays, lien_fb, lien_ticket FROM concert, salle, ville, departement, region, pays, artistes_concert WHERE  concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND ville.ville_departement = departement.numero AND departement.id_region = region.id AND region.id_pays = pays.id AND artistes_concert.id_concert = concert.id_concert AND concert.id_concert = '$idconcert'";
					$queryall = mysqli_query($con, $sql);
					$rowx = mysqli_fetch_array($queryall);

					$sqlart = "SELECT nom_artiste FROM artistes_concert, concert WHERE artistes_concert.id_concert = concert.id_concert AND concert.id_concert = '$idconcert'";
					

					$sql = "SELECT * FROM modification WHERE id_concert = '$idconcert'";
					$querymodif = mysqli_query($con, $sql);
					
					while($row = mysqli_fetch_array($querymodif)) //on parcourt toutes les modifications pour le concert donné
					{
						$idpseudo = $row['id_user'];
						$idmodif = $row['id'];

						$sqlmodif = "SELECT pseudo FROM utilisateur WHERE ID_user = '$idpseudo'";
						$querymodifpseudo = mysqli_query($con, $sqlmodif);
	  					$rowmodif = mysqli_fetch_array($querymodifpseudo);
						$pseudomodif = $rowmodif['pseudo'];

						$sqlpts = "SELECT points_session, points FROM utilisateur WHERE ID_user = '$idpseudo'";
						$querypts = mysqli_query($con, $sqlpts);
	  					$rowpts = mysqli_fetch_array($querypts);
						$pointssession = $rowpts['points_session'];
						$points = $rowpts['points'];
						$pointscalcul = $pointssession;

						$sqlartmodif = "SELECT nom_artiste FROM artistes_modification WHERE id_modification = '$idmodif'";
						$queryartmodif = mysqli_query($con, $sqlartmodif);

						if($idpseudo != $userajout)
						{
							while($rowartmodif = mysqli_fetch_array($queryartmodif)) //on parcourt 
							{
								$queryart = mysqli_query($con, $sqlart); //on recupere les artistes de ce concert
								while($rowart = mysqli_fetch_array($queryart))
								{
									if($rowartmodif['nom_artiste'] == $rowart['nom_artiste'])
									{
										$pointssession = $pointssession + 1;
										$points = $points + 1;
										echo "1 point artiste ";
									}
								}
							}
							if($rowx['datec'] == $row['datec'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
								echo "1 point date";
								echo "<br>";
							}
							if($rowx['heure'] == $row['heurec'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
								echo "1 point heure";
								echo "<br>";
							}
							if($rowx['intext'] == $row['intext'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
								echo "1 point intext";
								echo "<br>";
							}
							if($rowx['nom_salle'] && $rowx['nom_salle'] == $row['salle'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
								echo "1 point nom_salle";
								echo "<br>";
							}
							if($rowx['nom_ext'] && $rowx['nom_ext'] == $row['denomination'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
								echo "1 point nom_ext";
								echo "<br>";
							}
							if($rowx['adresse'] && $rowx['adresse'] == $row['adresse'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
								echo "1 point adresse";
								echo "<br>";
							}
							if($rowx['ville_nom_reel'] == $row['ville'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
								echo "1 point ville_nom_reel";
								echo "<br>";
							}
							if($rowx['ville_code_postal'] == $row['code_postal'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
								echo "1 point ville_code_postal";
								echo "<br>";
							}
							if($rowx['nom_departement'] == $row['departement'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
								echo "1 point nom_departement";
								echo "<br>";
							}
							if($rowx['nom_region'] == $row['region'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
								echo "1 point nom_region";
								echo "<br>";
							}
							if($rowx['nom_pays'] == $row['pays'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
								echo "1 point nom_pays";
								echo "<br>";
							}
							if($rowx['lien_fb'] == $row['lien_fb'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
								echo "1 point lien_fb";
								echo "<br>";
							}
							if($rowx['lien_ticket'] == $row['lien_ticket'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
								echo "1 point lien_ticket";
								echo "<br>";
							}
						}

						$sql = "UPDATE utilisateur SET points_session = '$pointssession', points = '$points' WHERE ID_user = '$idpseudo'";
						$queryinspts = mysqli_query($con, $sql);

						$pointscalcul = $pointssession - $pointscalcul;
						if ($pointscalcul > 0) 
						{
							echo $pointscalcul;
							echo " point(s) de modification attribué(s) à : ";
							echo $pseudomodif;
							echo "<br>";
							$testmodif = 1;
						}
					}

					if($testmodif == 0)
					{
						$pointssession = $pointssession + 5;
						$points = $points + 5;
					}
					else
					{
						$pointssession = $pointssession + 3;
						$points = $points + 3;
					}

					$sql = "UPDATE utilisateur SET points_session = '$pointssession', points = '$points' WHERE ID_user = '$userajout'";
					$query = mysqli_query($con, $sql);

					if($testmodif == 0)
					{
						echo "5 points d'ajout crédités à : ";
					}
					else
					{
						echo "3 points d'ajout crédités à : ";
					}
					echo $pseudoajout;
					echo "<br>";

					$sql = "UPDATE concert SET valide = '1' WHERE concert.id_concert = '$idconcert'";
					$queryvld = mysqli_query($con, $sql);

					?><a href="allconcerts.php"> retour en arriere </a><?php
				}
				else if($action == 'probleme')
				{?>
					<div id="probleme">
						<h1>Signaler une erreur</h1>
						<form action="action/erreursubmit.php" method="post" id="problemeform">
							<div id="raison">
								<label> Sur quel(s) champ(s) pensez-vous qu'il y a erreur ? <span class="star">*</span></label>
								<div id="champspb">
									<span>
										<input type="checkbox" name="artiste" value="artiste">
										<label for="artiste">artiste</label>
									</span>
									<span>
										<input type="checkbox" name="date" value="date">
										<label for="date">date</label>
									</span>
									<span>
										<input type="checkbox"  name="heure" value="heure">
										<label for="heure">heure</label>
									</span>
									<span>
										<input type="checkbox" name="salle" value="salle/denomination">
										<label for="salle">salle</label>
									</span>
									<span>
										<input type="checkbox" name="ville" value="ville">
										<label for="ville">ville</label>
									</span>
									<span>
										<input type="checkbox" name="cp" value="code_postal">
										<label for="cp">code_postal</label>
									</span>
									<span>
										<input type="checkbox" name="departement" value="departement">
										<label for="departement">departement</label>
									</span>
									<span>
										<input type="checkbox"  name="region" value="region">
										<label for="region">region</label>
									</span>
									<span>
										<input type="checkbox" name="pays" value="pays">
										<label for="pays">pays</label>
									</span>
									<span>
										<input type="checkbox" name="adresse" value="adresse">
										<label for="adresse">adresse</label>
									</span>
									<span>
										<input type="checkbox" name="lien_fb" value="lien de l'evenement">
										<label for="lien_fb">lien de l'evenement</label>
									</span>
									<span>
										<input type="checkbox" name="lien_ticket" value="lien vers la billetterie">
										<label for="lien_ticket">lien vers la billetterie</label>
									</span>
									<span>
										<input type="checkbox" name="autre" value="autre chose">
										<label for="autre">autre</label>
									</span>
								</div>
							</div>

							<fieldset>
								<legend>Problème rencontré</legend>
								<label class="content" for="sujet"> Objet <span class="star">*</span> </label><br />
								<input type="text" name="sujet" id="sujet" required>

								<label class="content" for="probleme">Quelle(s) correction(s) souhaiteriez-vous apporter ? <span class="star">*</span></label><br />
								<textarea name="probleme" id="probleme" cols="40" rows="5" required></textarea>
							</fieldset>

							<input type="hidden" id="idconcert" name="idconcert" <?php echo 'value="' . $idconcert . '"' ?>>
							<input type="hidden" id="pseudo" name="pseudo" <?php echo 'value="' . $_SESSION['pseudo'] . '"' ?>>
							<input type="hidden" id="type" name="type" value="1"> 
							<div id="enregistrer">
								<input type="submit" value="Envoyer" id="send">
							</div>
						</form>
					</div>
					<?php
				}
			}
			?>
		</div>
		<?php include('contenu/footer.html'); ?>
		<script>
			$(document).ready(function(){  
				var i = "<?php echo $indices-1; ?>"; //recupérer la valeur du nb d'artistes qu'il y a
				$('#add').click(function(){  //lors du click sur ajoutartiste
					i++;  
					$('#artistediv').append('<div class="artisteadddiv artisteadddiv'+i+'"><input type="text" id="row'+i+'" class="artisteadd" name="artiste'+i+'" placeholder="Saisir artiste" onkeyup="getdata(this.id);" required><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div>');  //ajout d'un champ
				});
			
				$(document).on('click', '.btn_remove', function(){  
						var button_id = $(this).attr("id");
						$('.artisteadddiv'+button_id+'').remove();
						$('#row'+button_id+'').remove();
						$('#'+button_id+'').remove();
					});
				$('#valider').click(function(){
					$("#indice").val('');
					for (let index = 0; index <= i; index++){ //on va du premier champ ajouté au dernier
					//soccuper de artistepost en verifiant si champ hidden
						if($("#row" + index).length>0) //si ce champ existe (non supprimé)
						{
							if($("#row" + index).val().length > 0) //s'il contient du texte
							{
								valindice = $("#indice").val();

								valindice = valindice + index;
								$("#indice").val(valindice); //on met les indices dans valindice
							}
						}
					}
					$("#valider").attr("type", "submit");
					$("#valider").trigger('click');
				});
			});

			function reinitForm()
			{
				checkavant = 0;
				checkapres = 0;

				if($('input[name=int]').is(':checked')) //si concert intérieur
				{
					check = 1;
				}
				else if ($('input[name=ext]').is(':checked')) //si concert exterieur
				{
					check = 2;
				}
				$("#resetform").attr("type", "reset");
				$("#resetform").trigger('click');
				$("#resetform").attr("type", "hidden");
				if($('input[name=int]').is(':checked'))
				{
					checkapres = 1;
				}
				else if ($('input[name=ext]').is(':checked')) 
				{
					checkapres = 2;
				}

				if(checkavant != checkapres)
				{
					if(checkapres == 1)
					{
						$("#int").trigger('click');
					}
					else if(checkapres == 2)
					{
						$("#ext").trigger('click');
					}
				}
				$( "#ville" ).blur();
				$(".btn_remove").trigger('click');
				
				var nbindices = "<?php echo $indices; ?>";
				var jqueryarray = <?php echo json_encode($artiste); ?>;

				for (let index = 1; index < nbindices; index++) 
				{
					$('#artistediv').append('<div class="artisteadddiv artisteadddiv'+index+'"><input type="text" id="row'+index+'" class="artisteadd" name="artiste'+index+'" value="'+jqueryarray[index]+'" onkeyup="getdata(this.id);" required><button type="button" name="remove" id="'+index+'" class="btn btn-danger btn_remove">X</button></div>');  //ajout d'un champ
				}
			}

			function erase()
			{
				$(':input')
				.not(':button, :submit, :reset, :hidden')
				.val('')
				.attr("placeholder", "")
				.prop('checked', false)
				.prop('selected', false);
			}
		</script>
	</body>
</html>




