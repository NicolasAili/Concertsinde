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
			$salle = $_POST['salle'];
			$sallepost = $_POST['sallepost'];
			$testsalle = 0;
			$adresse = $_POST['adresse'];
			$adressepost = $_POST['adressepost'];
			$testadresse = 0;
			$fb = $_POST['fb'];
			$fbpost = $_POST['fbpost'];
			$testfb = 0;
			$ticket = $_POST['ticket'];
			$ticketpost = $_POST['ticketpost'];
			$testticket = 0;
			
			/*echo $date;
			echo '<br>';
			if($date != NULL)
			{
				echo "succes date"
			}
			echo $heure;
			echo '<br>';
			if($heure != NULL)
			{
				echo "succes heure"
			}*/
			

			if($salle != NULL)
			{
				$testsalle = 1;
				$result = mysqli_query($con, "SELECT Nom_salle FROM salle WHERE Nom_salle = '$salle'");
				$row_cnt = mysqli_num_rows($result);
				if($row_cnt<1) //si pas de ligne trouvée
				{
					$insertsalle = "INSERT INTO salle (Nom_salle) VALUES ('$salle')";
					mysqli_query($con, $insertsalle);
				}
				/* Ferme le jeu de résultats */
				mysqli_free_result($result);
				$sqlsal = "UPDATE concert SET Nom_salle = '$salle' WHERE ID_concert = $idconcert";
    			mysqli_query($con, $sqlsal);
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
			if($pays != NULL)
			{
				$testpays = 1;
				if($testsalle == 1)
				{
					$sqlpays = "UPDATE salle SET Pays = '$pays' WHERE Nom_salle = '$salle'";
    				mysqli_query($con, $sqlpays);
				}
				else if($testsalle == 0)
				{
					$sqlpaysex = "UPDATE salle SET Pays = '$pays' WHERE Nom_salle = '$sallepost'";
    				mysqli_query($con, $sqlpaysex);
				}
			}
			if($region != NULL)
			{
				$testregion= 1;
				if($testsalle == 1)
				{
					$sqlregion = "UPDATE salle SET Region = '$region' WHERE Nom_salle = '$salle'";
    				mysqli_query($con, $sqlregion);
    			}
    			else if($testsalle == 0)
				{
					$sqlregionex = "UPDATE salle SET Region = '$region' WHERE Nom_salle = '$sallepost'";
    				mysqli_query($con, $sqlregionex);
    			}
			}
			if($departement != NULL)
			{
				$testdepartement = 1;
				if($testsalle == 1)
				{
					$sqldpt = "UPDATE salle SET Departement = '$departement' WHERE Nom_salle = '$salle'";
    				mysqli_query($con, $sqldpt);
    			}
    			else if($testsalle == 0)
				{
					$sqldpteex = "UPDATE salle SET Departement = '$departement' WHERE Nom_salle = '$sallepost'";
    				mysqli_query($con, $sqldpteex);
    			}
			}
			if($ville != NULL)
			{
				$testville = 1;
				if($testsalle == 1)
				{
					$sqlville = "UPDATE salle SET Ville = '$ville' WHERE Nom_salle = '$salle'";
    				mysqli_query($con, $sqlville);
    			}
    			else if($testsalle == 0)
				{
					$sqlvilleex = "UPDATE salle SET Ville = '$ville' WHERE Nom_salle = '$sallepost'";
    				mysqli_query($con, $sqlvilleex);
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
	$str = "SELECT * FROM `concert`, `artiste`, `salle` WHERE concert.Nom_artiste = artiste.Nom_artiste AND concert.Nom_salle = salle.Nom_salle AND concert.ID_concert = $idconcert";
			$result = mysqli_query($con, $str);
			$row = mysqli_fetch_array($result)
			?>
			<div id="concertsall">
				<div class="inwhile"> 
					<div class="artiste"> <?php echo $row['Nom_artiste'] ?> </div> 
						<div class="dahe">Date et heure</div>
					<div class="date"> <?php echo  $row['datec'] ?> </div>  
					<div class="heure"> <?php echo $row['heure'] ?> </div>  
						<div class="pacp">Pays ville et CP</div>
					<div class="pays"> <?php echo  $row['Pays'] ?> </div> 
					<div class="region"> <?php echo  $row['Region'] ?> </div> 
					<div class="departement"> <?php echo  $row['Departement'] ?> </div> 
					<div class="ville"> <?php echo $row['Ville'] ?> </div> 
					<div class="cp"> <?php echo  $row['CP'] ?> </div>
						<div class="saad">Salle et adresse</div> 
					<div class="salle"> <?php echo  $row['Nom_salle'] ?> </div> 
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
				if($testartiste == 1)
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
				?>
			</div>
	</body>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>

