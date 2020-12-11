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
			$idconcert = $_POST['idpost'];
			$artiste = $_POST['artistepost'];
			$date = $_POST['datepost'];
			$heure = $_POST['heurepost'];
			$pays = $_POST['payspost'];
			$ville = $_POST['villepost'];
			$cp = $_POST['cppost'];
			$salle = $_POST['sallepost'];
			$adresse = $_POST['adressepost'];
			$fb = $_POST['fbpost'];
			$ticket = $_POST['ticketpost'];
			$action = $_POST['modsuppr'];
			
			if(isset($_SESSION['pseudo']) == null)
			{
				echo("Erreur: vous devez être connectés afin de pouvoir modifier un concert");
				echo ("<br />");
				echo("Cliquez ici pour revenir à l'accueil");
			}
			else
			{
				if($action == 'Modifier')
				{
						?>
					<h1> modifier un concert </h1>
					<form method="post" class="connect" action="modifconcertvalid.php">
						<label for="artiste">Nom de l'artiste ou du groupe:  </label> 
						<input type="text" name="artiste" <?php echo 'placeholder="' . $artiste . '"' ?>  id="artiste">
						<input type="hidden" id="artistepost" name="artistepost" <?php echo 'value="' . $artiste . '"' ?> > 
						<br>
						<br>
						<label for="salle">Salle : </label> 
						<input type="text" name="salle" id="salle" onblur="getleave();" onkeyup="getdata();" <?php echo 'placeholder="' . $salle . '"' ?>>
						<div id="res"> </div>
						<input type="hidden" id="sallepost" name="sallepost" <?php echo 'value="' . $salle . '"' ?> > 
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
						<label for="pays">Pays: </label> 
						<input type="text" name="pays" <?php echo 'placeholder="' . $pays . '"' ?> id="pays">
						<input type="hidden" id="payspost" name="payspost" <?php echo 'value="' . $pays . '"' ?> > 
						<br>
						<label for="ville">Ville : </label> 
						<input type="text" name="ville" <?php echo 'placeholder="' . $ville . '"' ?> id="ville">
						<input type="hidden" id="villepost" name="villepost" <?php echo 'value="' . $ville . '"' ?> > 
						<br>
						<label for="cp">Code postal: </label> 
						<input type="text" name="cp" <?php echo 'placeholder="' . $cp . '"' ?> id="cp">
						<input type="hidden" id="cppost" name="cppost" <?php echo 'value="' . $cp . '"' ?> > 
						<br>
						<br>
						<label for="adresse">Adresse: </label> 
						<input type="text" name="adresse" <?php echo 'placeholder="' . $adresse . '"' ?>id="adresse">
						<input type="hidden" id="adressepost" name="adressepost" <?php echo 'value="' . $adresse . '"' ?> > 
						<br>
						<label for="fb">Lien de l'evenement (facebook ou autres) : </label> 
						<input type="text" name="fb" <?php echo 'placeholder="' . $fb . '"' ?> id="fb">
						<input type="hidden" id="fbpost" name="fbpost" <?php echo 'value="' . $fb . '"' ?> > 
						<br>
						<label for="ticket">Lien de la billetterie : </label> 
						<input type="text" name="ticket" <?php echo 'placeholder="' . $ticket . '"' ?> id="ticket">
						<input type="hidden" id="ticketpost" name="ticketpost" <?php echo 'value="' . $ticket . '"' ?> > 
						<br>
						<input type="hidden" id="idpost" name="idpost" <?php echo 'value="' . $idconcert . '"' ?> > 
						<input  type="submit" value="Enregister le concert" name="concert" href="">
					</form>
				<?php
				}
				else if($action == 'Supprimer')
				{
					if($_SESSION['pseudo'] != 'administrateur')
					{
						echo "Erreur: cette action est réservée aux administrateurs";
					}
					else
					{
						$sql = "DELETE FROM Concert WHERE Nom_artiste = '$artiste' AND datec = '$date' AND Nom_salle = '$salle'"; 
						mysqli_query($con, $sql);
					}
				}
			}
			?>
	</body>
	<!--<script type="text/javascript" src="./js/scrollnav.js"></script> -->
</html>



