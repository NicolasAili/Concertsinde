<?php
    session_start();
    ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tous les concerts</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/allconcerts.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />	
		<script type="text/javascript" src="./jquery/jquery.min.js"></script>
		<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="./jquery/jquery-ui.css" media="screen" />		
		<?php include("supprimer.php"); // on appelle le fichier?>
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
	</head>
	<header>
		<?php include('header.php'); ?>
	</header>
	<body>	
		<?php
		$add = $_GET['add'];
		$modif = $_GET['modif'];
		$filter = $_GET['filter'];
		$getsalle = $_GET['salle'];
		$getville = $_GET['ville'];
		$getcp = $_GET['cp'];
		$getdepartement = $_GET['departement'];
		$getnumdepartement = $_GET['numero'];
		$getregion = $_GET['region'];
		$pseudo = $_SESSION['pseudo'];

		$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		$testadmin = $row['admin'];

		//$get = $_GET['filtre'];
		$string = $_SERVER['QUERY_STRING'];
			
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "</br>";
			//echo $string;
			//echo "</br>";
			parse_str($string);
			$finalstring = explode("&", $string);
			$filtre = " datec ASC";
			//echo $finalstring[0];
			//echo "</br>";
			//echo $finalstring[1];
			//echo "</br>";
		?>
		filtres...
		 <form action="allconcerts.php" method="get">
		  <label for="salle">Salle:</label>
		  <input type="text" id="salle" name="salle" value=<?php echo "$getsalle";?>><br><br>
		  <?php if($filter)
		  {
		  	echo '<input type="hidden" id="filter" name="filter" value="'; echo $filter; echo'">';
		  }
		  else
		  {
		  	echo '<input type="hidden" id="filter" name="filter" value="none">';
		  }?>
		  <input type="submit" value="Submit">
		</form> 
		<br>
		<form action="allconcerts.php" method="get">
		  <label for="ville">Ville:</label>
		  <input type="text" id="ville" name="ville" value=<?php echo "$getville";?>><br><br>
		  <?php if($filter)
		  {
		  	echo '<input type="hidden" id="filter" name="filter" value="'; echo $filter; echo'">';
		  }
		  else
		  {
		  	echo '<input type="hidden" id="filter" name="filter" value="none">';
		  }?>
		  <input type="submit" value="Submit">
		</form>
		<br>
		<form action="allconcerts.php" method="get">
		  <label for="salle">CP:</label>
		  <input type="text" id="cp" name="cp" value=<?php echo "$getcp";?>><br><br>
		  <?php if($filter)
		  {
		  	echo '<input type="hidden" id="filter" name="filter" value="'; echo $filter; echo'">';
		  }
		  else
		  {
		  	echo '<input type="hidden" id="filter" name="filter" value="none">';
		  }?>
		  <input type="submit" value="Submit">
		</form> 
		<br>
		<form action="allconcerts.php" method="get">
		  <label for="salle">Departement:</label>
		  <input type="text" id="departement" name="departement" value=<?php echo "$getdepartement";?>><br><br>
		  <?php if($filter)
		  {
		  	echo '<input type="hidden" id="filter" name="filter" value="'; echo $filter; echo'">';
		  }
		  else
		  {
		  	echo '<input type="hidden" id="filter" name="filter" value="none">';
		  }?>
		  <input type="submit" value="Submit">
		</form> 
		<br>
		<form action="allconcerts.php" method="get">
		  <label for="salle">Numero de département:</label>
		  <input type="text" id="numero" name="numero" value=<?php echo "$getnumdepartement";?>><br><br>
		  <?php if($filter)
		  {
		  	echo '<input type="hidden" id="filter" name="filter" value="'; echo $filter; echo'">';
		  }
		  else
		  {
		  	echo '<input type="hidden" id="filter" name="filter" value="none">';
		  }?>
		  <input type="submit" value="Submit">
		</form> 
		<br>
		<form action="allconcerts.php" method="get">
		  <label for="salle">Region:</label>
		  <input type="text" id="region" name="region" value=<?php echo "$getregion";?>><br><br>
		  <?php if($filter)
		  {
		  	echo '<input type="hidden" id="filter" name="filter" value="'; echo $filter; echo'">';
		  }
		  else
		  {
		  	echo '<input type="hidden" id="filter" name="filter" value="none">';
		  }?>
		  <input type="submit" value="Submit">
		</form> 
		<br>

		<?php

		echo "<br>";
		echo '<a href="allconcerts.php?filter=reset">'; echo "Réinitialiser les filtres"; echo '</a>';
		echo "<br>";
		echo "<br>";
		?>
		trier par...
		<?php
		echo "<br>";
		//} else if {$filter == "artisteup"} else{}

		if($string && $filter != "artisteup" && $finalstring[0] != "recherche=none"){echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=artisteup"; echo '">';}else if($filter == "artisteup" && $finalstring[0] != "recherche=none"){}else{echo '<a href="allconcerts.php?recherche=none&filter=artisteup">';} if($filter == "artisteup"){echo "<strong>";}echo "nom d'artiste croissant (de a à z)"; if($filter == "artisteup"){echo "</strong>";} echo '</a>';
		echo " ";
		if($string && $filter != "artistedown" && $finalstring[0] != "recherche=none"){echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=artistedown"; echo '">';}else if($filter == "artistedown" && $finalstring[0] != "recherche=none"){}else{echo '<a href="allconcerts.php?recherche=none&filter=artistedown">';} if($filter == "artistedown"){echo "<strong>";}echo "nom d'artiste décroissant (de z à a)"; if($filter == "artistedown"){echo "</strong>";} echo '</a>';
		echo "<br>";
		if($string && $filter != "dateup" && $finalstring[0] != "recherche=none"){echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=dateup"; echo '">';}else if($filter == "dateup" && $finalstring[0] != "recherche=none"){}else{echo '<a href="allconcerts.php?recherche=none&filter=dateup">';} if($filter == "dateup"){echo "<strong>";}echo "Du plus proche au plus éloigné dans le temps (par défaut)"; if($filter == "dateup"){echo "</strong>";} echo '</a>';
		echo " ";
		if($string && $filter != "datedown" && $finalstring[0] != "recherche=none"){echo '<a href="allconcerts.php?'; echo $finalstring[0]; echo "&filter=datedown"; echo '">';}else if($filter == "datedown" && $finalstring[0] != "recherche=none"){}else{echo '<a href="allconcerts.php?recherche=none&filter=datedown">';} if($filter == "datedown"){echo "<strong>";}echo "Du plus éloigné au plus proche dans le temps"; if($filter == "datedown"){echo "</strong>";} echo '</a>';

		switch($filter)
		{
			case "artisteup":
				$filtre = " nom_artiste ASC";
				break;
			case "artistedown":
				$filtre = " nom_artiste DESC";
				break;
			case "dateup":
				$filtre = " datec ASC";
				break;
			case "datedown":
				$filtre = " datec DESC";
				break;
		}
		?>



		<hr>
		<h1>Tous les concerts</h1>
	 	<?php
			$servername = 'localhost';
			$username = 'root';
			$password = '';
			$dbname = 'webbd';

			//Connexion à la BDD
			$con = mysqli_connect($servername, $username, $password, $dbname);

			//Vérification de la connexion
			if(mysqli_connect_errno($con)){
			echo "Erreur de connexion" .mysqli_connect_error();
			}
		?>
		<?php
			$admin = 'administateur';
			//echo $_SESSION['pseudo'];
			//echo $admin;
			if($getsalle)
			{
				$str = sprintf("SELECT id_concert FROM concert, salle WHERE salle.id_salle = concert.fksalle AND nom_salle = '$getsalle' ORDER BY". $filtre ."");

			}
			else if ($getville) {
				$str = sprintf("SELECT id_concert FROM concert, ville, salle WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.nom_ville = '$getville' ORDER BY". $filtre ."");
			}
			else if ($getcp) {
				$str = sprintf("SELECT id_concert FROM concert, ville, salle WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.ville_code_postal = '$getcp' ORDER BY". $filtre ."");
			}
			else if ($getdepartement) {
				$str = sprintf("SELECT id_concert FROM concert, ville, salle, departement WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.ville_departement = departement.numero AND departement.nom_departement = '$getdepartement' ORDER BY". $filtre ."");
			}
			else if ($getnumdepartement) {
				$str = sprintf("SELECT id_concert FROM concert, ville, salle, departement WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.ville_departement = departement.numero AND departement.numero = '$getnumdepartement' ORDER BY". $filtre ."");
			}
			else if ($getregion) {
				$str = sprintf("SELECT id_concert FROM concert, ville, salle, departement, region WHERE salle.id_salle = concert.fksalle AND salle.id_ville = ville_id AND ville.ville_departement = departement.numero AND departement.id_region = region.id AND region.nom_region = '$getregion' ORDER BY". $filtre ."");
			}
			else if ($add)
			{
				$str = sprintf("SELECT id_concert FROM concert WHERE user_ajout = '$add' ORDER BY". $filtre ."");
			}
			else if ($modif)
			{
				$str = sprintf("SELECT id_concert FROM concert WHERE user_modif = '$modif' ORDER BY". $filtre ."");
			}
			else
			{
				$str = sprintf("SELECT id_concert FROM concert ORDER BY". $filtre ."");
			}
			
			$result = mysqli_query($con, $str);
			?>
			<div id="concertsall">
				<?php
				echo $str;
				while($rowx = mysqli_fetch_array($result)) 
				{
					$idconcert = $rowx['id_concert'];
					$row['ville_departement'] = NULL;
					$rowdpt['id_region'] = NULL;
					$rowdpt['nom_departement'] = NULL;
					$rowrgn['nom_pays'] = NULL;
					$rowrgn['nom_region'] = NULL;
					$str = "SELECT datec, heure, lien_fb, date_ajout, lien_ticket, concert.nom_artiste, user_ajout, user_modif, id_salle, adresse, nom_salle, nom_ext, intext, nom_ville, ville_code_postal, ville_departement FROM concert, artiste, salle, ville WHERE concert.nom_artiste = artiste.Nom_artiste AND concert.fksalle = salle.id_salle AND salle.id_ville = ville.ville_id AND id_concert = $idconcert ";
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
					/*else
					{
						$filter = 0;
					}*/
				?> 

					<div class="inwhile"> 
						<div class="artiste"> <?php echo $row['nom_artiste'] ?> </div> 
							<div class="dahe">Date et heure</div>
						<div class="date"> <?php echo  $row['datec'] ?> </div>  
						<div class="heure"> <?php echo $row['heure'] ?> </div>  
							<div class="pacp">Pays, region, departement</div>
						<?php
						if($rowdpt['id_region'])
						{
							?>
							<div class="pays"> <?php echo  $rowrgn['nom_pays'] ?> </div>
							<div class="region"> <?php echo  $rowrgn['nom_region'] ?> </div> 
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
							<div class="departement"> <?php echo  $rowdpt['nom_departement'] ?> </div> 
							<?php
						}
						else
						{	
							?>
							<div class="departement"> Département non renseigné </div> 
							<?php
						}
							?>
							<div class="villexcp"> Ville et CP </div>
						<div class="ville"> <?php echo $row['nom_ville'] ?> </div> 
						<?php
						if($row['ville_code_postal'])
						{
							?>
							<div class="cp"> <?php echo  $row['ville_code_postal'] ?> </div>
							<?php
						}
						else
						{
							?>
								<div class="cp"> Code postal non renseigné </div>
							<?php
						}
						if($row['intext'] == 'int')
						{
						?>
							<div class="saad">Lieu, adresse et salle</div> 
							<br>
							Concert intérieur
							<br>
						<div class="salle"> <?php echo  $row['nom_salle'] ?> </div> 
						<?php
						} 
						else
						{
						?>
							<div class="saad">Lieu, adresse et salle</div> 
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
						<div class="saad">Autres infos</div>
						<div class="dateajout"> Concert ajouté le: <?php echo  $row['date_ajout'] ?> </div> 
						<div class="ajout"> <?php if($rowadd['pseudo']){ echo "Par : "; echo  $rowadd['pseudo'];} else{echo "Par : un anonyme";} ?> </div>
						<div class="modif"><?php if($rowmodif['pseudo']){ echo "Dernière modification par : "; echo  $rowmodif['pseudo'];} else{echo "Concert non modifié";} ?> </div>
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
							<style type="text/css">
								#footer 
								{
								  display:flex;
								}
							</style>
							<div id="footer">
								<?php
								if ($pseudo)
								{?>
									<input id="modifier" type="submit" name="modsuppr" value="Modifier"> 
									<?php
									if($testadmin == 1) 
									{?>
										<input id="supprimer" type="submit" name="modsuppr" value="Supprimer"> 
										<input id="valider" type="submit" name="modsuppr" value="Valider">
									<?php
									}
								}
								else
								{
									echo "Vous devez être connectés afin de modifier un concert";
								}?>
							</div>
						</form>
					</div>
				<?php
	 			}
	 			?>
			</div>
			<?php require "./messages.php"; ?> 
	</body>
	<?php include('footer.html'); ?>
	<script type="text/javascript" src="./js/scrollnav.js"></script> 
</html>


