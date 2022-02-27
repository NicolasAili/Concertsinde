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
			include 'contenu/reseaux.php';

			require ('php/inject.php'); //0) ajouter inject et définir redirect
			$redirect = 'allconcerts.php';


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

			$values = array($salle, $sallepost, $ville, $villepost, $departement, $region, $ext, $pays); //1) mettre données dans un arrray
			$inject = inject($values, null); //2) les vérifier

			$returnval = inject($idconcert, 'identifier'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
			if (!is_null($returnval)) 
			{
			  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
			}
			$returnval = inject($adresse, 'text'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
			if (!is_null($returnval)) 
			{
			  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
			}
			$returnval = inject($fb, 'url'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
			if (!is_null($returnval)) 
			{
			  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
			}
			$returnval = inject($ticket, 'url'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
			if (!is_null($returnval)) 
			{
			  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
			}
			$returnval = inject($cp, 'num'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
			if (!is_null($returnval)) 
			{
			  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
			}
			$returnval = inject($date, 'date'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
			if (!is_null($returnval)) 
			{
			  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
			}
			$returnval = inject($heure, 'heure'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
			if (!is_null($returnval)) 
			{
			  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
			}

			$validate = validate($inject, $redirect); //3)validation de tous les champs
			if ($intext != 'int' && $intext != 'ext' && $intext != '') 
			{
				setcookie('contentMessage', 'Erreur: le concert doit être à l\'intérieur ou à l\'extérieur', time() + 15, "/");
		    	header("Location: $redirect");
		    	exit("Erreur: le concert doit être à l\'intérieur ou à l\'extérieur'");
			}
			if($validate == 0) //4) si pas d'injection : ajout des variables
			{
			  $salle = mysqli_real_escape_string($con, $salle);
			  $sallepost = mysqli_real_escape_string($con, $sallepost); 
			  $ville = mysqli_real_escape_string($con, $ville); 
			  $villepost = mysqli_real_escape_string($con, $villepost); 
			  $departement = mysqli_real_escape_string($con, $departement); 
			  $region = mysqli_real_escape_string($con, $region); 
			  $ext = mysqli_real_escape_string($con, $ext); 
			  $pays = mysqli_real_escape_string($con, $pays); 
			  $idconcert = mysqli_real_escape_string($con, $idconcert); 
			  $adresse = mysqli_real_escape_string($con, $adresse); 
			  $fb = mysqli_real_escape_string($con, $fb); 
			  $ticket = mysqli_real_escape_string($con, $ticket); 
			  $cp = mysqli_real_escape_string($con, $cp); 
			  $date = mysqli_real_escape_string($con, $date); 
			  $heure = mysqli_real_escape_string($con, $heure); 
			}
		?>
		<link rel="stylesheet" type="text/css" href="css/body/modifconcertvalid.css">
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

		$pseudo = $_SESSION['pseudo'];

		if($_POST['artiste'])
		{
			setcookie('contentMessage', 'Erreur: il est interdit de modifier un artiste', time() + 15, "/");
			header("Location: ../allconcerts.php");
			exit("Erreur: il est interdit de modifier un artiste");
		}

		if($date != $datepost)
		{
			if($date < date("Y-m-d"))
			{
				setcookie('contentMessage', 'Erreur: la date saisie est inférieure à la date courante', time() + 15, "/");
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
		<a href="allconcerts.php" id="return"> ⬅ Retour vers les concerts</a>
		<div id="main">
			<div id="concertsall">
				<div class="inwhile">
					<div class="artiste"> 
						<?php 
						echo '<a class="artistetxt" href="supartiste.php?artiste=' . $row['nom_artiste'] . '">'; echo $row['nom_artiste']; echo '</a>'; 
						?> 
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
							<?php
							if($rowrgn['nom_pays'])
							{
								$nompays = $rowrgn['nom_pays'];
								$filename = 'image/flags/' . $nompays . '.jpg';
								if (file_exists($filename)) 
								{
									?>
									<img class="flag" <?php echo 'src="image/flags/' . $rowrgn['nom_pays'] . '.jpg' . '"' ?> width="50" height="30"><?php
								}
								else
								{
									$filename = 'image/flags/' . $nompays . '.png';
									if (file_exists($filename)) 
									{
										?>
										<img class="flag" <?php echo 'src="image/flags/' . $rowrgn['nom_pays'] . '.png' . '"' ?> width="50" height="30"><?php
									}
									else
									{
										?>
										<img class="flag" <?php echo 'src="image/flags/' . 'noflag' . '.png' . '"' ?> width="50" height="30"><?php
									}
								}
							}
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
			</div>
			<div class="champs">
				<h2> Champ(s) modifié(s) ou ajouté(s) </h2>
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
																setcookie('contentMessage', 'Erreur: aucun champ modifié', time() + 15, "/");
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
					echo "<div class='modifclass'>";
						echo "<div class='title'> Date </div>";
						echo "<div class='old'>" . $datepost . "</div>";

						echo "<div class='new'>" . $date . "</div>";
						$sql = "UPDATE modification SET datec = '$date' WHERE id = $idmodif"; 
	   					$query = mysqli_query($con, $sql);
	   				echo "</div>";
				}
				if ($heure != $heurepost)
				{
					echo "<div class='modifclass'>";
						echo "<div class='title'> Heure </div>";
						echo "<div class='old'>" . $heurepost . "</div>";
						echo "<div class='new'>" . $heure . "</div>";
						$sql = "UPDATE modification SET heurec = '$heure' WHERE id = $idmodif"; 
	   					$query = mysqli_query($con, $sql);
	   				echo "</div>";
				}

				if($ville != $villepost)
				{
					if($ville != $modifville)
					{
						echo "<div class='modifclass'>";
							echo "<div class='title'> Ville </div>";
							echo "<div class='old'>" . $villepost . "</div>";
							echo "<div class='new'>" . $ville . "</div>";
							$sql = "UPDATE modification SET ville = '$ville' WHERE id = $idmodif"; 
		   					$query = mysqli_query($con, $sql);
		   				echo "</div>";
	   				}
				}
				if($testcp == 1)
				{
					echo "<div class='modifclass'>";
						echo "<div class='title'> Code postal </div>";
						if($adressepost == NULL) //ajout
						{
							echo "<div class='new'>" . $cp . "</div>";
						}
						else
						{
							echo "<div class='old'>" . $cppost . "</div>";
							echo "<div class='new'>" . $cp . "</div>";
						}
						$sql = "UPDATE modification SET code_postal = '$cp' WHERE id = $idmodif"; 
	   					$query = mysqli_query($con, $sql);
	   				echo "</div>";
				}	
				if($adresse != $adressepost)
				{
					if($adresse != $modifadresse)
					{
						echo "<div class='modifclass'>";
							echo "<div class='title'> Adresse </div>";
							if($adressepost == NULL) //ajout
							{
								echo "<div class='new'>" . $adresse . "</div>";
							}
							else
							{
								echo "<div class='old'>" . $adressepost . "</div>";
								echo "<div class='new'>" . $adresse . "</div>";
							}
							$sql = "UPDATE modification SET adresse = '$adresse' WHERE id = $idmodif"; 
		   					$query = mysqli_query($con, $sql);
		   				echo "</div>";
	   				}
				}
				if($testfb == 1)
				{
					echo "<div class='modifclass'>";
						echo "<div class='title'> Lien événement </div>";
						if($fbpost == NULL) //ajout
						{
							echo "<div class='new'>" . $fb . "</div>";
						}
						else
						{
							echo "<div class='old'>" . $fbpost . "</div>";
							echo "<div class='new'>" . $fb . "</div>";
						}
						$sql = "UPDATE modification SET lien_fb = '$fb' WHERE id = $idmodif"; 
	   					$query = mysqli_query($con, $sql);
	   				echo "</div>";
				}
				if($ticket != $ticketpost)
				{
					echo "<div class='modifclass'>";
						echo "<div class='title'> Lien billetterie </div>";
						if($ticketpost == NULL) //ajout
						{
							echo "<div class='new'>" . $ticket . "</div>";
						}
						else
						{
							echo "<div class='old'>" . $ticketpost .  "</div>";
							echo "<div class='new'>" . $ticket . "</div>";
						}
						$sql = "UPDATE modification SET lien_ticket = '$ticket' WHERE id = $idmodif"; 
	   					$query = mysqli_query($con, $sql);
	   				echo "</div>";
				}				
				/*if($artiste != $artistepost)
				{
					echo "artiste modifié";
					echo '<br>';
					echo "<div class='new'>" . $ . "</div>";
					echo $artistepost;
					echo '<br>';
					echo "<div class='new'>" . $ . "</div>";
					echo $artiste;
					echo '<br>';
					echo '<br>';
				}*/		
				if($testsalle == 1 && $salle != NULL)
				{
					echo "<div class='modifclass'>";
						if($intext)
						{
							echo "<div class='title'> Salle (passage d'exterieur à intérieur) </div>";
						}
						else
						{
							echo "<div class='title'> Salle </div>";
							echo "<div class='old'>" . $sallepost . "</div>";
						}
						echo "<div class='new'>" . $salle . "</div>";
						$sql = "UPDATE modification SET salle = '$salle' WHERE id = $idmodif"; 
	   					$query = mysqli_query($con, $sql);
	   				echo "</div>";
				}
				if($ext != $extpost && $ext != NULL)
				{
					echo "<div class='modifclass'>";
						if($intext)
						{
							echo "<div class='title'> Denomination (passage d'intérieur à extérieur) </div>";
						}
						else
						{
							echo "<div class='title'> Dénomination </div>";
							echo "<div class='old'>" . $extpost . "</div>";
						}
						echo "<div class='new'>" . $ext . "</div>";
						$sql = "UPDATE modification SET denomination = '$ext' WHERE id = $idmodif"; 
	   					$query = mysqli_query($con, $sql);
	   				echo "</div>";
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
					echo "<div class='modifclass'>";
						echo "<div class='title'> Département </div>";
						if($departementpost == NULL) //ajout
						{
							echo "<div class='new'>" . $departement . "</div>";
						}
						else
						{
							echo "<div class='old'>" . $departementpost . "</div>";
							echo "<div class='new'>" . $departement . "</div>";
						}
						$sql = "UPDATE modification SET departement = '$departement' WHERE id = $idmodif"; 
	   					$query = mysqli_query($con, $sql);
	   				echo "</div>";
				}
				if($region != $regionpost && $region != NULL)
				{
					echo "<div class='modifclass'>";
						echo "<div class='title'> Région </div>";
						if($regionpost == NULL)
						{
							echo "<div class='new'>" . $region . "</div>";
						}
						else
						{
							echo "<div class='old'>" . $regionpost . "</div>";
							echo "<div class='new'>" . $region . "</div>";
						}
						echo "<div class='title'> Pays </div>";
						echo "<div class='new'>" . $pays . "</div>";
						$sql = "UPDATE modification SET region = '$region', pays = '$pays' WHERE id = $idmodif"; 
	   					$query = mysqli_query($con, $sql);
	   				echo "</div>";
				}
				?>
			</div>
		</div>
		<?php include('contenu/footer.html'); ?>
	</body>
	<!--<script type="text/javascript" src="./js/scrollnav.js"></script> -->
</html>

