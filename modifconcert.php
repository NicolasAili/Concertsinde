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
<?php
    session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Recap</title>
		<meta charset="utf-8">
		<!--<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/concert.css" media="screen" />		-->
		<title></title>
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
		<link rel="stylesheet" type="text/css" href="css/body/modifconcert.css" media="screen" />	
		<script type="text/javascript" src="./js/scriptform.js"></script> 
		<!-- Script -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<!-- jQuery UI -->
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		
		
		<!--<script src="./js/jquery.easy-autocomplete.min.js"></script>

		
		<link rel="stylesheet" href="./js/easy-autocomplete.min.css">

		
		<link rel="stylesheet" href="./js/easy-autocomplete.themes.min.css">-->
			


	</head>
	<!--<header>
		<?php //include('header.php'); ?>
	</header>-->
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

			require('php/error.php');

			$idconcert = $_POST['idpost'];
			$idsalle = $_POST['idsallepost'];
			$artiste = $_POST['artistepost'];
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
			$action = $_POST['modsuppr'];
			$pseudo = $_SESSION['pseudo'];

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
					setcookie('contentMessage', 'Erreur: cette action est réservée aux administrateurs', time() + 30, "/");
					header("Location: ./allconcerts.php");
					exit("Erreur: cette action est réservée aux administrateurs");
				}
				else if($action == 'Modifier')
				{
					setcookie('contentMessage', 'Erreur: vous devez être connectés afin de pouvoir modifier un concert', time() + 30, "/");
					header("Location: ./allconcerts.php");
					exit("Erreur: vous devez être connectés afin de pouvoir modifier un concert");
				}
				else
				{
					setcookie('contentMessage', 'Erreur inconnue, merci de contacter le support', time() + 30, "/");
					header("Location: ./allconcerts.php");
					exit("Erreur inconnue, merci de contacter le support");
				}
			}
			else if($testadmin < 1 AND $action == 'Valider' || $action == 'Supprimer')
			{
				setcookie('contentMessage', 'Erreur: cette action est réservée aux administrateurs', time() + 30, "/");
				header("Location: ./allconcerts.php");
				exit("Erreur: cette action est réservée aux administrateurs");
			}
			else
			{
				if($action == 'Modifier')
				{
					if($valide == 1 && $testadmin < 1)
					{
						setcookie('contentMessage', 'Erreur: il est interdit de modifier un concert validé', time() + 30, "/");
						header("Location: ./allconcerts.php");
						exit("Erreur: il est interdit de modifier un concert validé");
					}
					?>
					<h1> modifier un concert </h1>
					<form method="post" id="connect" action="modifconcertvalid.php">
						<label for="artiste">Nom de l'artiste ou du groupe:  </label> 
						<input type="text" name="artiste" onkeyup="getdata(this.id);" <?php echo 'value="' . $artiste . '"' ?>  id="artiste" disabled>
						<input type="hidden" id="artistepost" name="artistepost" <?php echo 'value="' . $artiste . '"' ?> > 
						<br>
						<br>
						<label for="date">Date : </label> 
						<input type="date" name="date" <?php echo 'value="' . $date . '"' ?> id="date">
						<input type="hidden" id="datepost" name="datepost" <?php echo 'value="' . $date . '"' ?> > 
						<br>
						<br>
						<label for="heure">Heure (laissez les deux derniers chiffres à 0) : </label> 
						<input type="time" name="heure" <?php echo 'value="' . $heure . '"' ?>  id="heure">
						<input type="hidden" id="heurepost" name="heurepost" <?php echo 'value="' . $heure . '"' ?> > 
						<br>
						<br>
						Lieu du concert  
						<div id="extint"> 
							<br>
							<?php
							if($intext == 'int')
							{
							?>
								<input type="checkbox" id="int" name="int" onclick="checkboxmodif(this.id);" checked disabled>
								en intérieur (salle)
								<input type="checkbox" id="ext" name="ext" onclick="checkboxmodif(this.id);"> 
								en extérieur (festival, concert sauvage, rue etc...)
								<br>
								<div id="intdiv">
									<label for="salle">Salle : </label> 
									<input type="text" name="salle" id="salle" onblur="getleave(this.id);" onkeyup="getdata(this.id);" <?php echo 'value="' . $salle . '"' ?> required>
									<div id="res"> </div>
									<input type="hidden" id="sallepost" name="sallepost" <?php echo 'value="' . $salle . '"' ?>>
									<br>
								</div>
								<div id="exthiddiv">
									<label for="ext">Denomination : </label> 
									<input type="text" name="extval" id="extval" <?php echo 'value="' . $ext . '"' ?> >
									<div id="res"> </div>
									<input type="hidden" id="extpost" name="extpost" value=""> 
								</div>
							<?php
							}
							else
							{
							?>	
								<input type="checkbox" id="int" name="int" onclick="checkboxmodif(this.id);"> 
								en intérieur (salle)
								<input type="checkbox" id="ext" name="ext" onclick="checkboxmodif(this.id);" checked disabled> 
								en extérieur (festival, concert sauvage, rue etc...)
								<br>
								<div id="extdiv">
									<label for="ext">Denomination : </label> 
									<input type="text" name="extval" id="extval" <?php echo 'value="' . $ext . '"' ?> required>
									<div id="res"> </div>
									<input type="hidden" id="extpost" name="extpost" <?php echo 'value="' . $ext . '"' ?>> 
									<br>
								</div>
								<div id="inthiddiv">
									<label for="salle">Salle : </label> 
									<input type="text" name="salle" id="salle" onblur="getleave(this.id);" onkeyup="getdata(this.id);" <?php echo 'value="' . $salle . '"' ?> >
									<div id="res"> </div>
									<input type="hidden" id="sallepost" name="sallepost" value=""> 
								</div>
							<?php
							}
							?>
						</div>
						<div id="infos">
							<label for="ville">Ville : </label> 
							<input type="text" name="ville" onblur="getleave(this.id);" onkeyup="getdata(this.id);" <?php echo 'value="' . $ville . '"' ?> id="ville">
							<br>
							<label for="cp">Code postal: </label> 
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
							<br>
							<label for="departement">Département: </label>
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
							<br>
							<?php
							if($region) //region + departement
							{ 
								?>
								<label for="region">Région: </label> 
								<input type="text" name="region" onblur="getleave(this.id);" onkeyup="getdata(this.id);" <?php echo 'placeholder="' . $region . '"' ?> id="region" disabled>							 
								<br>	
								<label for="pays">Pays: </label> 
								<input type="text" name="pays" onkeyup="getdata(this.id);" <?php echo 'placeholder="' . $pays . '"' ?> id="pays" disabled>
							<?php	
							}
							else if($departement && !$region) //seulement le departement
							{
								?>
								<label for="region">Région: </label> 
								<input type="text" name="region" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="région non renseignée" id="region" >							 
								<br>	
								<label for="pays">Pays: </label> 
								<input type="text" name="pays" onkeyup="getdata(this.id);" placeholder="pays non renseignée" id="pays" disabled="">
							<?php
							}
							else //ni region ni departement
							{
								?>
								<label for="region">Région: </label> 
								<input type="text" name="region" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="région non renseignée" id="region" disabled>							 
								<br>	
								<label for="pays">Pays: </label> 
								<input type="text" name="pays" onkeyup="getdata(this.id);" placeholder="pays non renseignée" id="pays" disabled>
							<?php
							}
							?>
						</div>
						<input type="hidden" id="regionpost" name="regionpost" <?php echo 'value="' . $region . '"' ?> >
						<input type="hidden" id="payspost" name="payspost" <?php echo 'value="' . $pays . '"' ?>> 
						<br>
						<br>
						<label for="adresse">Adresse: </label> 
						<input type="text" name="adresse" <?php echo 'value="' . $adresse . '"' ?>id="adresse">
						<input type="hidden" id="adressepost" name="adressepost" <?php echo 'value="' . $adresse . '"' ?> > 
						<br>
						<label for="fb">Lien de l'evenement (facebook ou autres) : </label> 
						<input type="text" name="fb" <?php echo 'value="' . $fb . '"' ?> id="fb">
						<input type="hidden" id="fbpost" name="fbpost" <?php echo 'value="' . $fb . '"' ?> > 
						<br>
						<label for="ticket">Lien de la billetterie : </label> 
						<input type="text" name="ticket" <?php echo 'value="' . $ticket . '"' ?> id="ticket">
						<input type="hidden" id="ticketpost" name="ticketpost" <?php echo 'value="' . $ticket . '"' ?> > 
						<br>
						<input type="hidden" id="idpost" name="idpost" <?php echo 'value="' . $idconcert . '"' ?> > 
						<input type="hidden" id="intextpost" name="intextpost" <?php echo 'value="' . $intext . '"' ?> > 
						<input type="hidden" id="intext" name="intext" value=""> 
						<input type="hidden" id="villepost" name="villepost" <?php echo 'value="' . $ville . '"' ?> > 
						<input type="submit" value="Enregister le concert" id="valider" name="concert" href="">
						<input type="button" value="Reinitialiser le formulaire" onclick="reinitialiser();">
						<input type="button" value="Effacer tous les champs" onclick="erase();">
						<input type="hidden" id="resetform">
					</form>
					<form method="post" action="allconcerts.php">
    					<button type="submit">Annuler</button>
					</form>
				<?php
				}
				else if($action == 'Supprimer')
				{
					$sql = "DELETE FROM Concert WHERE nom_artiste = '$artiste' AND datec = '$date' AND id_concert = '$idconcert'"; 
					mysqli_query($con, $sql);
					setcookie('contentMessage', 'Concert supprimé', time() + 30, "/");
					header("Location: ./allconcerts.php");
					exit("Concert supprimé");
				}
				else if($action == 'Valider')
				{
					$testmodif = 0;

					$sql = "SELECT user_ajout FROM concert WHERE id_concert = '$idconcert'";
					$query = mysqli_query($con, $sql);
  					$row = mysqli_fetch_array($query);
					$userajout = $row['user_ajout'];

					$sql = "SELECT pseudo FROM utilisateur WHERE ID_user = '$userajout'";
					$query = mysqli_query($con, $sql);
  					$row = mysqli_fetch_array($query);
					$pseudoajout = $row['pseudo'];

					$sql = "SELECT points_session, points FROM utilisateur WHERE ID_user = '$userajout'";
					$query = mysqli_query($con, $sql);
  					$row = mysqli_fetch_array($query);
					$pointssession = $row['points_session'];
					$points = $row['points'];

					$sql = "SELECT datec, heure, intext, nom_salle, nom_ext, adresse, nom_ville, ville_code_postal, nom_departement, nom_region, nom_pays, lien_fb, lien_ticket FROM concert, salle, ville, departement, region, pays WHERE  concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND ville.ville_departement = departement.numero AND departement.id_region = region.id AND region.id_pays = pays.id AND concert.id_concert = '$idconcert'";
					$query = mysqli_query($con, $sql);
					$rowx = mysqli_fetch_array($query);


					$sql = "SELECT * FROM modification WHERE id_concert = '$idconcert'";
					$query = mysqli_query($con, $sql);
					
					while($row = mysqli_fetch_array($query))
					{
						$idpseudo = $row['id_user'];

						$sqlmodif = "SELECT pseudo FROM utilisateur WHERE ID_user = '$idpseudo'";
						$querymodif = mysqli_query($con, $sqlmodif);
	  					$rowmodif = mysqli_fetch_array($querymodif);
						$pseudomodif = $rowmodif['pseudo'];

						$sqlpts = "SELECT points_session, points FROM utilisateur WHERE ID_user = '$idpseudo'";
						$querypts = mysqli_query($con, $sqlpts);
	  					$rowpts = mysqli_fetch_array($querypts);
						$pointssession = $rowpts['points_session'];
						$points = $rowpts['points'];
						$pointscalcul = $pointssession;

						if($idpseudo != $userajout)
						{
							if($rowx['datec'] == $row['datec'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
							}
							if($rowx['heure'] == $row['heurec'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
							}
							if($rowx['intext'] == $row['intext'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
							}
							if($rowx['nom_salle'] && $rowx['nom_salle'] == $row['salle'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
							}
							if($rowx['nom_ext'] && $rowx['nom_ext'] == $row['denomination'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
							}
							if($rowx['adresse'] == $row['adresse'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
							}
							if($rowx['nom_ville'] == $row['ville'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
							}
							if($rowx['ville_code_postal'] == $row['code_postal'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
							}
							if($rowx['nom_departement'] == $row['departement'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
							}
							if($rowx['nom_region'] == $row['region'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
							}
							if($rowx['nom_pays'] == $row['pays'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
							}
							if($rowx['lien_fb'] == $row['lien_fb'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
							}
							if($rowx['lien_ticket'] == $row['lien_ticket'])
							{
								$pointssession = $pointssession + 1;
								$points = $points + 1;
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

					/*setcookie('contentMessage', 'Concert validé avec succès !', time() + 30, "/");
					header("Location: ./allconcerts.php");
					exit("Concert validé avec succès !");*/
				}
				else if($action = 'probleme')
				{?>
					<form action="erreursubmit.php" method="post">
						Sur quel(s) champ(s) pensez-vous qu'il y a erreur ?
						<input type="checkbox" id="artiste" name="artiste" value="artiste">
						<label for="artiste">artiste</label>
						<input type="checkbox" id="date" name="date" value="date">
						<label for="date">date</label>
						<input type="checkbox" id="heure" name="heure" value="heure">
						<label for="heure">heure</label>
						<input type="checkbox" id="salle" name="salle" value="salle/denomination">
						<label for="salle">salle</label>
						<input type="checkbox" id="ville" name="ville" value="ville">
						<label for="ville">ville</label>
						<input type="checkbox" id="cp" name="cp" value="code_postal">
						<label for="cp">code_postal</label>
						<input type="checkbox" id="departement" name="departement" value="departement">
						<label for="departement">departement</label>
						<input type="checkbox" id="region" name="region" value="region">
						<label for="region">region</label>
						<input type="checkbox" id="pays" name="pays" value="pays">
						<label for="pays">pays</label>
						<input type="checkbox" id="adresse" name="adresse" value="adresse">
						<label for="adresse">adresse</label>
						<input type="checkbox" id="lien_fb" name="lien_fb" value="lien de l'evenement">
						<label for="lien_fb">lien de l'evenement</label>
						<input type="checkbox" id="lien_ticket" name="lien_ticket" value="lien vers la billetterie">
						<label for="lien_ticket">lien vers la billetterie</label>
						<input type="checkbox" id="autre" name="autre" value="autre chose">
						<label for="autre">autre</label>
						<p>
							<label for="probleme">Dans ce champ, précisez les valeurs des champs du concert que vous pensez être faux, apportez des précisions ou bien décrivez votre problème s'il n'est pas relatif aux champs du concert. N'hésitez pas à fournir le plus de détails possible</label><br />
							<textarea name="probleme" id="probleme" cols="40" rows="5"></textarea>
						</p>
						<p>
							<label for="ajout">Si vous souhaitez ajouter quoi que ce soit</label><br />
							<textarea name="ajout" id="ajout" cols="40" rows="5"></textarea>
						</p>

						<input type="hidden" id="idconcert" name="idconcert" <?php echo 'value="' . $idconcert . '"' ?>>
						<input type="hidden" id="pseudo" name="pseudo" <?php echo 'value="' . $_SESSION['pseudo'] . '"' ?>>
						<input type="hidden" id="type" name="type" value="1"> 
						<input type="submit" value="Envoyer" />
					</form>
					<?php
				}
				else
				{
					setcookie('contentMessage', 'Erreur inconnue, merci de contacter le support', time() + 30, "/");
					header("Location: ./allconcerts.php");
					exit("Erreur inconnue, merci de contacter le support");
				}
			}
			?>
	</body>
	<script>
		$('#connect').submit(function () 
	{
		var strpays = $("#pays").val();
    	var strregion = $("#region").val();

	    var strdate = $("#date").val();
	    var datesaisie = new Date(strdate).getTime()

		var now = new Date();
        var heure   = now.getHours();
        heureinf = (heure+1)*3600000; //heure courante multipliée par le nb de ms en 1 heure
        heuresup = 63072000000; //2 ans en milliseconde
        

        var dateinf = datesaisie + heureinf;
        var datesup = Date.now() + heuresup;

        if(dateinf < Date.now())
        {
            alert("Erreur, date saisie inférieure à la date actuelle");
            return false;
        }
        if(datesaisie > datesup)
        {
            alert("Erreur, impossible de saisir des concerts plus de deux ans en avance");
            return false;
        }


	    if(strregion.length > 0 && !strpays)
	    {
	        alert("Erreur, vous devez saisir le pays dont fait partie cette région");
	        return false;
	    }
    	});
     </script>
	
	<!--<script> $("#salle").keyup(getdata(this.id)); </script>-->
</html>



