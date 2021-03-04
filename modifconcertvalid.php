<!DOCTYPE html>
<html>
	<head>
		<title>Recap</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/concert.css" media="screen" />		
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
	</head>
	<header>
		<?php //include('header.php'); ?>
	</header>
	<body>
		<?php	      
			$servername = 'localhost';
			$username = 'root';
			$password = '';
			$dbname = 'webbd';
			//Connexion à la BDD
			$con = mysqli_connect($servername, $username, $password, $dbname);
			//Vérification de la connexion
			
			if(mysqli_connect_errno($con))
			{
				echo "Erreur de connexion" .mysqli_connect_error();
			}

			$idconcert = $_POST['idpost'];
			$intext = $_POST['intext'];
			$intextpost = $_POST['intextpost'];
			$artiste = $_POST['artiste'];
			$artistepost = $_POST['artistepost'];
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
			$adressepost = $_POST['adressepost'];
			$testadresse = 0;
			$fb = $_POST['fb'];
			$fbpost = $_POST['fbpost'];
			$testfb = 0;
			$ticket = $_POST['ticket'];
			$ticketpost = $_POST['ticketpost'];
			$testticket = 0;
			echo($intext);
			echo('<br>');
			echo($intextpost);
			echo('<br>');
			echo($salle);
			echo('<br>');
			

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
					if($ville)
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
			if($salle)
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
			if($date != $datepost)
			{
				$testdate = 1;
				$sqldat = "UPDATE concert SET datec = '$date' WHERE ID_concert = $idconcert";
    			mysqli_query($con, $sqldat);
			}
			if($heure != $heurepost)
			{
				$testheure = 1;
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
			if($adresse != NULL)
			{
				$testadresse = 1;
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
			if($fb != NULL)
			{
				$testfb = 1;
				$sqlfbu = "UPDATE concert SET lien_fb  = '$fb' WHERE  ID_concert = $idconcert";
    			mysqli_query($con, $sqlfbu);
			}
			if($ticket != NULL)
			{
				$testticket = 1;
				$sqltic = "UPDATE concert SET lien_ticket = '$ticket' WHERE ID_concert = $idconcert";
    			mysqli_query($con, $sqltic);
			}

			if ($artiste != NULL)
			{
				$testartiste = 1;
				$result = mysqli_query($con, "SELECT Nom_artiste FROM artiste WHERE Nom_artiste = '$artiste'");
				$row_cnt = mysqli_num_rows($result);
				if($row_cnt<1) //si pas de ligne trouvée
				{
					$insertartiste = "INSERT INTO artiste VALUES ('$artiste')";
					mysqli_query($con, $insertartiste);
				}
				/* Ferme le jeu de résultats */
				mysqli_free_result($result);
				$sqlart = "UPDATE concert SET Nom_artiste = '$artiste' WHERE ID_concert = $idconcert";
    			mysqli_query($con, $sqlart);	
			}

	?>
		<h1> Récapitulatif du concert modifié </h1>
		<?php
	$str = "SELECT id_concert, datec, heure, lien_fb, lien_ticket, concert.nom_artiste, adresse, nom_salle, nom_ext, intext, nom_ville, ville_code_postal, nom_departement, nom_region, nom_pays FROM concert, artiste, salle, ville, departement, region, pays WHERE concert.nom_artiste = artiste.Nom_artiste AND concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND ville.ville_departement = departement.numero AND departement.id_region = region.id AND region.id_pays = pays.id AND id_concert = $idconcert";
			$result = mysqli_query($con, $str);
			$row = mysqli_fetch_array($result);
			?>
			<div id="concertsall">
				<div class="inwhile"> 
						<div class="artiste"> <?php echo $row['nom_artiste'] ?> </div> 
							<div class="dahe">Date et heure</div>
						<div class="date"> <?php echo  $row['datec'] ?> </div>  
						<div class="heure"> <?php echo $row['heure'] ?> </div>  
							<div class="pacp">Pays ville et CP</div>
						<div class="pays"> <?php echo  $row['nom_pays'] ?> </div> 
						<div class="region"> <?php echo  $row['nom_region'] ?> </div> 
						<div class="departement"> <?php echo  $row['nom_departement'] ?> </div> 
						<div class="ville"> <?php echo $row['nom_ville'] ?> </div> 
						<div class="cp"> <?php echo  $row['ville_code_postal'] ?> </div>
						<?php
						if($row['intext'] == 'int')
						{
						?>
							<div class="saad">Salle et adresse</div> 
							<br>
							Concert intérieur
							<br>
						<div class="salle"> <?php echo  $row['nom_salle'] ?> </div> 
						<?php
						} 
						else
						{
						?>
							<div class="saad">Lieu et adresse</div> 
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

				</div>			
			</div>
			<div class="champs">
				<h2> Champ(s) modifié(s) : </h2>
				<a href="allconcerts.php"> retour en arriere </a>
				<br>
				<?php
				if($testdate == 1)
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
				}
				if ($testheure == 1)
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
				}
				if($testpays == 1)
				{
					echo "pays modifié";
					echo '<br>';
					echo "ancienne valeur : ";
					echo $payspost;
					echo '<br>';
					echo "nouvelle valeur : ";
					echo $pays;
					echo '<br>';
					echo '<br>';
				}
				if($testregion == 1)
				{
					echo "région modifiée";
					echo '<br>';
					echo "ancienne valeur : ";
					echo $regionpost;
					echo '<br>';
					echo "nouvelle valeur : ";
					echo $region;
					echo '<br>';
					echo '<br>';
				}
				if($testdepartement == 1)
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
				if($testville == 1)
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
				}
				if($testcp == 1)
				{
					echo "code postal modifié";
					echo '<br>';
					echo "ancienne valeur : ";
					echo $cppost;
					echo '<br>';
					echo "nouvelle valeur : ";
					echo $cp;
					echo '<br>';
					echo '<br>';
				}	
				if($testadresse == 1)
				{
					echo "adresse modifiée";
					echo '<br>';
					echo "ancienne valeur : ";
					echo $adressepost;
					echo '<br>';
					echo "nouvelle valeur : ";
					echo $adresse;
					echo '<br>';
					echo '<br>';
				}
				if($testfb == 1)
				{
					echo "lien événement modifié";
					echo '<br>';
					echo "ancienne valeur : ";
					echo $fbpost;
					echo '<br>';
					echo "nouvelle valeur : ";
					echo $fb;
					echo '<br>';
					echo '<br>';
				}
				if($testticket == 1)
				{
					echo "lien billetterie modifié";
					echo '<br>';
					echo "ancienne valeur : ";
					echo $ticketpost;
					echo '<br>';
					echo "nouvelle valeur : ";
					echo $ticket;
					echo '<br>';
					echo '<br>';
				}				
				if($artiste != $artistepost)
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
				}				
				if($testsalle == 1)
				{
					echo "salle modifiée";
					echo '<br>';
					echo "ancienne valeur : ";
					echo $sallepost;
					echo '<br>';
					echo "nouvelle valeur : ";
					echo $salle;
					echo '<br>';
				}
				if($ext != $extpost)
				{
					echo "lieu modifié";
					echo '<br>';
					echo "ancienne valeur : ";
					echo $extpost;
					echo '<br>';
					echo "nouvelle valeur : ";
					echo $ext;
					echo '<br>';
				}
				if($intext)
				{
					if($intext == "int")
					{
						echo "passage du concert d'exterieur en interieur";
					}
					else
					{
						echo "passage du concert d'interieur en exterieur";
					}
				}
				?>
			</div>
	</body>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>

