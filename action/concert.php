<?php
/*
	Type fichier : php
	Fonction : Traitement de l'ajout d'un concert
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
			//include '../php/error.php';  
			include '../php/base.php';
			require '../php/database.php';

			$artiste = $_POST['artiste'];
			$indices = $_POST['indice'];
			$indiceslength = strlen($indices);

			
			$artiste = strtolower($artiste);
			$artiste = ucfirst($artiste); //met la première lettre en capitale

			$indices = $_POST['indice']; //récupère la liste des indices où sont stockés les artistes : ex: rang3,4,5 etc...
			$indiceslength = strlen($indices); //récupère le nombre d'artistes ajoutés

			$artistelistindice = str_split($indices); //met la liste des indices dans un tableau


			for ($i=0; $i < $indiceslength; $i++) //on va de 0 au nombre d'artistes ajoutés
			{ 
				$postartiste = 'artiste' . $artistelistindice[$i];
				$artistesadd[$i] = ucfirst($_POST[$postartiste]);
				$artistesadd[$i] = ucfirst(strtolower($_POST[$postartiste])); //on range dans un tableau qui contiendra la liste des artistes
			}

			$date = $_POST['date'];
			$heure = $_POST['heure'];
			$ville = $_POST['ville'];
			$salle = $_POST['salle'];
			$denom = $_POST['denom'];
			$fb = $_POST['fb'];
			$ticket = $_POST['ticket'];
			$adresse = $_POST['adresse'];
			$cp = $_POST['cp'];
			$departement = $_POST['departement'];
			$region = $_POST['region'];
			$pays = $_POST['pays'];

			require ('../php/inject.php'); //0) ajouter inject et définir redirect
		    $redirect = '../ajoutconcert.php';

		    $values = array($artiste, $ville, $salle, $denom, $departement, $region, $pays); //1) mettre données dans un arrray
			for ($i=0; $i < $indiceslength; $i++) //on va de 0 au nombre d'artistes ajouté
			{ 
				array_push($values, $artistesadd[$i]);
			}
		    $inject = inject($values, null); //2) les vérifier

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
		    $returnval = inject($adresse, 'text'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
		    if (!is_null($returnval)) 
		    {
		      array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
		    }

		    $validate = validate($inject, $redirect); //3)validation de tous les champs
		    if($validate == 0) //4) si pas d'injection : ajout des variables
		    {
		    	$artiste = mysqli_real_escape_string($con, $artiste);
				for ($i=0; $i < $indiceslength; $i++) //on va de 0 au nombre d'artistes ajouté
				{ 
					$artistesadd[$i] = mysqli_real_escape_string($con, $artistesadd[$i]);
				}
				$ville = mysqli_real_escape_string($con, $ville);
				$salle = mysqli_real_escape_string($con, $salle);
				$denom = mysqli_real_escape_string($con, $denom);
				$departement = mysqli_real_escape_string($con, $departement);
				$region = mysqli_real_escape_string($con, $region);
				$pays = mysqli_real_escape_string($con, $pays);
				$date = mysqli_real_escape_string($con, $date);
				$heure = mysqli_real_escape_string($con, $heure);
				$fb = mysqli_real_escape_string($con, $fb);
				$ticket = mysqli_real_escape_string($con, $ticket);
				$cp = mysqli_real_escape_string($con, $cp);
				$adresse = mysqli_real_escape_string($con, $adresse);
		    }
		?>
	</head>
	<body>
		<?php	      
			if (isset($_POST['concert']))
			{
				$testvle = 0;

				$sql = "SELECT id_concert FROM concert WHERE datec = '$date'";
				$query = mysqli_query($con, $sql);
				while($row = mysqli_fetch_array($query)) 
				{
					$id_concert = $row['id_concert'];
					$sql = "SELECT nom_artiste FROM artistes_concert WHERE id_concert = $id_concert";
					$queryart = mysqli_query($con, $sql);
					while($rowart = mysqli_fetch_array($queryart))
					{
						if ($rowart['nom_artiste'] == $artiste) 
						{
							setcookie('contentMessage', 'Erreur: un concert de ' . $artiste . ' a déjà été saisi à la même date, si vous pensez que ce message est une erreur merci de le signaler', time() + 15, "/");
							header("Location: ../allconcerts.php");
							exit("Erreur: ce concert a déjà été saisi (même artiste et même date)");
						}
						for ($i=0; $i < $indiceslength; $i++) //on va de 0 au nombre d'artistes ajouté
						{ 
							if ($rowart['nom_artiste'] == $artistesadd[$i]) 
							{
								setcookie('contentMessage', 'Erreur: un concert de ' . $artistesadd[$i] . ' a déjà été saisi à la même date, si vous pensez que ce message est une erreur merci de le signaler', time() + 15, "/");
								header("Location: ../allconcerts.php");
								exit("Erreur: ce concert a déjà été saisi (même artiste et même date)");
							}
						}
					}
				}
				$sql = "SELECT heure FROM concert, salle WHERE salle.nom_salle = '$salle' AND concert.datec = '$date'";
				$query = mysqli_query($con, $sql);
				while($row = mysqli_fetch_array($query)) 
				{
					if($heure+2 > $row['heure'] && $heure-2 < $row['heure'])
					{
						setcookie('contentMessage', 'Erreur: il semble que un concert dans cette salle ait déjà été saisi à la date et aux horaires renseignés. Vérifiez les concerts. Si vous pensez que cela est dû à une erreur, merci de le signaler', time() + 15, "/");
						header("Location: ../allconcerts.php");
						exit("Erreur: Concert déjà saisi (même artiste et même date)");
					}
				}

				if(isset($_SESSION['pseudo']))
				{
					$pseudo = $_SESSION['pseudo'];
					$requestpseudo = "SELECT id_user FROM utilisateur WHERE pseudo = '$pseudo'";
					$query = mysqli_query($con, $requestpseudo);
					$row = mysqli_fetch_array($query);
					$idpseudo = $row['id_user'];
				}


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
							$insertdpt = "INSERT INTO departement (nom_departement) VALUES ('$departement')"; 
							//ajout département en BDD
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
							$insertvle = "INSERT INTO ville (nom_ville, ville_code_postal) VALUES ('$ville', '$cp')"; //ajout de la ville en BDD 
							mysqli_query($con, $insertvle);
						}
						else if(!$cp)
						{
							$insertvle = "INSERT INTO ville (nom_ville) VALUES ('$ville')"; //ajout de la ville en BDD 
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
					}
					if($cp)
					{
						$updatevle = "UPDATE ville SET ville_code_postal = '$cp' WHERE ville_id = '$vle' ";
					}
				}

				$sql = "SELECT Nom_artiste FROM artiste WHERE Nom_artiste = '$artiste'";
				$result = mysqli_query($con, $sql);
				$row_cnt = mysqli_num_rows($result);
				if($row_cnt<1) //si pas de ligne trouvée
				{
					$insertartiste = "INSERT INTO artiste (nom_artiste) VALUES ('$artiste')";
					mysqli_query($con, $insertartiste);
				}
				for ($i=0; $i < $indiceslength; $i++) //on va de 0 au nombre d'artistes ajouté
				{ 
					$sql = "SELECT Nom_artiste FROM artiste WHERE Nom_artiste = '$artistesadd[$i]'";
					$result = mysqli_query($con, $sql);
					$row_cnt = mysqli_num_rows($result);
					if($row_cnt<1) //si pas de ligne trouvée
					{
						$insertartiste = "INSERT INTO artiste (nom_artiste) VALUES ('$artistesadd[$i]')";
						mysqli_query($con, $insertartiste);
					}
				}
				/* Ferme le jeu de résultats */
				mysqli_free_result($result);

				$query = mysqli_query($con, $idville); //"SELECT ville_id FROM ville WHERE nom_ville = '$ville'";
				$row = mysqli_fetch_array($query);
				$vle = $row['ville_id'];

				if($salle) //si le concert est à l'intérieur
				{
					$results = mysqli_query($con,"SELECT nom_salle FROM salle WHERE nom_salle = '$salle'"); //on cherche si la salle saisie existe en BDD
					$row_cnt = mysqli_num_rows($results);
					if($row_cnt<1) //si pas de ligne trouvée (donc pas de salle)
					{
						$insertsalle = "INSERT INTO salle (nom_salle, adresse, id_ville, intext) VALUES ('$salle', '$adresse', '$vle', '1')"; //salle ajoutee à la BDD
						mysqli_query($con, $insertsalle);
					}
					else //ici on teste l'adresse et la ville
					{
						$test = "SELECT adresse, nom_ville FROM salle, ville WHERE nom_salle = '$salle' AND salle.id_ville = ville.ville_id";
						$query = mysqli_query($con, $test);
						$row = mysqli_fetch_array($query);
						$test_adresse = $row['adresse'];
						$test_ville = $row['nom_ville'];
						if($test_adresse != $adresse) //si l'adresse a été modifiée
						{
							$insertadresse = "UPDATE salle SET adresse = '$adresse' WHERE nom_salle = '$salle'";
							mysqli_query($con, $insertadresse);
						}
						if($test_ville != $ville) //si la ville a été modifiée
						{
							$test = "SELECT ville_id FROM ville WHERE nom_ville = '$ville'";
							$query = mysqli_query($con, $test);
							$row = mysqli_fetch_array($query);
							$test_id = $row['ville_id'];
							$insertville = "UPDATE salle SET id_ville = '$test_id' WHERE nom_salle = '$salle'";
							mysqli_query($con, $insertville);
						}
					}
					
					$idsalle = "SELECT id_salle FROM salle WHERE nom_salle = '$salle'";
					$query = mysqli_query($con, $idsalle);
					$row = mysqli_fetch_array($query);
					$sle = $row['id_salle'];
					if(isset($_SESSION['pseudo']))
					{
						$sql = "INSERT INTO concert (datec, heure, fksalle, date_ajout, lien_fb, lien_ticket, user_ajout) VALUES ('$date', '$heure', '$sle', NOW(), '$fb', '$ticket', '$idpseudo')";
					}
					else
					{
						$sql = "INSERT INTO concert (datec, heure, fksalle, date_ajout, lien_fb, lien_ticket) VALUES ('$date', '$heure', '$sle', NOW(), '$fb', '$ticket')";
					}
				}
				else //concert en extérieur
				{
					$insertext = "INSERT INTO salle (nom_ext, adresse, id_ville, intext) VALUES ('$denom', '$adresse', '$vle', '2')"; //lieu ext ajouté à la BDD
					mysqli_query($con, $insertext);
					$idext = "SELECT MAX(id_salle) AS id_max FROM salle"; //on recupere l'ID le plus haut (dernier lieu extérieur ajouté)
					$query = mysqli_query($con, $idext);
					$row = mysqli_fetch_array($query);
					$exte = $row['id_max'];
					if(isset($_SESSION['pseudo']))
					{
						$sql = "INSERT INTO concert (datec, heure, fksalle, date_ajout, lien_fb, lien_ticket, user_ajout) VALUES ('$date', '$heure', '$exte', NOW(), '$fb', '$ticket', '$idpseudo')";
					}
					else
					{
						$sql = "INSERT INTO concert (datec, heure, fksalle, date_ajout, lien_fb, lien_ticket) VALUES ('$date', '$heure', '$exte', NOW(), '$fb', '$ticket')";
					}
				}
				if(mysqli_query($con, $sql))
				{
					$idconcert = "SELECT MAX(id_concert) AS id_max FROM concert";
					$query = mysqli_query($con, $idconcert);
					$row = mysqli_fetch_array($query);
					$idcon = $row['id_max'];

					$sql = "INSERT INTO artistes_concert (id_concert, nom_artiste) VALUES ('$idcon', '$artiste')";
					mysqli_query($con, $sql);

					for ($i=0; $i < $indiceslength; $i++) //on va de 0 au nombre d'artistes ajouté
					{ 
						$sql = "INSERT INTO artistes_concert (id_concert, nom_artiste) VALUES ('$idcon', '$artistesadd[$i]')";
						mysqli_query($con, $sql);
					}
    				setcookie('contentMessage', 'Concert ajouté avec succès', time() + 15, "/");
    				header("Location: ../allconcerts.php");
     				exit("Concert ajouté avec succès");
				}
				else
				{
					setcookie('contentMessage', 'Erreur dans l\'ajout du concert, veuillez réessayer ou nous contacter si le problème persiste', time() + 15, "/");
    				header("Location: ../allconcerts.php");
     				exit("Erreur dans l\'ajout du concert, vueuillez réessayer ou nous contacter si le problème persiste");
				}
			}
		?>
	</body>
</html>